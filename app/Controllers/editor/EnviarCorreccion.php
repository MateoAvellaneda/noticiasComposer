<?php

namespace App\Controllers\editor;
use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;

class EnviarCorreccion extends BaseController
{
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
        }elseif($this->session->get('rol') == 2){
            return $this->response->redirect(site_url());
        }
    }

    public function enviarCorreccion($idNoticia){
        $this->checkSession();
        $noticia = $this->noticiasModel->find($idNoticia);
        if(empty($noticia)){
            return $this->response->redirect(site_url('/misnoticias'));
        }elseif($noticia['estado'] != 'rechazada'){
            return $this->response->redirect(site_url('/misnoticias'));
        }else{
            $this->editDatabase($idNoticia);
            return $this->response->redirect(site_url('/misnoticias'));
        }

    }

    private function editDatabase($id){
        $data = ['estado' => 'correccion',
                    'retroceder' => 1        
            ];
            $this->noticiasModel->update($id, $data);
            $noticiaEditada = $this->noticiasModel->find($id);
            $noticiaEditada['IDuser'] = $noticiaEditada['IDusuario'];
            unset($noticiaEditada['IDusuario']);
            $noticiaEditada['IDnoticia'] = $noticiaEditada['ID'];
            unset($noticiaEditada['ID']);
            unset($noticiaEditada['retroceder']);
            $this->historialModel->createHistorial($noticiaEditada);
    }
}

?>