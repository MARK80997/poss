<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ComprasModel;

class Compras extends BaseController
{

    protected $compras;
    protected $reglas;

    public function __construct()
    {
        $this->compras = new ComprasModel();
        helper(['form']);
        
    }
    
   


    public function nuevo()
    {
    
        echo view('header');
        echo view('compras/nuevo');
        echo view('footer');

    }


    

  





}
