<?php
     namespace App\Controllers\editor;
     use App\Controllers\BaseController;
     use App\Models\NoticiasModel;
     use App\Models\RechazosModel;
     use App\Models\HistorialModel;

     class VerHistorial extends BaseController{
        private $noticiasModel;
        private $rechazosModel;
        private $historialModel;


        public function __construct(){
            $this->noticiasModel = new NoticiasModel();
            $this->rechazosModel = new RechazosModel();
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

        public function VerHistorial($idNoticia){
            $noticia = $this->noticiasModel->find($idNoticia);
            if(empty($noticia)){
                return $this->response->redirect(site_url('/misnoticias'));
            }elseif($this->session->get('id') != $noticia['IDusuario']){
                return $this->response->redirect(site_url('/misnoticias'));
            }else{
                $historial = $this->getHistorial($idNoticia);
                $rechazos = $this->getRechazos($idNoticia);
                $data = [];
                $data = ['historial' => $historial, 'rechazos' => $rechazos];
                if($this->session->get('rol') == 1){
                    return view('editor/verHistorial', $data);
                }else{
                    return view('editorValidador/verHistorial', $data);
                }


            }
        }

        private function getHistorial($id){
            $idUsuario = $this->session->get('id');
            $db = \config\Database::connect();
            $builder = $db->table('historial');
            $builder->select('historial.*, usuarios.fullname');
            $builder->join('usuarios', 'historial.idUser = usuarios.ID');
            $builder->where('IDnoticia', $id);
            $builder->orderBy('numCambio', 'asc');
            $query = $builder->get();
            return $query->getResultArray();
        }

        private function getRechazos($id){
            return $this->rechazosModel->where('IDnoticia', $id)->findAll();
        }
    }

?>