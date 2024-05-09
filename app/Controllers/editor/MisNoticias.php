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
                'finalizadas' => []
            ];


            return view('editor/misNoticiasView', $noticias);
        }

    }
?>