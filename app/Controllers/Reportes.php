<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\ClientesModel;
use App\Models\UsuariosModel;
use App\Models\ProductosModel;
use App\Models\DetalleVentasModel;
use FPDF;

use CodeIgniter\API\ResponseTrait;

require_once APPPATH . '/Libraries/fpdf/fpdf.php';


class Reportes extends BaseController
{
    use ResponseTrait;
    protected $ventas, $clientes, $usuarios, $productos, $detalleVentas, $db;
    protected $reglas;

    public function __construct()
    {
        //$this->ventas = new VentasModel();
        //$this->clientes = new ClientesModel();
        //$this->usuarios = new UsuariosModel();
        //$this->productos = new ProductosModel();
        //$this->detalleVentas = new DetalleVentasModel();


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
        echo view('header');
        echo view('reportes/reportes');
        echo view('footer');
    }


    public function buscarProductoFecha()
    {
        $fechaInicio = $this->request->getPost('fechaInicio');
        $fechaFinal = $this->request->getPost('fechaFinal');
        //$fechaInicio = date('Y-m-d', strtotime($this->fechaInicio));
        //$fechaFinal = date('Y-m-d', strtotime($this->fechaFinal));
        $db = \Config\Database::connect();
        //$builder = $db->table('detalleventas');
        $builder = $db->table('ventas');
        $builder->select('ventas.id');
        $builder->select('ventas.fechaRegistro');
        $builder->select('clientes.razonSocial AS razonSocial');
        $builder->selectSum('ventas.total');
        $builder->join('clientes', 'clientes.id = ventas.idCliente');
        $builder->where("ventas.fechaRegistro BETWEEN '$fechaInicio' AND '$fechaFinal'");
        //$builder->orderBy('clientes.id', 'ASC');
        $builder->orderBy('razonSocial', 'ASC');
        $builder->groupBy('razonSocial');
        //$builder->groupBy('clientes.razonSocial');


        $data = $builder->get()->getResult();
        //return $this->response->setJSON($results);
        return $this->respond($data);

        //GENERAR LA FECHA Y HORA DEL REPORTES PARA VENTAS

    }

    public function generarReporte()
    {
        //QUITAR INNER JOIN DE DETALLE VENTA. SOLO VENTAS Y CLIENTES
        $fechaInicio = $this->request->getPost('fechaInicio');
        $fechaFinal = $this->request->getPost('fechaFinal');
        $fechaInicioFormato = date('d-m-Y', strtotime($fechaInicio));
        $fechaFinalFormato = date('d-m-Y', strtotime($fechaFinal));
        $totalVentaReporte = $this->request->getPost('totalVentaReporte');
        //PARSEO DE DATO CADENA A DOUBLE(PUNTO FLOTANTE) PARA FORMATEAR A LITERAL
        $cadena = $totalVentaReporte;
        $numeroDouble = floatval($cadena);
        $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        $palabras = $fmt->format($numeroDouble);

        //REALIZANDO LA CONSULTA PARA LUEGO GENERAR EL PDF
        $db = \Config\Database::connect();
        //$builder = $db->table('detalleventas');
        $builder = $db->table('ventas');
        $builder->select('ventas.id');
        $builder->select('ventas.fechaRegistro');
        $builder->select('CONCAT(clientes.razonSocial, " - ", clientes.ciNit) AS nomcar');
        $builder->selectSum('ventas.total');

        //$builder->join('ventas', 'ventas.id = detalleventas.idVenta');
        $builder->join('clientes', 'clientes.id = ventas.idCliente');
        $builder->where("ventas.fechaRegistro BETWEEN '$fechaInicio' AND '$fechaFinal'");
        $builder->orderBy('clientes.razonSocial', 'asc');
        $builder->groupBy('clientes.razonSocial','ASC');
        $data = $builder->get()->getResult();

        //CÓDIGO DONDE SE GENRA EL PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('times', 'B', 15);
        //$pdf->Line(11, 150, 90, 150);
        //$pdf->Line(120, 150, 200, 150);
        //$pdf->Line(11, 170, 199, 170);
        $pdf->Cell(10, 10, $pdf->Image(base_url() . '/images/ferreteria.jpg', 10, 10, 50), 0, 0, 'C');
        $pdf->SetTextColor(233, 177, 4);
        $pdf->Cell(25, 15, utf8_decode("GROMAR"), 0, 0, true);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(120, 10, "");
        $pdf->Cell(10, 10, "Nro: 0000");
        $pdf->Cell(70, 10, "");
        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 20);
        $pdf->Cell(90, 10, "");
        $pdf->Cell(10, 10, utf8_decode("FERRETERÍA GROMAR"), 0, 0, 'C');
        $pdf->Cell(70, 10, "");
        $pdf->SetFont('arial', 'B', 14);
        $pdf->Ln(30);
        $pdf->SetTextColor(199, 0, 57);
        $pdf->Cell(70, 0, "GENERADO EN:   " . date('d/m/Y'));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(10);
        $pdf->SetFillColor(236, 170, 6); //AMARILLO CATERPILLER
        $pdf->Cell(95, 10, 'DESDE:   ' . $fechaInicioFormato, 1, 0, '', true);
        $pdf->Cell(95, 10, 'HASTA:   ' . $fechaFinalFormato, 1, 1, '', true);
        $pdf->SetFillColor(220, 197, 26); //AMARILLO CATERPILLER
        $pdf->Cell(0, 10, 'REPORTE GENERAL DE VENTAS', 1, 1, 'C', true);
        $pdf->SetFillColor(13, 108, 202); //NARANJA FUERTE
        $pdf->Cell(20, 10, '#', 1, 0, 'C', true);
        $pdf->SetFillColor(60, 145, 230); //NARANJA MEDIO OPACO
        $pdf->Cell(70, 10, 'FECHA', 1, 0, 'C', true);
        $pdf->SetFillColor(94, 172, 249); //NARANJA OPACO
        $pdf->Cell(60, 10, 'CLIENTE - CARNET', 1, 0, 'C', true);
        $pdf->SetFillColor(140, 184, 229); //NARANJA OPACO
        $pdf->Cell(40, 10, 'TOTAL', 1, 0, 'C', true);

        foreach ($data as $venta) {
            $pdf->Ln(10);
            $pdf->SetFillColor(13, 108, 202); //NARANJA FUERTE
            $pdf->Cell(20, 10, $venta->id, 1, 0, 'C', true);
            $pdf->SetFillColor(60, 145, 230); //NARANJA MEDIO OPACO
            $pdf->Cell(70, 10, $venta->fechaRegistro, 1, 0, 'C', true);
            $pdf->SetFillColor(94, 172, 249); //NARANJA OPACO
            $pdf->Cell(60, 10, utf8_decode($venta->nomcar), 1, 0, 'C', true);
            $pdf->SetFillColor(140, 184, 229); //NARANJA OPACO
            $pdf->Cell(40, 10, $venta->total, 1, 0, 'C', true);
        }
        $pdf->Ln(10);
        $pdf->Cell(80, 10, "");
        $pdf->Cell(20, 10, "");
        $pdf->Cell(20, 10, "");
        $pdf->Cell(30, 10, "TOTAL Bs: ");
        $pdf->SetFillColor(140, 184, 229); //NARANJA OPACO
        $pdf->Cell(40, 10, $totalVentaReporte, 1, 0, 'C', true);
        $pdf->Ln(20);
        $pdf->MultiCell(150, 10, "SON: " . utf8_decode($palabras) . " 00/100 bolivianos");
        $pdf->Ln(20);
        $pdf->Cell(85, 10, "");
        $pdf->Cell(10, 10, "");
        $pdf->Cell(16, 10, "");
        $pdf->Ln(10);
        $pdf->Cell(10, 10, "");
        $pdf->Ln(20);
        $pdf->Cell(70, 10, "");
        $pdf->Cell(60, 10, "");
        $pdf->Cell(10, 10, "");
        $pdf->SetFont('Arial', '', 8);
        $pdfData = $pdf->Output('', 'S');
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setBody($pdfData);
    }


    public function literalTotal()
    {
        $literalTotal = $this->request->getPost('totalVentaReporte');
        //PARSEO DE DATO CADENA A DOUBLE(PUNTO FLOTANTE) PARA FORMATEAR A LITERAL
        $cadena = $literalTotal;
        $numeroDouble = floatval($cadena);
        $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        $data = $fmt->format($numeroDouble);
        //$data = "300";
        $arreglo = [
            'letra' => $data
        ];
        return $this->response->setJSON($arreglo);
    }


    public function productoMasVendido()
    {
        //QUITAR INNER JOIN DE DETALLE VENTA. SOLO VENTAS Y CLIENTES
        $fechaInicio = $this->request->getPost('fechaInicio');
        $fechaFinal = $this->request->getPost('fechaFinal');
        $fechaInicioFormato = date('d-m-Y', strtotime($fechaInicio));
        $fechaFinalFormato = date('d-m-Y', strtotime($fechaFinal));
        //REALIZANDO LA CONSULTA PARA LUEGO GENERAR EL PDF
        $db = \Config\Database::connect();
        //$builder = $db->table('detalleventas');
        $db = \Config\Database::connect();
        $builder = $db->table('productos as p');
        $builder->select('p.nombre AS nombreProducto');
        $builder->select('v.fechaRegistro AS fechaRegistro');
        $builder->select('IFNULL(SUM(dv.cantidadVenta), 0) AS cantidadTotal', false);
        $builder->select('IFNULL(SUM(dv.cantidadVenta * dv.precioUnitario), 0) AS totalRecaudado', false);
        $builder->join('detalleventas as dv', 'dv.idProducto = p.id', 'left');
        $builder->join('ventas as v', 'v.id = dv.idVenta', 'left');
        //$builder->where("fechaRegistro BETWEEN '$fechaInicio' AND '$fechaFinal'");
        $builder->groupBy('p.nombre');
        $builder->orderBy('totalRecaudado', 'DESC');
        $builder->where("v.fechaRegistro BETWEEN '$fechaInicio' AND '$fechaFinal'");
        $data = $builder->get()->getResult();

        $totalSum = 0; // Inicializamos una variable para la suma total

        foreach ($data as $row) {
            // Accedemos al valor de la columna 'total_ventas' usando el alias
            $totalVenta = $row->totalRecaudado;

            // Sumamos el valor al total acumulado
            $totalSum += $totalVenta;
        }
        $cadena = $totalSum;
        $numeroDouble = floatval($cadena);
        $fmt = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        $palabras = $fmt->format($numeroDouble);

        //CÓDIGO DONDE SE GENRA EL PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        //$pdf->SetFont('courier', 'B', 15);
        $pdf->SetFont('times', 'B', 15);
        //$pdf->Line(11, 150, 90, 150);
        //$pdf->Line(120, 150, 200, 150);
        //$pdf->Line(11, 170, 199, 170);
        $pdf->Cell(10, 10, $pdf->Image(base_url() . '/images/ferreteria.jpg', 10, 10, 50), 0, 0, 'C');
        $pdf->SetTextColor(233, 177, 4);
        $pdf->Cell(25, 15, utf8_decode("GROMAR"), 0, 0, true);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(120, 10, "");
        $pdf->Cell(10, 10, "Nro: 0000");
        $pdf->Cell(70, 10, "");
        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 20);
        $pdf->Cell(90, 10, "");
        $pdf->Cell(10, 10, utf8_decode("FERRETERÍA GROMAR"), 0, 0, 'C');
        $pdf->Cell(70, 10, "");
        $pdf->SetFont('arial', 'B', 14);
        $pdf->Ln(10);
        $pdf->Cell(58, 10, "");
        $pdf->Ln(20);
        //$pdf->Cell(190, 20, "", 1);
        //$pdf->Ln(10);
        //$this->Cell(40, 10, 'Título', 1, 0, 'C', 1);
        $pdf->SetTextColor(199, 0, 57);
        $pdf->Cell(70, 0, "GENERADO EN:   " . date('d/m/Y'));
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(10);
        //--------------
        $pdf->SetFillColor(236, 170, 6); //AMARILLO CATERPILLER
        $pdf->Cell(95, 10, 'DESDE:   ' . $fechaInicioFormato, 1, 0, '', true);
        $pdf->Cell(95, 10, 'HASTA:   ' . $fechaFinalFormato, 1, 1, '', true);
        $pdf->SetFillColor(220, 197, 26); //AMARILLO CATERPILLER
        $pdf->Cell(0, 10, 'PRODUCTOS MAS VENDIDOS', 1, 1, 'C', true);
        $pdf->SetFillColor(241, 105, 4); //NARANJA FUERTE
        $pdf->Cell(70, 10, 'PRODUCTO', 1, 0, 'C', true);
        $pdf->SetFillColor(252, 131, 42); //NARANJA MEDIO OPACO
        $pdf->Cell(60, 10, 'CANTIDAD', 1, 0, 'C', true);
        $pdf->SetFillColor(254, 158, 87); //NARANJA OPACO
        $pdf->Cell(60, 10, 'TOTAL', 1, 0, 'C', true);
        foreach ($data as $venta) {
            $pdf->Ln(10);
            $pdf->SetFillColor(241, 105, 4); //NARANJA FUERTE
            //$pdf->Cell(25, 15, utf8_decode("GROMAR"), 0, 0, true);
            $pdf->Cell(70, 10, utf8_decode($venta->nombreProducto), 1, 0, 'C', true);
            $pdf->SetFillColor(252, 131, 42); //NARANJA MEDIO OPACO
            $pdf->Cell(60, 10, $venta->cantidadTotal, 1, 0, 'C', true);
            $pdf->SetFillColor(254, 158, 87); //NARANJA OPACO
            $pdf->Cell(60, 10, $venta->totalRecaudado, 1, 0, 'C', true);
        }
        $pdf->Ln(10);
        $pdf->Cell(80, 10, "");
        $pdf->Cell(20, 10, "");
        $pdf->Cell(30, 10, "TOTAL Bs: ");
        $pdf->SetFillColor(254, 158, 87); //NARANJA OPACO
        $pdf->Cell(60, 10, $totalSum, 1, 0, 'C', true);
        $pdf->Ln(20);
        //$pdf->Cell(150, 10, "SON: " . $palabras . " 00/100 bolivianos");
        $pdf->MultiCell(150, 10, "SON: " . utf8_decode($palabras) . " 00/100 bolivianos");
        //$pdf->MultiCell($ancho_celda, $altura_celda, $texto);
        // Ancho máximo de la celda

        $pdf->Ln(20);
        $pdf->Cell(85, 10, "");
        $pdf->Cell(10, 10, "");
        $pdf->Cell(16, 10, "");
        $pdf->Ln(10);
        $pdf->Cell(10, 10, "");
        $pdf->Ln(20);
        $pdf->Cell(70, 10, "");
        $pdf->Cell(60, 10, "");
        $pdf->Cell(10, 10, "");
        $pdf->SetFont('Arial', '', 8);
        $pdfData = $pdf->Output('', 'S');
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setBody($pdfData);
    }

    public function verDetalleVenta()
    {
        $idVerDetalle = $this->request->getPost('idVerDetalle');
        $fechaInicio = $this->request->getPost('fechaInicio');
        $fechaFinal = $this->request->getPost('fechaFinal');
        $db = \Config\Database::connect();
        $builder = $db->table('productos as p');
        $builder->select('p.nombre AS nombreProducto, p.precioBase AS precio, dv.cantidadVenta AS cantidad, dv.precioUnitario AS importe');
        $builder->join('detalleventas as dv', 'dv.idProducto = p.id', 'inner');
        $builder->join('ventas as v', 'v.id = dv.idVenta', 'inner');
        $builder->where("v.fechaRegistro BETWEEN '$fechaInicio' AND '$fechaFinal'");
        $builder->where('v.id', $idVerDetalle); // Cambia el valor del ID según tus necesidades
        $builder->groupBy('nombreProducto, precio, cantidad, importe');
        $builder->orderBy('nombreProducto', 'ASC'); // Usar 'nombreProducto' en lugar de 'totalRecaudado' si es lo que deseas ordenar
        $data = $builder->get()->getResult();

        return $this->response->setJSON($data);
    }
    //HASTA EL MOMENTO YA TENEMOS EL PROCESO PRNCIPAL QUE ES DE MOSTRAR EN UN MODAL 
    //EL DETALLE DE LA VENTA. CAMPOS A MEJORAR
    // -EL IDVENTA DE LA TABLA DINÁMICA NO SE ESTA PASANDO CORRECTAMENTE, SOLO SE ESTA PASANDO 
    //EL PRIMER IDVENTA DE LA TABLA DINÁMICA
    // - REALIZAR PRUEBAS DE BÚSQUEDA EN CUANTO A LAS FECHAS PARA VER SI SE ESTA PASANDO CORRECTAMENTE
    //LA CONSULTA.
    //-SUMAR LA LOS IMPORTES DE LA TABLA DINÁMICA PARA REALIZAR LA VERIFICACIÓN CON 
    //EL TOTAL DE LA VENTA DE LA VISTA PRINCIPAL. 
    //-AÑADIR EN ÑA PARTE INFERIOR SU FORMATO LITERAL DEL TOTAL.
    //-AÑADIR COLOR SI SE PUEDE.


}
