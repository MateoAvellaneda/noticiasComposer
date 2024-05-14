<?php
    namespace App\Controllers\editor;
    use App\Controllers\BaseController;
    use App\Models\NoticiasModel;


    class MisNoticias extends BaseController{
        private $noticiasModel;

        public function __construct(){
            $this->noticiasModel = new NoticiasModel();
        }

        private function checkSession(){
            $id = $this->session->get('id');
            if(is_null($id)){
                return $this->response->redirect(site_url());
            }elseif($this->session->get('rol') == 2){
                return $this->response->redirect(site_url());
            }
        }

        public function index(){
            $this->checkSession();
            $noticias = [
                'borrador' => [],
                'validar' => [],
                'descartadas' => [],
                'rechazadas' => [],
                'finalizadas' => [],
                'publicadas' => []
            ];

            $noticias['borrador'] = $this->getBorradores();
            $noticias['validar'] = $this->getValidar();
            $noticias['descartadas'] = $this->getDescartadas();
            $noticias['rechazadas'] = $this->getRechazadas();
            $noticias['finalizadas'] = $this->getFinalizadas();
            $noticias['publicadas'] = $this->getPublicadas();

            return view('editor/misNoticiasView', $noticias);
        }

        private function getBorradores(){
            $idUsuario = $this->session->get('id');
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->select('*');
            $builder->where('IDusuario', $idUsuario);
            $builder->where('estado', 'borrador');
            $query = $builder->get();
            return $query->getResultArray();
        }

        private function getValidar(){
            $idUsuario = $this->session->get('id');
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->select('*');
            $builder->where('IDusuario', $idUsuario);
            $builder->where('estado', 'validar');
            $query = $builder->get();
            return $query->getResultArray();
        }
        private function getDescartadas(){
            $idUsuario = $this->session->get('id');
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->select('*');
            $builder->where('IDusuario', $idUsuario);
            $builder->where('estado', 'descartada');
            $query = $builder->get();
            return $query->getResultArray();
        }
        private function getRechazadas(){
            $idUsuario = $this->session->get('id');
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->select('*');
            $builder->where('IDusuario', $idUsuario);
            $builder->where('estado', 'rechazada');
            $query = $builder->get();
            return $query->getResultArray();
        }
        private function getFinalizadas(){
            $idUsuario = $this->session->get('id');
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->select('*');
            $builder->where('IDusuario', $idUsuario);
            $builder->where('estado', 'finalizada');
            $query = $builder->get();
            return $query->getResultArray();
        }
        private function getPublicadas(){
            $idUsuario = $this->session->get('id');
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->select('*');
            $builder->where('IDusuario', $idUsuario);
            $builder->where('estado', 'publicada');
            $query = $builder->get();
            return $query->getResultArray();
        }
        

    }
?>