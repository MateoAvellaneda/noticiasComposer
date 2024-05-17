<?php
namespace App\Controllers\editor;
use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;
use App\Models\RechazosModel;

class DeshacerCambio extends BaseController{
    private $noticiasModel;
    private $historialModel;
    private $rechazosModel;

    public function __construct(){
        $this->noticiasModel = new NoticiasModel();
        $this->historialModel = new HistorialModel();
        $this->rechazosModel = new RechazosModel();
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
                $this->checkAndDeleteRechazo($idNoticia, $ultimoHistorial);
                $error = $this->checkBorrador($idNoticia);
                if(empty($error)){
                    $this->deshacerUltimoHistorial($idNoticia, $ultimoHistorial[0]['numCambio']);
                    $this->updateNoticia($idNoticia);
                }
                switch ($this->session->get('rol')) {
                    case 1:
                        return $this->response->redirect(site_url('/misnoticias/'. $error));
                        break;
                    case 2:
                        return $this->response->redirect(site_url('/misValidaciones'));
                        break;
                     case 3:
                        if($_SERVER['HTTP_REFERER'] == site_url('/misValidaciones')){
                            return $this->response->redirect(site_url('/misValidaciones'));
                        }elseif($_SERVER['HTTP_REFERER'] == site_url('/misnoticias')){
                            return $this->response->redirect(site_url('/misnoticias/' . $error));
                        }
                        break;
                    default:
                        break;
                }

                // if($this->session->get('rol') == 1){
                //     return $this->response->redirect(site_url('/misnoticias'));
                // }elseif($this->session)
                
            }
        }
    }
    
    private function checkSession(){
        $id = $this->session->get('id');
        if(is_null($id)){
            return $this->response->redirect(site_url());
        // }elseif($this->session->get('rol') == 2){
        //     return $this->response->redirect(site_url());
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

    private function updateNoticia($idNoticia){
        $data = $this->getUltimosHistorial($idNoticia);
        $data[0]['ID'] = $data[0]['IDnoticia'];
        $data[0]['retroceder'] = 0;
        unset($data[0]['IDnoticia']);
        unset($data[0]['numCambio']);
        unset($data[0]['fechaCambio']);
        unset($data[0]['IDuser']);
        $this->noticiasModel->update($idNoticia, $data[0]);
    }

    private function checkAndDeleteRechazo($idNoticia, $ultimoHistorial){
        if($ultimoHistorial[0]['estado'] == 'rechazada'){
            $db = \config\Database::connect();
            $builder = $db->table('rechazos');
            $builder->select('*');
            $builder->where('IDnoticia', $idNoticia);
            $builder->orderBy('ID', 'DESC');
            $builder->limit(1);
            $query = $builder->get();
            $ultimoRechazo = $query->getResultArray();
            $this->rechazosModel->delete($ultimoRechazo[0]['ID']);
        }
    }

    private function checkBorrador($idNoticia){
        $db = \config\Database::connect();
        $builder = $db->table('historial');
        $builder->select('*');
        $builder->where('IDnoticia', $idNoticia);
        $builder->orderBy('numCambio', 'DESC');
        $builder->limit(2);
        $query = $builder->get();
        $noticia = $query->getResultArray();
        if($noticia[1]['estado'] == 'borrador' && ($noticia[0]['estado'] == 'validar' || $noticia[0]['estado'] == 'descartada')){
            $error = $this->checkMinBorrador();
            return $error;
        }else{
            return '';
        }
    }

    private function checkMinBorrador(){
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->where('IDusuario', $this->session->get('id'));
            $builder->where('estado', 'borrador');
            $builder->where('activo', 1);
            $cantdActivasenBorrador =  $builder->countAllResults();
            if($cantdActivasenBorrador > 2){
                $error = 'errorBorrador';
                return $error;
            }else{
                return '';
            }
    }
}
?>