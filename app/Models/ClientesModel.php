<?php namespace App\Models;
	
	use CodeIgniter\Model;

	class ClientesModel  extends Model {

        protected $table      = 'clientes';
        protected $primaryKey = 'id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['razonSocial','ciNit','estado'];

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
