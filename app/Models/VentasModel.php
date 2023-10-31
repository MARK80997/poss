<?php namespace App\Models;
	
	use CodeIgniter\Model;

	class VentasModel  extends Model {

        protected $table      = 'ventas';
        protected $primaryKey = 'id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['total','idCliente','idUsuario'];

        // Dates
        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        protected $createdField  = 'fechaRegistro'; 
        protected $updatedField  = 'fechaActualizacion';
        protected $deletedField  = 'deleted_at';
 
        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;
              
    }


?>