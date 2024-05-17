<?php
namespace App\Controllers;
use App\Models\NoticiasModel;
use App\Models\CategoriasModel;

class VerNoticia extends BaseController{
    private $noticiasModel;
    private $categoriasModel;

    public function __construct()
    {
        $this->noticiasModel = new NoticiasModel();
        $this->categoriasModel = new CategoriasModel();
    }

    public function verNoticia($idNoticia){
        $noticia = $this->noticiasModel->find($idNoticia);
        if(empty($noticia)){
            return $this->response->redirect(site_url());
        }
        $categoria = $this->categoriasModel->find($noticia['IDcategoria']);
        $noticia['categoria'] = $categoria['nombre'];

        if(!isset($this->session->id)){
            if($noticia['estado'] != 'publicada'){
                return $this->response->redirect(site_url());
            }else{
                return view('anonimo/verNoticiaView', $noticia);
            }
        }elseif($this->session->rol == 1){
            if($noticia['estado'] != 'publicada'){
                if($noticia['IDusuario'] != $this->session->id){
                    return $this->response->redirect(site_url());
                }else{
                    return view('editor/verNoticiaView', $noticia);
                }
            }else{
                return view('editor/verNoticiaView', $noticia);
            }
        }elseif($this->session->rol == 2){
            if($noticia['estado'] != 'publicada' && $noticia['estado'] != 'validar'){
                return $this->response->redirect(site_url());
            }else{
                return view('validador/verNoticiaView', $noticia);
            }
        }elseif($this->session->rol == 3){
            if($noticia['estado'] != 'publicada' && $noticia['estado'] != 'validar'){
                if($noticia['IDusuario'] != $this->session->id){
                    return $this->response->redirect(site_url());
                }else{
                    return view('editorValidador/verNoticiaView', $noticia);
                }
            }else{
                return view('editorValidador/verNoticiaView', $noticia);
            }
        }
    }


}