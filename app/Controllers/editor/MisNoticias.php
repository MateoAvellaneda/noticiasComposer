<?php
    namespace App\Controllers\editor;
    use App\Controllers\BaseController;
    use App\Models\NoticiasModel;
    use App\Models\RechazosModel;


    class MisNoticias extends BaseController{
        private $noticiasModel;
        private $rechazosModel;

        public function __construct(){
            $this->noticiasModel = new NoticiasModel();
            $this->rechazosModel = new RechazosModel();
        }

        private function checkSession(){
            $id = $this->session->get('id');
            if(is_null($id)){
                return $this->response->redirect(site_url());
            }elseif($this->session->get('rol') == 2){
                return $this->response->redirect(site_url());
            }
        }

        public function index($error = ''){
            $this->checkSession();
            $noticias = [
                'borrador' => [],
                'validar' => [],
                'descartadas' => [],
                'rechazadas' => [],
                'finalizadas' => [],
                'publicadas' => [],
                'correccion' => []
            ];
            if($error == 'errorBorrador'){
                $noticias['error'] = 'Se supera la cantidad máxima de noticias activas en borrador (máximo 3)';
            }
            $noticias['borrador'] = $this->getBorradores();
            $noticias['borrador'] = $this->checkActivarDesactivar($noticias['borrador']);
            $noticias['validar'] = $this->getValidar();
            $noticias['validar'] = $this->checkActivarDesactivar($noticias['validar']);
            $noticias['descartadas'] = $this->getDescartadas();
            $noticias['rechazadas'] = $this->getRechazadas();
            $noticias['finalizadas'] = $this->getFinalizadas();
            $noticias['publicadas'] = $this->getPublicadas();
            $noticias['rechazadas'] = $this->checkPosiblecorreccion($noticias['rechazadas']);
            $noticias['correccion'] = $this->getCorreccion();
            if($this->session->get('rol') == 1){
                return view('editor/misNoticiasView', $noticias);
            }else{
                return view('editorValidador/misNoticiasView', $noticias);
            }

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
            $builder->select('noticias.*, rechazos.motivo');
            $builder->join('rechazos', 'rechazos.IDnoticia = noticias.ID');
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

        private function getCorreccion(){
            $idUsuario = $this->session->get('id');
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->select('*');
            $builder->where('IDusuario', $idUsuario);
            $builder->where('estado', 'correccion');
            $query = $builder->get();
            return $query->getResultArray();
        }

        private function checkPosiblecorreccion($noticias){
            $db = \config\Database::connect();
            $builder = $db->table('historial');
            for($i=0; $i<count($noticias); $i++){
                $builder->where('IDnoticia', $noticias[$i]['ID']);
                $builder->where('estado', 'rechazada');
                $cantRechazos = $builder->countAllResults();
                if($cantRechazos > 1){
                    $noticias[$i]['corregir'] = 0;
                }else{
                    $noticias[$i]['corregir'] = 1;
                }
            }
            return $noticias;
        }

        private function checkActivarDesactivar($noticias){
            $db = \config\Database::connect();
            $builder = $db->table('historial');
            for($i=0; $i<count($noticias); $i++){
                $builder->where('IDnoticia', $noticias[$i]['ID']);
                $cantCambios = $builder->countAllResults();
                if($cantCambios > 1){
                    $noticias[$i]['activarDesactivar'] = 0;
                }else{
                    $noticias[$i]['activarDesactivar'] = 1;
                }
            }
            return $noticias;
        }
        
        

        

    }
?>