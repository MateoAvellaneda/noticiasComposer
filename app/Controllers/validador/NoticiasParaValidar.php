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
        $data['sistema'] = $this->validacionesDelSistema();
        if($this->session->get('rol') == 2){
            return view('validador/noticiasParaValidarView', $data);
        }else{
            return view('editorValidador/noticiasParaValidarView', $data);
        }

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


    private function validacionesDelSistema(){
        $idUsuario = $this->session->get('id');
        $db = \config\Database::connect();
        $builder = $db->table('noticias');
        $builder->select('noticias.ID, noticias.titulo');
        $builder->join('historial', 'noticias.ID = historial.IDnoticia');
        $builder->where('noticias.estado', 'publicada');
        $builder->where('historial.IDuser', 1);
        $builder->where('numCambio = (SELECT MAX(numCambio) FROM historial WHERE IDnoticia = noticias.ID)', NULL, FALSE);
        $query = $builder->get();
        return $query->getResultArray();
    }

}
?>