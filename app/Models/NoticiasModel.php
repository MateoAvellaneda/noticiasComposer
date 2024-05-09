<?php
namespace App\Models;

use CodeIgniter\Model;

class NoticiasModel extends Model{
    protected $table      = 'noticias';
    protected $primaryKey = 'ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['IDusuario', 'titulo', 'descripcion', 'estado', 'IDcategoria', 'urlImagen', 'activo', 'fechaFin', 'fecha'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;



    public function createNoticia($data){
        return $this->insert($data);
    }
}
?>