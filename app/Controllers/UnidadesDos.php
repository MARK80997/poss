<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnidadesModel;

class UnidadesDos extends BaseController
{

    protected $unidades;
    protected $reglas;

    public function __construct()
    {
        $this->unidades = new UnidadesModel();
        helper(['form']);
        $this->reglas = [
            'nombre' =>
            [
                'rules' => 'required', 'errors' =>
                ['required' => 'El CAMPO  nombre ES OBLIGATORIO!!']
            ],

            'nombre_corto' =>
            ['rules' => 'required', 'errors' =>
            ['required' => 'El CAMPO  nombre corto ES OBLIGATORIO!!']]
        ];
    }

    public function index($activo = 1)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();

        $data = ['titulo' => 'Unidades', 'datos' => $unidades];
        echo view('headerr');
        echo view('unidadesDos/unidades', $data);
        echo view('footerr');
    }



    public function eliminados($activo = 0)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades-Eliminados', 'datos' => $unidades];
        echo view('headerr');
        echo view('unidadesDos/eliminados', $data);
        echo view('footerr');
    }


    public function nuevo()
    {
        $data = ['titulo' => 'Agregar-Unidad'];
        echo view('header');
        echo view('unidadesDos/nuevo', $data);
        echo view('footer');
    }


    public function insertar()
    {
        if ($this->request->getPost() && $this->validate($this->reglas)) {
            $this->unidades->save([
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto')
            ]);

            return redirect()->to(base_url() . '/unidadesDos');
        } else {
            $data = ['titulo' => 'Agregar-Unidad', 'validation' => $this->validator];
            echo view('header');
            echo view('unidadesDos/nuevo', $data);
            echo view('footer');
        }
    }


    public function editar($id, $valid = null)
    {

        $unidad = $this->unidades->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => 'Editar Unidad', 'datos' => $unidad, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar Unidad', 'datos' => $unidad];
        }



        echo view('header');
        echo view('unidadesDos/editar', $data);
        echo view('footer');
    }


    public function actualizar()
    {
        if ($this->request->getPost() && $this->validate($this->reglas)) {
            $this->unidades->update($this->request->getPost('id'), [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto')
            ]);

            return redirect()->to(base_url() . '/unidadesDos');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }


    public function eliminar($id)
    {
        $this->unidades->update($id, ['activo' => 0]);

        return redirect()->to(base_url() . '/unidadesDos');
    }


    public function reingresar($id)
    {
        $this->unidades->update($id, ['activo' => 1]);

        return redirect()->to(base_url() . '/unidadesDos');
    }
}