<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;

class Configuracion extends BaseController
{

    protected $configuracion;
    protected $reglas;

    public function __construct()
    {
        $this->configuracion = new ConfiguracionModel();
        helper(['form']);
        $this->reglas = ['nombre' =>
                        [ 'rules' => 'required', 'errors' =>
                        [ 'required' => 'El CAMPO  nombre ES OBLIGATORIO!!' ]
                        ],
                        
                        'nombre_corto' =>
                         ['rules' => 'required', 'errors' => 
                         [ 'required' => 'El CAMPO  nombre corto ES OBLIGATORIO!!' ]]
                        ];
    }

    public function index($activo = 1)
    {
        //$configuracion = $this->configuracion->where('activo',$activo)->findAll();
        $data = ['titulo' => 'Configuracion'];
            echo view('header');
            echo view('configuracion/configuracion', $data);
            echo view('footer');

    }

    

    public function actualizar()
    {
        if($this->request->getPost() && $this->validate($this->reglas)){
        $this->configuracion->update($this->request->getPost('id'), [
            'nombre' => $this->request->getPost('nombre'),
            'nombre_corto' => $this->request->getPost('nombre_corto')
        ]);

        return redirect()->to(base_url().'/configuracion');
        }else
        {
            //return $this->editar($this->request->getPost('id'), $this->validator);
        }

    }

}