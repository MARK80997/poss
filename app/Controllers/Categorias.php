<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{

    protected $categorias;
    protected $reglas;


    public function __construct()
    {
        $this->categorias = new CategoriasModel();


        helper(['form']);
        $this->reglas = [
            'nombre' =>
            [
                'rules' => 'required', 'errors' =>
                ['required' => 'El CAMPO  nombre ES OBLIGATORIO!!']
            ]
        ];
    }


    public function index($estado = 1)
    {
        $categoria = $this->categorias->where('estado', $estado)->findAll();
        $data = ['titulo' => 'Categorias', 'datos' => $categoria];
        echo view('header');
        echo view('categorias/categorias', $data);
        echo view('footer');
    }



    public function obtenerDatos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('categorias');
        //$builder = $db->table('categorias');
        //$this->productos->select('*');
        $builder->select('categorias.id');
        $builder->select('categorias.nombre');  
        $builder->where('categorias.estado', 1);
       
        //APLICAR ORDER BY,  PORQUE NOS MUESTRA TODO DESORDENADO
        $categorias = $builder->get();
        $data['categorias'] = $categorias->getResult();
        echo json_encode($data);
    }

    public function obtenerDatosEliminados()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('categorias');
        //$builder = $db->table('categorias');
        //$this->productos->select('*');
        $builder->select('categorias.id');
        $builder->select('categorias.nombre');
        $builder->where('categorias.estado', 0);
 
        //APLICAR ORDER BY,  PORQUE NOS MUESTRA TODO DESORDENADO
        $categorias = $builder->get();
        $data['categorias'] = $categorias->getResult();
        echo json_encode($data);
    }

    public function reingresarDatosEliminados()
    {
        //$valor = $this->request->getPost('idProducto');
        if ($this->request->isAJAX()) {
            //$valor = $this->request->getPost('idProducto');
            $this->categorias->update($this->request->getPost('idCategoriaEliminado'), ['estado' => 1]);
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);
        }
    }


    public function insertar()
    {
        // Verifica que la solicitud sea una solicitud AJAX
        if ($this->request->isAJAX()) {
            $model = new CategoriasModel();
            // Obtiene los datos enviados por AJAX
            $data = [
                'nombre' => $this->request->getPost('nombre')             
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
            $this->categorias->update($this->request->getPost('idCategoria'), [
                'nombre' => $this->request->getPost('nombre')           
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
            $this->categorias->update($this->request->getPost('idCategoria'), ['estado' => 0]);
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);
        }
    }

 













    //METODOS ANTIGUOS DE LA INSERCIÓN DEL CRUD CATEGORÍAS
    public function obtenerCategorias()
    {
        $categorias = $this->categorias->where('estado', 1)->findAll();

        $data = ['categorias' => $categorias];
        echo json_encode($data);
    }



    public function eliminados2($estado = 0)
    {
        $categoria = $this->categorias->where('estado', $estado)->findAll();
        $data = ['titulo' => 'Categorías-Eliminados', 'datos' => $categoria];
        echo view('header');
        echo view('categorias/eliminados', $data);
        echo view('footer');
    }


    public function nuevo2()
    {

        $data = ['titulo' => 'Agregar-Categorías'];

        echo view('header');
        echo view('categorias/nuevo', $data);
        echo view('footer');
    }

    public function insertar2()
    {
        if ($this->request->getPost() &&  $this->validate($this->reglas)) {
            $this->categorias->save([

                'nombre' => $this->request->getPost('nombre')

            ]);

            return redirect()->to(base_url() . '/categorias');
        } else {
            $data = ['titulo' => 'Agregar-Categorías', 'validation' => $this->validator];

            echo view('header');
            echo view('categorias/nuevo', $data);
            echo view('footer');
        }
    }



    // FALTA VALIDAR ESTE MÉTODO PARA COMPLETAR LAS VALIDACIONES!!
    public function editar2($id, $valid = null)
    {

        $categoria = $this->categorias->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => 'Editar Categorías', 'datos' => $categoria, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar Categorías', 'datos' => $categoria];
        }
        echo view('header');
        echo view('categorias/editar', $data);
        echo view('footer');
    }

    public function actualizar2()
    {

        if ($this->request->getPost() && $this->validate($this->reglas)) {
            $this->categorias->update($this->request->getPost('id'), [

                'nombre' => $this->request->getPost('nombre'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo')
            ]);
            return redirect()->to(base_url() . '/categorias');
        } else {
            return $this->editar2($this->request->getPost('id'), $this->validator);
        }
    }


    public function eliminar2($id)
    {
        $this->categorias->update($id, ['estado' => 0]);

        return redirect()->to(base_url() . '/categorias');
    }


    public function reingresar2($id)
    {
        $this->categorias->update($id, ['estado' => 1]);

        return redirect()->to(base_url() . '/categorias');
    }
}
