<?php

namespace App\Controllers\editor;
use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;

class ActivarNoticia extends BaseController
{
    private $noticiasModel;
    private $historialModel;

    public function __construct()
    {
        $this->noticiasModel = new NoticiasModel();
        $this->historialModel = new HistorialModel();
    }

    public function activar($idNoticia){
        $error = $this->checkBorrador($idNoticia);
        if(!empty($error)){
            switch ($this->session->get('rol')) {
                case 1:
                    return $this->response->redirect(site_url('/misnoticias/'. $error));
                    break;
                 case 3:
                    if($_SERVER['HTTP_REFERER'] == site_url('/misValidaciones')){
                        return $this->response->redirect(site_url('/misValidaciones'));
                    }elseif($_SERVER['HTTP_REFERER'] == site_url('/misnoticias')){
                        return $this->response->redirect(site_url('/misnoticias/'. $error));
                    }
                    break;
                default:
                    break;
            }
        }else{
            $this->modificarDatabase($idNoticia);
            switch ($this->session->get('rol')) {
                case 1:
                    return $this->response->redirect(site_url('/misnoticias'));
                    break;
                 case 3:
                    if($_SERVER['HTTP_REFERER'] == site_url('/misValidaciones')){
                        return $this->response->redirect(site_url('/misValidaciones'));
                    }elseif($_SERVER['HTTP_REFERER'] == site_url('/misnoticias')){
                        return $this->response->redirect(site_url('/misnoticias'));
                    }
                    break;
                default:
                    break;
            }
        }


    }

    private function checkBorrador($id){
        $noticia = $this->noticiasModel->find($id);
        if($noticia['estado'] == 'borrador'){
           $error = $this->checkCantBorradores();
           return $error;
        }else{
            return '';
        }
    }

    private function modificarDatabase($id){
        $data = ['activo' => 1,
        'retroceder' => 1];
        $this->noticiasModel->update($id, $data);
        $noticiaEditada = $this->noticiasModel->find($id);
        $noticiaEditada['IDuser'] = $noticiaEditada['IDusuario'];
        unset($noticiaEditada['IDusuario']);
        $noticiaEditada['IDnoticia'] = $noticiaEditada['ID'];
        unset($noticiaEditada['ID']);
        unset($noticiaEditada['retroceder']);
        $this->historialModel->createHistorial($noticiaEditada);
    }

    private function checkCantBorradores(){
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