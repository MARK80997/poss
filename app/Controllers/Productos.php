<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;
use App\Models\ProductosCategoriasModel;

class Productos extends BaseController
{

    protected $productos;
    protected $categorias;
    protected $reglas;
    protected $security;
    protected $productosCategorias;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->categorias = new CategoriasModel();
        $this->productosCategorias = new ProductosCategoriasModel();

        require APPPATH . 'Libraries/phpqrcode/qrlib.php';
    }

    public function index($estado = 1)
    {
        $productos = $this->productos->where('estado', $estado)->findAll();
        $categorias = $this->categorias->where('estado', $estado)->findAll();
        $data = ['titulo' => 'Productos', 'datos' => $productos, 'categorias' => $categorias];
        echo view('header');
        echo view('productos/productos', $data);
        echo view('footer');
    }
    
    public function buscarProductos()
    {
        $productos = $this->productos->where('estado', 1)->findAll();
        $productos = $this->productos->get();
        $data['productos'] = $productos->getResult();
        echo json_encode($data);
    }

    public function obtenerDatos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('productos');
        //$builder = $db->table('categorias');
        //$this->productos->select('*');
        $builder->select('productos.id');
        $builder->select('productos.nombre');
        $builder->select('productos.unidadMedida');
        $builder->select('productos.precioBase');
        $builder->select('productos.stock');
        $builder->select('productos.marca');
        $builder->select('categorias.nombre as categoriasNombre');
        $builder->select('categorias.id as categoriasId');

        $builder->join('categorias', 'categorias.id = productos.idCategoria');
        $builder->where('productos.estado', 1);
        $builder->orderBy('productos.nombre');
        //APLICAR ORDER BY,  PORQUE NOS MUESTRA TODO DESORDENADO
        $productos = $builder->get();
        $data['productos'] = $productos->getResult();
        echo json_encode($data);
    }

    public function obtenerDatosEliminados()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('productos');
        //$builder = $db->table('categorias');
        //$this->productos->select('*');
        $builder->select('productos.id');
        $builder->select('productos.nombre');
        $builder->select('productos.unidadMedida');
        $builder->select('productos.precioBase');
        $builder->select('productos.stock');
        $builder->select('productos.marca');
        $builder->select('categorias.nombre as categoriasNombre');
        $builder->select('categorias.id as categoriasId');

        $builder->join('categorias', 'categorias.id = productos.idCategoria');
        $builder->where('productos.estado', 0);
        $builder->orderBy('productos.nombre');
        //APLICAR ORDER BY,  PORQUE NOS MUESTRA TODO DESORDENADO
        $productos = $builder->get();
        $data['productos'] = $productos->getResult();
        echo json_encode($data);
    }

    public function reingresarDatosEliminados()
    {
        //$valor = $this->request->getPost('idProducto');
        if ($this->request->isAJAX()) {
            //$valor = $this->request->getPost('idProducto');
            $this->productos->update($this->request->getPost('idProductoEliminado'), ['estado' => 1]);
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);
        }
    }


    public function insertar()
    {
        // Verifica que la solicitud sea una solicitud AJAX
        if ($this->request->isAJAX()) {
            $model = new ProductosModel();
            // Obtiene los datos enviados por AJAX
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'unidadMedida' => $this->request->getPost('unidadMedida'),
                'precioBase' => $this->request->getPost('precioBase'),
                'stock' => $this->request->getPost('stock'),
                'marca' => $this->request->getPost('marca'),
                'idCategoria' => $this->request->getPost('idCategoria')
            ];

            // Inserta los datos en la base de datos
            $inserted = $model->insert($data);

            if ($inserted) {
                // Devuelve una respuesta JSON de éxito
                return $this->response->setJSON(['message' => 'Registro exitoso']);
            } else {
                // Devuelve una respuesta JSON de error
                return $this->response->setJSON(['message' => 'Error al registrar']);
            }
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);

            // Si no es una solicitud AJAX, redirige o muestra una vista de error
        }
    }

    public function actualizar()
    {
        if ($this->request->isAJAX()) {
            $this->productos->update($this->request->getPost('idProducto'), [
                'nombre' => $this->request->getPost('nombre'),
                'unidadMedida' => $this->request->getPost('unidadMedida'),
                'precioBase' => $this->request->getPost('precioBase'),
                'stock' => $this->request->getPost('stock'),
                'marca' => $this->request->getPost('marca'),
                'descripcion' => $this->request->getPost('descripcion'),
                'idCategoria' => $this->request->getPost('idCategoria')
            ]);
            $si = 1;

            if ($si == 1) {
                // Devuelve una respuesta JSON de éxito
                return $this->response->setJSON(['message' => 'Registro exitoso']);
            } else {
                // Devuelve una respuesta JSON de error
                return $this->response->setJSON(['message' => 'Error al registrar']);
            }
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);

            // Si no es una solicitud AJAX, redirige o muestra una vista de error
        }
    }

    public function eliminar()
    {
        //$valor = $this->request->getPost('idProducto');
        if ($this->request->isAJAX()) {
            //$valor = $this->request->getPost('idProducto');
            $this->productos->update($this->request->getPost('idProducto'), ['estado' => 0]);
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);
        }
    }

    public function lecturaqr()
    {
        //CAMPO DE LA VISUALIZACIÓN DEL QR
        if ($nuevo = $this->request->getPost('cadena') != null) {
            $this->productos->save([
                'nombre' => $this->request->getPost('cadena')
            ]);
            $data = ['respuesta' => 'REGISTRO EXITOSO!!'];
            echo view('header');
            echo view('productos/productos', $data);
            echo view('footer');
        } else {
            $data = ['respuesta' => 'NO SE REGISTRO NADA!!'];
            echo view('header');
            echo view('productos/productos', $data);
            echo view('footer');
        }
    }


    public function buscar()
    {
        $this->productos = new ProductosModel();
        $db = \Config\Database::connect();
        $buscare = $this->request->getPost('nombre_producto');
        $cadena = strval($buscare);
        $builder = $db->table('productos');
        $builder->like('productos.nombre', $cadena);
        $builder->where('productos.estado', 1);
        $query = $builder->get();
        $ventas = $query->getResult();
        return $this->response->setJSON($ventas);
    }











    //MÉTODOS ANTIGUOS DEL SISTEMA ////////////////////////////////////////////
    public function nuevo()
    {
        $categorias = $this->categorias->where('estado', 1)->findAll();

        $data = [
            'titulo' => 'Agregar-Producto',
            'categorias' => $categorias
        ];

        echo view('header');
        echo view('productos/nuevo', $data);
        echo view('footer');
    }

    public function insertar2()
    {
        if ($this->request->getPost() &&  $this->validate($this->reglas)) {
            $this->productos->save([

                'nombre' => $this->request->getPost('nombre'),
                'unidadMedida' => $this->request->getPost('unidadMedida'),
                'precioBase' => $this->request->getPost('precioBase'),
                'stock' => $this->request->getPost('stock'),
                'marca' => $this->request->getPost('marca'),
                'descripcion' => $this->request->getPost('descripcion'),
                'idCategoria' => $this->request->getPost('idCategoria')
            ]);

            return redirect()->to(base_url() . '/productos');
        } else {
            $categorias = $this->categorias->where('estado', 1)->findAll();

            $data = [
                'titulo' => 'Agregar-Producto',
                'categorias' => $categorias, 'validation' => $this->validator
            ];

            echo view('header');
            echo view('productos/nuevo', $data);
            echo view('footer');
        }
    }


    // FALTA VALIDAR ESTE MÉTODO PARA COMPLETAR LAS VALIDACIONES!!
    public function editar($id)
    {
        $categorias = $this->categorias->where('estado', 1)->findAll();
        $producto = $this->productos->where('id', $id)->first();
        $data = [
            'titulo' => 'Agregar-Producto',
            'categorias' => $categorias,
            'producto' => $producto
        ];

        echo view('header');
        echo view('productos/editar', $data);
        echo view('footer');
    }

    public function actualizar2()
    {
        $this->productos->update($this->request->getPost('id'), [
            'nombre' => $this->request->getPost('nombre'),
            'unidadMedida' => $this->request->getPost('unidadMedida'),
            'precioBase' => $this->request->getPost('precioBase'),
            'stock' => $this->request->getPost('stock'),
            'marca' => $this->request->getPost('marca'),
            'descripcion' => $this->request->getPost('descripcion'),
            'idCategoria' => $this->request->getPost('idCategoria')
        ]);

        return redirect()->to(base_url() . '/productos');
    }

    public function eliminados($estado = 0)
    {
        $productos = $this->productos->where('estado', $estado)->findAll();
        $data = ['titulo' => 'Productos-Eliminados', 'datos' => $productos];
        echo view('header');
        echo view('productos/eliminados', $data);
        echo view('footer');
    }


    public function eliminar2($id)
    {
        $this->productos->update($id, ['estado' => 0]);

        return redirect()->to(base_url() . '/productos');
    }


    public function reingresar($id)
    {
        $this->productos->update($id, ['estado' => 1]);

        return redirect()->to(base_url() . '/productos');
    }




    // ES EL COMIENZO DEL MÓDULO COMPRAS ANTIGUO
    public function buscarPorCodigo($codigo)
    {
        $this->productos->select('*');
        $this->productos->where('codigo', $codigo);
        $this->productos->where('estado', 1);
        $datos = $this->productos->get()->getRow();

        $res['existe'] = false;
        $res['datos'] = '';
        $res['error'] = '';

        if ($datos) {
            $res['datos'] = $datos;
            $res['existe'] = true;
        } else {
            $res['error'] = 'NO EXISTE EL PRODUCTO!!';
            $res['existe'] = false;
        }

        echo json_encode($res);
    }
}
