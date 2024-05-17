<?php

namespace App\Controllers\validador;

use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;
use App\Models\RechazosModel;

class DespublicarNoticia extends BaseController
{
    private $noticiasModel;
    private $historialModel;
    private $rechazosModel;

    public function __construct()
    {
        $this->noticiasModel = new NoticiasModel();
        $this->historialModel = new HistorialModel();
        $this->rechazosModel = new RechazosModel();
    }

    private function checkSession()
    {
        $id = $this->session->get('id');
        if (is_null($id)) {
            return $this->response->redirect(site_url());
        } elseif ($this->session->get('rol') == 1) {
            return $this->response->redirect(site_url());
        }
    }

    public function despublicarNoticia($idNoticia){
        $this->checkSession();
        $noticia = $this->noticiasModel->find($idNoticia);
        if (empty($noticia)) {
            return $this->response->redirect(site_url('/noticiasValidar'));
        } elseif ($noticia['estado'] != 'publicada') {
            return $this->response->redirect(site_url('/noticiasValidar'));
        } else{
            $this->editDatabase($noticia['ID']);
            return $this->response->redirect(site_url('/noticiasValidar'));
        }
    }


    private function editDatabase($id){
        $data = [
            'estado' => 'despublicada',
            'retroceder' => 1
        ];
        $this->noticiasModel->update($id, $data);
        $noticiaEditada = $this->noticiasModel->find($id);
        $noticiaEditada['IDuser'] = $this->session->get('id');
        unset($noticiaEditada['IDusuario']);
        $noticiaEditada['IDnoticia'] = $noticiaEditada['ID'];
        unset($noticiaEditada['ID']);
        unset($noticiaEditada['retroceder']);
        $this->historialModel->createHistorial($noticiaEditada);
    }
}
?>