<?php

 

namespace App\Models;

 

use CodeIgniter\Model;

 

class Memory extends Model

{

    protected $DBGroup          = 'default';

    protected $table            = 'files';

    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    protected $insertID         = 0;

    protected $returnType       = 'array';

    protected $useSoftDeletes   = false;

    protected $protectFields    = true;

    protected $allowedFields    = ['label','path'];

 

     

    // Validation

    protected $validationRules      = [];

    protected $validationMessages   = [];

    protected $skipValidation       = false;

    protected $cleanValidationRules = true;

 

    // Callbacks

    protected $allowCallbacks = true;

    protected $beforeInsert   = [];

    protected $afterInsert    = [];

    protected $beforeUpdate   = [];

    protected $afterUpdate    = [];

    protected $beforeFind     = [];

    protected $afterFind      = [];

    protected $beforeDelete   = [];

    protected $afterDelete    = [];

}