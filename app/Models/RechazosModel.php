<?php
namespace App\Models;

use CodeIgniter\Model;

class RechazosModel extends Model{
    protected $table      = 'rechazos';
    protected $primaryKey = 'ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['IDnoticia', 'motivo'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;


}
?>