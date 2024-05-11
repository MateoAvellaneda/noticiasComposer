<?php
namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model{
    protected $table      = 'categorias';
    protected $primaryKey = 'ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID', 'nombre', 'descripcion'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;

}

?>