<?php namespace App\Models;
	
	use CodeIgniter\Model;

	class ProductosModel  extends Model {

        protected $table      = 'productos';
        protected $primaryKey = 'id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['codigo','nombre', 'precio_venta',
        'precio_compra','existencias','stock_minimo',
        'inventariable','id_unidad','id_categoria','activo'];

        // Dates
        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        protected $createdField  = 'fecha_alta';
        protected $updatedField  = 'fecha_edit';
        protected $deletedField  = 'deleted_at';

        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;
              
    }


?>