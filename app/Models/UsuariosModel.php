<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model{
    protected $table      = 'usuarios';
    protected $primaryKey = 'ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nickname', 'passw', 'email', 'fullname', 'rol'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;


    public function checkUser($nickname, $passw){
        $resultado = $this->where(['nickname' => $nickname, 'passw' => $passw])->first();
        return $resultado;
    }

    public function createUser($data){
        return $this->insert($data, false);
    }
}
?>