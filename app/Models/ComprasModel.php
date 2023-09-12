<?php namespace App\Models;
	
	use CodeIgniter\Model;

	class ComprasModel  extends Model {

        protected $table      = 'compras';
        protected $primaryKey = 'id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['folio', 'total','id_usuario','activo'];

        // Dates
        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        protected $createdField  = 'fecha_alta';
        protected $updatedField  = '';
        protected $deletedField  = '';

        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;
        
    }

?>