<?php
namespace App\Controllers\editor;
use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;

class DeshacerCambio extends BaseController{
    private $noticiasModel;
    private $historialModel;

    public function __construct(){
        $this->noticiasModel = new NoticiasModel();
        $this->historialModel = new HistorialModel();
    }

    public function deshacerCambio($idNoticia){
        $this->checkSession();
        $noticia = $this->noticiasModel->find($idNoticia);
        if(empty($noticia)){
            return $this->response->redirect(site_url('/misnoticias'));
        }elseif($noticia['retroceder'] == 0){
            return $this->response->redirect(site_url('/misnoticias'));
        }else{
            $ultimoHistorial = $this->getUltimosHistorial($idNoticia);
            if($this->checkDeshacer($ultimoHistorial)){
                $this->deshacerUltimoHistorial($idNoticia, $ultimoHistorial[0]['numCambio']);
                $this->deshabilitarRetroceder($idNoticia);
                return $this->response->redirect(site_url('/misnoticias'));
            }
        }
    }
    
    private function checkSession(){
        $id = $this->session->get('id');
        if(is_null($id)){
            return $this->response->redirect(site_url());
        }elseif($this->session->get('rol') == 2){
            return $this->response->redirect(site_url());
        }
    }

    private function getUltimosHistorial($idNoticia){
        $db = \config\Database::connect();
        $builder = $db->table('historial');
        $builder->select('*');
        $builder->where('IDnoticia', $idNoticia);
        $builder->orderBy('numCambio', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getResultArray();
    }

    private function checkDeshacer($historial){
        if($historial[0]['IDuser'] == $this->session->get('id')){
            return true;
        }else{
            return false;
        }
    }

    private function deshacerUltimoHistorial($idNoticia, $numCambio){
        $db = \config\Database::connect();
        $builder = $db->table('historial');
        $builder->where('IDnoticia', $idNoticia);
        $builder->where('numCambio', $numCambio);
        $builder->delete();
    }

    private function deshabilitarRetroceder($idNoticia){
        $data = ['retroceder' => 0];
        $this->noticiasModel->update($idNoticia, $data);
    }
}
?>