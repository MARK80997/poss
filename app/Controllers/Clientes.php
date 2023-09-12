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
        $this->reglas = ['nombre' =>
                        [ 'rules' => 'required', 'errors' =>
                        [ 'required' => 'El CAMPO  nombre ES OBLIGATORIO!!']
                        ],
                        
                        'direccion' =>
                         ['rules' => 'required', 'errors' => 
                         [ 'required' => 'El CAMPO  dirección ES OBLIGATORIO!!'
                          ]]
                        ];

    }

    public function index($activo = 1)
    {
        $clientes = $this->clientes->where('activo',$activo)->findAll();
        $data = ['titulo' => 'Clientes', 'datos' => $clientes];
            echo view('header');
            echo view('clientes/clientes', $data);
            echo view('footer');

    }


    
    public function eliminados($activo = 0)
    {
        $clientes = $this->clientes->where('activo',$activo)->findAll();
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

    public function insertar()
    {
        if($this->request->getPost() &&  $this->validate($this->reglas))
        {
            $this->clientes->save([
                
                'nombre' => $this->request->getPost('nombre'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo')
            ]);
            
         return redirect()->to(base_url().'/clientes');
        }else
        {
            $data = ['titulo' => 'Agregar-Cliente', 'validation' => $this->validator];

            echo view('header');
            echo view('clientes/nuevo', $data);
            echo view('footer');

        }
      
    }
    
    

    // FALTA VALIDAR ESTE MÉTODO PARA COMPLETAR LAS VALIDACIONES!!
    public function editar($id, $valid = null)
    { 
    
        $cliente = $this->clientes->where('id',$id)->first();
        if($valid != null)
        {
            $data = ['titulo' => 'Editar Cliente', 'datos' => $cliente, 'validation' => $valid];
        }else
        {
            $data = ['titulo' => 'Editar Cliente', 'datos' => $cliente];
        }
        echo view('header');
        echo view('clientes/editar', $data);
        echo view('footer');

    }

    public function actualizar()
    {

        if($this->request->getPost() && $this->validate($this->reglas)){
            $this->clientes->update($this->request->getPost('id'),[
            
            'nombre' => $this->request->getPost('nombre'),
            'direccion' => $this->request->getPost('direccion'),
            'telefono' => $this->request->getPost('telefono'),
            'correo' => $this->request->getPost('correo')
        ]);
        return redirect()->to(base_url().'/clientes');
        }else
        {
            return $this->editar($this->request->getPost('id'), $this->validator);
    
        }

    }


    public function eliminar($id)
    {
        $this->clientes->update($id, ['activo'=> 0]);

        return redirect()->to(base_url().'/clientes');

    }


    public function reingresar($id)
    {
        $this->clientes->update($id, ['activo'=> 1]);

        return redirect()->to(base_url().'/clientes');

    }


}
