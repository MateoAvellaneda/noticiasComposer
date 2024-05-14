<?php
namespace App\Controllers\validador;
use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;

class NoticiasParaValidar extends BaseController{
    private $noticiasModel;
    private $historialModel;

    public function __construct()
    {
        $this->noticiasModel = new NoticiasModel();
        $this->historialModel = new HistorialModel();
    }

    private function checkSession(){
        $id = $this->session->get('id');
        if(is_null($id)){
            return $this->response->redirect(site_url());
        }elseif($this->session->get('rol') == 1){
            return $this->response->redirect(site_url());
        }
    }

    public function noticiasParaValidar(){
        $this->checkSession();
        $data = ['noticias' => ''];
        $data['noticias'] = $this->getValidar();
        return view('validador/noticiasParaValidarView', $data);
    }

    private function getValidar(){
        $idUsuario = $this->session->get('id');
        $db = \config\Database::connect();
        $builder = $db->table('noticias');
        $builder->select('noticias.ID, noticias.titulo, usuarios.fullname');
        $builder->join('usuarios', 'noticias.IDusuario = usuarios.ID');
        $builder->where('estado', 'validar');
        $query = $builder->get();
        return $query->getResultArray();
    }


}
?>