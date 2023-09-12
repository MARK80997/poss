<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\UnidadesModel;
use App\Models\CategoriasModel;

class ProductosDos extends BaseController
{

    protected $productosDos;
    protected $unidades;
    protected $categorias;
    protected $reglas;

    public function __construct()
    {
        $this->productosDos = new ProductosModel();
        $this->unidades = new UnidadesModel();
        $this->categorias = new CategoriasModel();

        helper(['form']);
        $this->reglas = ['codigo' =>
                        [ 'rules' => 'required|is_unique[productosDos.codigo]', 'errors' =>
                        [ 'required' => 'El CAMPO  nombre ES OBLIGATORIO!!',
                            'is_unique' => 'El CÓDIGO YA EXISTE!!' ]
                        ],
                        
                        'nombre' =>
                         ['rules' => 'required', 'errors' => 
                         [ 'required' => 'El CAMPO  nombre corto ES OBLIGATORIO!!'
                          ]]
                        ];

    }

    public function index($activo = 1)
    {
        $productosDos = $this->productosDos->where('activo',$activo)->findAll();
        $data = ['titulo' => 'Productos', 'datos' => $productosDos];
            echo view('headerr');
            echo view('productosDos/productos', $data);
            echo view('footerr');

    }


    
    public function eliminados($activo = 0)
    {
        $productosDos = $this->productosDos->where('activo',$activo)->findAll();
        $data = ['titulo' => 'Productos-Eliminados', 'datos' => $productosDos];
            echo view('headerr');
            echo view('productosDos/eliminados', $data);
            echo view('footerr');

    }


    public function nuevo()
    {
        $unidades = $this->unidades->where('activo',1)->findAll();
        $categorias = $this->categorias->where('activo',1)->findAll();
      
        $data = ['titulo' => 'Agregar-Producto', 
        'unidades' => $unidades, 
        'categorias' => $categorias];

        echo view('headerr');
        echo view('productosDos/nuevo', $data);
        echo view('footerr');

    }

    public function insertar()
    {
        if($this->request->getPost() &&  $this->validate($this->reglas))
        {
            $this->productosDos->save([
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria')
            ]);
            
         return redirect()->to(base_url().'/productosDos');
        }else
        {
            $unidades = $this->unidades->where('activo',1)->findAll();
            $categorias = $this->categorias->where('activo',1)->findAll();
          
            $data = ['titulo' => 'Agregar-Producto', 
            'unidades' => $unidades, 
            'categorias' => $categorias , 'validation' => $this->validator];

            echo view('headerr');
            echo view('productosDos/nuevo', $data);
            echo view('footerr');

        }
      
    }
    
    

    // FALTA VALIDAR ESTE MÉTODO PARA COMPLETAR LAS VALIDACIONES!!
    public function editar($id)
    { 
        $unidades = $this->unidades->where('activo',1)->findAll();
        $categorias = $this->categorias->where('activo',1)->findAll();
        $producto = $this->productosDos->where('id',$id)->first();
        $data = ['titulo' => 'Agregar-Producto', 
        'unidades' => $unidades, 
        'categorias' => $categorias,
        'producto' => $producto];

        echo view('headerr');
        echo view('productosDos/editar', $data);
        echo view('footerr');

    }

    public function actualizar()
    {

        $this->productosDos->update($this->request->getPost('id'),[
            'codigo' => $this->request->getPost('codigo'),
            'nombre' => $this->request->getPost('nombre'),
            'precio_venta' => $this->request->getPost('precio_venta'),
            'precio_compra' => $this->request->getPost('precio_compra'),
            'stock_minimo' => $this->request->getPost('stock_minimo'),
            'inventariable' => $this->request->getPost('inventariable'),
            'id_unidad' => $this->request->getPost('id_unidad'),
            'id_categoria' => $this->request->getPost('id_categoria')
        ]);

        return redirect()->to(base_url().'/productosDos');

    }


    public function eliminar($id)
    {
        $this->productosDos->update($id, ['activo'=> 0]);

        return redirect()->to(base_url().'/productosDos');

    }


    public function reingresar($id)
    {
        $this->productosDos->update($id, ['activo'=> 1]);

        return redirect()->to(base_url().'/productosDos');

    }



    
       // ES EL COMIENZO DEL MÓDULO COMPRAS
    public function buscarPorCodigo($codigo)
    {
        $this->productosDos->select('*');
        $this->productosDos->where('codigo', $codigo);
        $this->productosDos->where('activo', 1);
        $datos = $this->productosDos->get()->getRow();

        $res['existe']=false;
        $res['datos']='';
        $res['error']='';

        if($datos)
        {
            $res['datos']=$datos;
            $res['existe']=true;

        }else
        {
            $res['error']='NO EXISTE EL PRODUCTO!!';
            $res['existe']=false;

        }

        echo json_encode($res);
        

    }


}
