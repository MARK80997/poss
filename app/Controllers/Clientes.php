<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientesModel;

class Clientes extends BaseController
{

    protected $clientes;
    protected $reglas;

    public function __construct()
    {
        $this->clientes = new ClientesModel();


        helper(['form']);
        $this->reglas = [
            'razonSocial' =>
            [
                'rules' => 'required', 'errors' =>
                ['required' => 'El CAMPO  nombre ES OBLIGATORIO!!']
            ],

            'ciNit' =>
            ['rules' => 'required', 'errors' =>
            [
                'required' => 'El CAMPO  dirección ES OBLIGATORIO!!'
            ]]
        ];
    }

    public function index($estado = 1)
    {
        $clientes = $this->clientes->where('estado', $estado)->findAll();
        $data = ['titulo' => 'Clientes', 'datos' => $clientes];
        echo view('header');
        echo view('clientes/clientes', $data);
        echo view('footer');
    }

    public function insertar()
    {
        // Verifica que la solicitud sea una solicitud AJAX
        if ($this->request->isAJAX()) {
            $model = new ClientesModel();

            // Obtiene los datos enviados por AJAX
            $data = [
                'razonSocial' => $this->request->getVar('razonSocial'),
                'ciNit' => $this->request->getVar('ciNit'),
                'estado' => 1
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


    public function buscar()
    {
        // Devuelve los resultados como JSON
        $this->clientes = new ClientesModel();
        $db = \Config\Database::connect();
        $buscare = $this->request->getPost('clientes');
        $cadena = strval($buscare);
        $builder = $db->table('clientes');
        $builder->like('clientes.ciNit', $cadena);
        $builder->where('clientes.estado', 1);
        $query = $builder->get();
        $cliente = $query->getResult();
        return $this->response->setJSON($cliente);
    }


    public function obtenerDatos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clientes');
        //$builder = $db->table('categorias');
        //$this->productos->select('*');
        $builder->select('clientes.id');
        $builder->select('clientes.razonSocial');
        $builder->select('clientes.ciNit');
        $builder->where('clientes.estado', 1);

        //APLICAR ORDER BY,  PORQUE NOS MUESTRA TODO DESORDENADO
        $clientes = $builder->get();
        $data['clientes'] = $clientes->getResult();
        echo json_encode($data);
    }

    public function actualizar()
    {
        if ($this->request->isAJAX()) {
            $this->clientes->update($this->request->getPost('idCliente'), [
                'razonSocial' => $this->request->getPost('razonSocial'),
                'ciNit' => $this->request->getPost('ciNit')
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
            $this->clientes->update($this->request->getPost('idCliente'), ['estado' => 0]);
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);
        }
    }

    public function obtenerDatosEliminados()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clientes');
        //$builder = $db->table('categorias');
        //$this->productos->select('*');
        $builder->select('clientes.id');
        $builder->select('clientes.razonSocial');
        $builder->select('clientes.ciNit');
        $builder->where('clientes.estado', 0);

        //APLICAR ORDER BY,  PORQUE NOS MUESTRA TODO DESORDENADO
        $categorias = $builder->get();
        $data['clientes'] = $categorias->getResult();
        echo json_encode($data);
    }

    public function reingresarDatosEliminados()
    {
        //$valor = $this->request->getPost('idProducto');
        if ($this->request->isAJAX()) {
            //$valor = $this->request->getPost('idProducto');
            $this->clientes->update($this->request->getPost('idClienteEliminado'), ['estado' => 1]);
            return $this->response->setJSON(['message' => 'Registro exitoso']);
        } else {
            return $this->response->setJSON(['message' => 'Error al registrar']);
        }
    }



    public function insertar2()
    {
        // Verifica que la solicitud sea una solicitud AJAX
        if ($this->request->isAJAX()) {
            $model = new ClientesModel();
            // Obtiene los datos enviados por AJAX
            $data = [
                'rozonSocial' => $this->request->getPost('razonSocial'),
                'ciNit' => $this->request->getPost('ciNit'),
                'estado' => 1
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




















    //MÉTODOS CRUDS ANTIGUOS
    public function eliminados($estado = 0)
    {
        $clientes = $this->clientes->where('estado', $estado)->findAll();
        $data = ['titulo' => 'Clientes-Eliminados', 'datos' => $clientes];
        echo view('header');
        echo view('clientes/eliminados', $data);
        echo view('footer');
    }


    public function nuevo()
    {

        $data = ['titulo' => 'Agregar-Cliente'];

        echo view('header');
        echo view('clientes/nuevo', $data);
        echo view('footer');
    }




    // FALTA VALIDAR ESTE MÉTODO PARA COMPLETAR LAS VALIDACIONES!!
    public function editar($id, $valid = null)
    {

        $cliente = $this->clientes->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => 'Editar Cliente', 'datos' => $cliente, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar Cliente', 'datos' => $cliente];
        }
        echo view('header');
        echo view('clientes/editar', $data);
        echo view('footer');
    }

    public function actualizar2()
    {

        if ($this->request->getPost() && $this->validate($this->reglas)) {
            $this->clientes->update($this->request->getPost('id'), [
                'razonSocial' => $this->request->getPost('razonSocial'),
                'ciNit' => $this->request->getPost('ciNit')
            ]);
            return redirect()->to(base_url() . '/clientes');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }


    public function eliminar2($id)
    {
        $this->clientes->update($id, ['estado' => 0]);

        return redirect()->to(base_url() . '/clientes');
    }


    public function reingresar($id)
    {
        $this->clientes->update($id, ['estado' => 1]);

        return redirect()->to(base_url() . '/clientes');
    }
}
