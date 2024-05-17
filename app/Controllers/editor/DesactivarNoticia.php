<?php

namespace App\Controllers\editor;
use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;

class DesactivarNoticia extends BaseController
{
    private $noticiasModel;
    private $historialModel;

    public function __construct()
    {
        $this->noticiasModel = new NoticiasModel();
        $this->historialModel = new HistorialModel();
    }

    public function desactivar($idNoticia){
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


    private function modificarDatabase($id){
        $data = ['activo' => 0,
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


}