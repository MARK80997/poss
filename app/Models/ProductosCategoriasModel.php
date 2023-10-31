<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosCategoriasModel  extends Model
{

    protected $table = 'productos';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre', 'unidadMedida',
        'precioBase', 'stock', 'marca', 'idCategoria'
    ];


    public function obtenerProductosConCategorias()
    {
        return $this->select('productos.*, categorias.nombre as nombre_categoria')
            ->join('categorias', 'categorias.id = productos.idCategoria')
            ->get()
            ->getResultArray();

     
    }
}
