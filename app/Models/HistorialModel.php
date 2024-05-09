<?php
namespace App\Models;

use CodeIgniter\Model;

class HistorialModel extends Model{
    protected $table      = 'historial';
    protected $primaryKey = 'IDnoticia';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['IDnoticia' ,'titulo', 'descripcion', 'estado', 'IDcategoria', 'urlImagen',
     'activo', 'fechaFin', 'fecha', 'IDuser', 'fechaCambio'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;



    public function createHistorial($data){
        return $this->insert($data, false);
    }
}
?>