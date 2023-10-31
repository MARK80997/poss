<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\ClientesModel;
use App\Models\UsuariosModel;
use App\Models\ProductosModel;
use App\Models\DetalleVentasModel;

use FPDF;

require_once APPPATH . '/Libraries/fpdf/fpdf.php';



class Ventas extends BaseController
{

    protected $ventas, $clientes, $usuarios, $productos, $detalleVentas, $db;
    protected $reglas;

    public function __construct()
    {

        $this->ventas = new VentasModel();
        $this->clientes = new ClientesModel();
        $this->usuarios = new UsuariosModel();
        $this->productos = new ProductosModel();
        $this->detalleVentas = new DetalleVentasModel();


        /*ESTE ARREGLO CUMPLE LA FUNCIÓN DE QUE LOS CAMPOS SEAN OBLIGATORIOS EN ESTE MÓDULO*/
        helper(['form']);
        $this->reglas = [
            'total' =>
            ['rules' => 'required', 'errors' => ['required' => 'El CAMPO TOTAL ES OBLIGATORIO!!']],

            'descripcion' =>
            ['rules' => 'required', 'errors' => ['required' => 'El CAMPO DESCRIPCION ES OBLIGATORIO!!']],

            'idCliente' =>
            ['rules' => 'required', 'errors' => ['required' => 'El CAMPO  CLIENTE  ES OBLIGATORIO!!']],

            'idUsuario' =>
            ['rules' => 'required', 'errors' => ['required' => 'El CAMPO USUARIO ES OBLIGATORIO!!']]
        ];
    }


    public function index($estado = 1)
    {
        $modelPro = $this->productos->where('estado', 1)->findAll();
        $modelVen = $this->ventas->where('estado', 1)->findAll();
        $modelCli = $this->clientes->where('estado', 1)->findAll();

        $data = ['titulo' => 'GESTIÓN DE VENTAS', 'clientes' => $modelCli, 'productos' => $modelPro, 'ventas' => $modelVen];

        echo view('header');
        echo view('ventas/ventas', $data);
        echo view('footer');
    }


    public function transaccion()
    {  //ESTE ES EL VÁLIDO!!

        $this->db = \Config\Database::connect();

        $idProducto = $this->request->getPost('idProducto');
        $idCliente = $this->request->getPost('idCliente');
        $total = $this->request->getPost('total');
        $usuario = 1;
        //$this->db->transStart();
        $this->db->transBegin();


        try {
            $ventaData = array(
                'total' => $total,
                'idCliente' => $idCliente,
                'idUsuario' => $usuario
            );

            $this->ventas->insert($ventaData);
            $idVenta = $this->db->insertID();

            foreach ($idProducto as $venta) {
                $producto = $this->productos->find($venta['idProductoVenta']);

                if ($producto['stock'] < $venta['cantidad']) {
                    $this->db->transRollback();
                } else {

                    $detalleVentaData = array(
                        'idProducto' => $venta['idProductoVenta'],
                        'idVenta' => $idVenta,
                        'cantidadVenta' => $venta['cantidad'],
                        'precioUnitario' => $venta['importe']
                    );
                    $this->detalleVentas->insert($detalleVentaData);

                    $producto = $this->productos->find($venta['idProductoVenta']);
                    $nuevaCantidadProducto = $producto['stock'] - $venta['cantidad'];
                    $this->productos->update($venta['idProductoVenta'], ['stock' => $nuevaCantidadProducto]);
                }
            }

            $this->db->transCommit();
            return $this->response->setJSON(['message' => 'Exito']);

            //echo 'Transacción completada con éxito.';
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            $this->db->transRollback();
            return $this->response->setJSON(['message' => 'Error']);
            //echo 'Error en la transacción: ' . $e->getMessage();
        }
    }


    public function pdf()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas');
        // Aplicar la cláusula ORDER BY para ordenar por el ID en orden descendente
        $builder->orderBy('id', 'DESC'); // Suponiendo que 'id' es el nombre de tu columna de ID

        // Limitar el resultado a un solo registro
        $builder->limit(1);

        // Realizar la consulta para obtener el último ID
        $query = $builder->get();

        // Obtener el último ID
        $ultimoRegistro = $query->getRow();
        $ultimoID = $ultimoRegistro->id;
        $totalPago = $ultimoRegistro->total;

        //PROCESO DE GENERAR LITERALMENTE EL NUMERO TOTAL DE LA VENTA ACTUAL
        $numero = $totalPago;
        $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        $palabras = $fmt->format($numero);

        //PROCESO DE GENERAR EL PDF EN CON LOS VALORES DE LA VENTA ACTUAL
        $db = \Config\Database::connect();
        $builder = $db->table('detalleventas');
        $builder->select('ventas.id');
        $builder->select('clientes.ciNit');
        $builder->select('clientes.razonSocial AS razonSocial');
        $builder->select('ventas.fechaRegistro');
        $builder->select('detalleventas.cantidadVenta');
        $builder->select('productos.nombre');
        $builder->select('productos.precioBase');
        $builder->select('detalleventas.precioUnitario');
        $builder->select('ventas.total');
        $builder->select('usuarios.nombreUsuario'); //DEBEMOS RECUPERAR EL USUARIO QUE INICIÓSESSIÓN

        $builder->join('ventas', 'ventas.id = detalleventas.idVenta');
        $builder->join('productos', 'productos.id = detalleventas.idProducto');
        $builder->join('clientes', 'clientes.id = ventas.idCliente');
        $builder->join('usuarios', 'usuarios.id = ventas.idUsuario');

        $builder->where('ventas.id', $ultimoID);
        $builder->orderBy('razonSocial', 'ASC');
        $ventas = $builder->get();
        $data = $ventas->getResult();
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 15);
        //$pdf->Line(11, 130, 197, 130);
        //$pdf->Line(11, 150, 200, 150);
        //$pdf->Line(120, 150, 200, 150);
        //$pdf->Line(11, 170, 199, 170);
        $pdf->Cell(10, 10, $pdf->Image(base_url() . '/images/ferreteria.jpg', 10, 10, 50), 0, 0, 'C');
        $pdf->SetTextColor(233, 177, 4);
        $pdf->Cell(25, 15, utf8_decode("GROMAR"), 0, 0, true);
        $pdf->SetTextColor(0, 0, 0);
        //$pdf->Cell(80, 10, "LA FERRETERIA");
        //$pdf->Cell(10, 10, "Nro: 0000" . $ultimoID);
        //$pdf->Cell(70, 10, ""); 
        $pdf->Cell(120, 10, "");
        $pdf->Cell(10, 10, "Nro: 0000" . $ultimoID);
        $pdf->Cell(70, 10, "");
        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 20);
        $pdf->Cell(90, 10, "");
        $pdf->Cell(10, 10, utf8_decode("FERRETERÍA GROMAR"), 0, 0, 'C');
        $pdf->Cell(70, 10, "");
        $pdf->SetFont('arial', 'B', 14);
        $pdf->Ln(20);
        $pdf->Ln(10);
        foreach ($data as $venta) {
            $pdf->Cell(70, 0, "CLIENTE:  " . utf8_decode($venta->razonSocial));
            $pdf->Cell(70, 0, "C.I. " . $venta->ciNit);
            $pdf->Cell(70, 0, "FECHA: " . date('d/m/Y'));
        }
        $pdf->Ln(10);
        $pdf->SetFillColor(236, 170, 6); //AMARILLO CATERPILLER
        $pdf->Cell(0, 10, 'RECIBO DE VENTA', 1, 1, 'C', true);
        $pdf->SetFillColor(24, 146, 39); //NARANJA MEDIO OPACO
        $pdf->Cell(60, 10, 'PRODUCTO', 1, 0, 'C', true);
        $pdf->SetFillColor(52, 167, 66); //NARANJA OPACO
        $pdf->Cell(40, 10, 'CANTIDAD', 1, 0, 'C', true);
        $pdf->SetFillColor(86, 206, 101); //NARANJA OPACO
        $pdf->Cell(40, 10, 'PRECIO', 1, 0, 'C', true);
        $pdf->SetFillColor(124, 235, 137); //NARANJA OPACO
        $pdf->Cell(50, 10, 'SUBTOTAL', 1, 0, 'C', true);

        foreach ($data as $venta) {
            $pdf->Ln(10);
            $pdf->SetFillColor(24, 146, 39); //NARANJA MEDIO OPACO
            $pdf->Cell(60, 10, utf8_decode($venta->nombre), 1, 0, 'C', true);
            $pdf->SetFillColor(52, 167, 66); //NARANJA MEDIO OPACO
            $pdf->Cell(40, 10, $venta->cantidadVenta, 1, 0, 'C', true);
            $pdf->SetFillColor(86, 206, 101); //NARANJA MEDIO OPACO
            $pdf->Cell(40, 10, $venta->precioBase, 1, 0, 'C', true);
            $pdf->SetFillColor(124, 235, 137); //NARANJA MEDIO OPACO
            $pdf->Cell(50, 10, $venta->precioUnitario, 1, 0, 'C', true);
        }
        $pdf->Ln(20);
        $pdf->SetFillColor(24, 146, 39); //NARANJA MEDIO OPACO
        $pdf->Cell(85, 10, "TRATANTE: " . $venta->nombreUsuario, 1, 0, 'C', true);
        $pdf->Cell(10, 10, "");
        $pdf->Cell(16, 10, "");
        $pdf->Cell(30, 10, "TOTAL Bs: ");
        $pdf->SetFillColor(124, 235, 137); //NARANJA MEDIO OPACO
        //$pdf->Cell(80, 10, "TOTAL A PAGAR Bs. " . $venta->total, 1, 0, 'C', true);
        $pdf->Cell(49, 10, $venta->total, 1, 0, 'C', true);
        $pdf->Ln(20);
        //$pdf->Cell(150, 10, "SON: " . $palabras . " 00/100 bolivianos");
        $pdf->MultiCell(150, 10, "SON: " . utf8_decode($palabras) . " 00/100 bolivianos");
        $pdf->Ln(20);
        $pdf->Cell(85, 10, "UNA VEZ REALIZADA LA COMPRA NO SE ACEPTAN DEVOLUCIONES");
        $pdf->Cell(10, 10, "");
        $pdf->Cell(16, 10, "");
        $pdf->Ln(10);
        $pdf->Cell(10, 10, "Gracias  por su preferencia!!");
        $pdf->Ln(20);
        $pdf->Cell(70, 10, "TELEFONO: 7135362");
        $pdf->Cell(60, 10, "UBICACION:...");
        $pdf->Cell(10, 10, "E-MAIL:...");
        $pdf->SetFont('Arial', '', 8);
        $pdf->Output('listado_ventas.pdf', 'I'); // 'I' para mostrar en el navegador, 'F' para guardar en un archivo

        exit();
        //FALTA CONTROLAR ACENTOS, CAMBIAR EL CORREO DEL USUARIO POR EL NOMBRE DEL USUARIO
        //PONER IMAGENS DE FONDO, COLOREAR LAS CELDAS, PONER LEYENADAS CREIBLES Y REALISTAS
        //PONER COLOR BLANCO AL TEXTO DEL LOGOTIPO (GROMAR) Y AUMENTAR LA HORA A LA FECHA
        //COLOCAR CORREOS DE LA EMPRESA O DUEÑO DE LA EMPRESA.
    }










































    //MÉTODOS CRUDS ANTIGUOS!!
    public function eliminados($estado = 0)
    {
        $ventas = $this->ventas->where('estado', $estado)->findAll();
        $data = ['titulo' => 'ventas-Eliminados', 'datos' => $ventas];
        echo view('header');
        echo view('ventas/eliminados', $data);
        echo view('footer');
    }


    public function nuevo()
    {
        $clientes = $this->clientes->where('estado', 1)->findAll();
        $usuarios = $this->usuarios->where('estado', 1)->findAll();

        $data = ['titulo' => 'Agregar ventas', 'clientes' => $clientes, 'usuarios' => $usuarios];
        echo view('header');
        echo view('ventas/nuevo', $data);
        echo view('footer');
    }



    public function insertarAntiguo()
    {

        if ($this->request->getPost() && $this->validate($this->reglas)) {

            $this->ventas->save([
                'total' => $this->request->getPost('total'),
                'descripcion' => $this->request->getPost('descripcion'),
                'idCliente' => $this->request->getPost('idCliente'),
                'idUsuario' => $this->request->getPost('idUsuario'),
                'estado' => 1
            ]);

            return redirect()->to(base_url() . '/ventas');
        } else {
            $clientes = $this->clientes->where('estado', 1)->findAll();
            $usuarios = $this->usuarios->where('estado', 1)->findAll();

            $data = ['titulo' => 'Agregar-ventas', 'clientes' => $clientes, 'usuarios' => $usuarios, 'validation' => $this->validator];
            echo view('header');
            echo view('ventas/nuevo', $data);
            echo view('footer');
        }
    }


    public function editar($id, $valid = null)
    {

        $ventas = $this->ventas->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => 'Editar Ventas', 'datos' => $ventas, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar Ventas', 'datos' => $ventas];
        }

        echo view('header');
        echo view('ventas/editar', $data);
        echo view('footer');
    }


    public function actualizar()
    {
        if ($this->request->getPost() && $this->validate($this->reglas)) {
            $this->ventas->update($this->request->getPost('id'), [
                'total' => $this->request->getPost('total'),
                'descripcion' => $this->request->getPost('descripcion'),
                'idCliente' => $this->request->getPost('idCliente'),
                'idUsuario' => $this->request->getPost('idUsuario')
            ]);

            return redirect()->to(base_url() . '/ventas');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }


    public function eliminar($id)
    {
        $this->ventas->update($id, ['estado' => 0]);

        return redirect()->to(base_url() . '/ventas');
    }


    public function reingresar($id)
    {
        $this->ventas->update($id, ['estado' => 1]);

        return redirect()->to(base_url() . '/ventas');
    }
}
