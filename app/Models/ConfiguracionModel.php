/*EL  MÓDULO (CONFIGURACIÓN) FALTA REALIZAR/COPLETAR ACTIVIDADES, EL VIDEO SE ENCUENTRA EN LA 
PANTALLA DE INICIO.   ESTE MÓDULO TIENE COMO OBJETIVO MOSRAR INFORMACIOÓN DE LA EMPRESA EN EL SISTEMA*/

<?php namespace App\Models;
	
	use CodeIgniter\Model;

	class ConfiguracionModel  extends Model {

        protected $table      = 'configuracion';
        protected $primaryKey = 'id';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;
        protected $useSoftUpdates = false;
        protected $useSoftCreates = false;

        protected $allowedFields = ['nombre', 'valor'];

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