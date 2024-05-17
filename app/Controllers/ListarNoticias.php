<?php
namespace App\Controllers;
use App\Models\NoticiasModel;

class ListarNoticias extends BaseController{
    private $noticiasModel;

    public function __construct()
    {
        $this->noticiasModel = new NoticiasModel();
    }

    public function vistaNoticias($numeroPagina){
        $cantidadNoticias = $this->getCantNoticiasPublicadas();
        $data = ['cantidadNoticias' => $cantidadNoticias];
        $offset = ($numeroPagina - 1) * 6;
        $noticias = $this->getNoticiasPublicadas(6, $offset);
        $data['noticias'] = $noticias;
        $data['numeroPagina'] = 1;
        if(!isset($this->session->id)){
            return view('anonimo/listaNoticiasView', $data);
        }elseif($this->session->rol == 1){
            return view('editor/listaNoticiasView', $data);
        }elseif($this->session->rol == 2){
            return view('validador/listaNoticiasView', $data);
        }elseif($this->session->rol == 3){
            return view('editorValidador/listaNoticiasView', $data);
        }
    }

    private function getCantNoticiasPublicadas(){
        $db = \config\Database::connect();
        $builder = $db->table('noticias');
        $builder->where('estado', 'publicada');
        return $builder->countAllResults();
    }

    private function getNoticiasPublicadas($limit, $offset){
        $db = \config\Database::connect();
        $builder = $db->table('noticias');
        $builder->select('*');
        $builder->where('estado', 'publicada');
        $builder->orderBy('ID', 'DESC');
        $query = $builder->get($limit, $offset);
        $noticias = $query->getResultArray();
        return $noticias;
    }
}
?>