<?php
    namespace App\Controllers\editor;
    use App\Controllers\BaseController;
    use App\Models\NoticiasModel;
    use App\Models\HistorialModel;
    use App\Models\CategoriasModel;
    
    class EditarNoticia extends BaseController{
        private $noticiasModel;
        private $historialModel;
        private $categoriasModel;
        protected $helpers = ['form'];

        public function __construct(){
            $this->noticiasModel = new NoticiasModel();
            $this->historialModel = new HistorialModel();
            $this->categoriasModel = new CategoriasModel();
        }

        public function index($idNoticia){
            $this->checkSession();
            $noticia = $this->noticiasModel->find($idNoticia);
            if(empty($noticia)){
                return $this->response->redirect(site_url('/misnoticias'));
            }else{

                $categorias = $this->categoriasModel->findAll();
                $data = [];
                $data['valuesNoticia'] = $noticia;
                $data['categorias'] = $categorias;
                return view('editor/editarNoticia', $data);
            }
        }

        public function editar($idNoticia){
            $this->checkSession();
            $noticia = $this->noticiasModel->find($idNoticia);
            $formInput = $this->request->getPost();
            $categorias = $this->categoriasModel->findAll();
            $data = [];
            $data['categorias'] = $categorias;
            if(empty($noticia)){
                return $this->response->redirect(site_url('/misnoticias'));
            }elseif($this->session->get('id') != $noticia['IDusuario']){
                return $this->response->redirect(site_url('/misnoticias'));
            }else{
                $data['valuesNoticia'] = $noticia;
                if(!$this->validarCampos($formInput)){
                    return view('editor/EditarNoticia', $data);
                }elseif($this->checkEquals($noticia, $formInput)){
                    $data['error'] ='No hay cambios para hacer';
                    return view('editor/EditarNoticia', $data);
                }else{
                    $this->updateNoticia($formInput, $idNoticia);
                    return $this->response->redirect(site_url('/misnoticias'));
                }
            }
        }

        private function checkSession(){
            $id = $this->session->get('id');
            if(is_null($id)){
                return $this->response->redirect(site_url());
            }elseif($this->session->get('rol') == 2){
                return $this->response->redirect(site_url());
            }
        }

        

        private function validarCampos($input){
            $reglas = [
                'titulo' => [
                    'rules' => 'required|min_length[5]|max_length[255]',
                    'errors' => [
                        'required' => "El titulo es obligatorio",
                        'min_length' => "El titulo debe tener minimo 5 caracteres",
                        'max_length' => "El titulo es muy largo (maximo 255 caracteres)"
                    ]
                ],
                'imagen' => [
                    'rules' => 'max_size[imagen,5000]|is_image[imagen]',
                    'errors' => [
                        'max_size' => "La imagen supera el minimo de peso (5mb)",
                        'is_image' => "El archivo subido no es una imagen valida",
                    ]
                ],
                'descripcion' => [
                    'rules' => 'required|min_length[30]',
                    'errors' => [
                        'required' => "La descripcion es obligatoria",
                        'min_length' => "La descripcion debe tener minimo 30 caracteres"
                    ]
                ],
                'IDcategoria' => [
                    'rules' => 'required|is_not_unique[categorias.ID]',
                    'errors' => [
                        'required' => "La categoria es obligatoria",
                        'is_not_unique' => "La categoria no es valida"
                    ]
                ]
            ];
            if($this->validateData($input,$reglas)){
                return true;
            }else{
                return false;
            }
        }

        private function checkEquals($noticia, $input){
            $keyValues = ['titulo', 'descripcion', 'IDcategoria'];
            $isEqual = 1;
            foreach($keyValues as $key){
                if($noticia[$key] != $input[$key]){
                    $isEqual = 0;
                }
            }
            $imagen = $this->request->getFile('imagen');
            if(!empty($imagen)){
                if($imagen->isValid() && !$imagen->hasMoved()){
                    $isEqual = 0;
                }
            }
            return $isEqual;
        }

        private function updateNoticia($input, $idNoticia){
            $imagen = $this->request->getFile('imagen');
            $imagenName = '';
            if(!empty($imagen)){
                if($imagen->isValid() && !$imagen->hasMoved()){
                    $imagen->move('./uploads/imagenesNoticias', $imagen->getRandomName());
                    $imagenName = $imagen->getName();
                }
            }
            $data = ['titulo' => $input['titulo'],
                     'descripcion' => $input['descripcion'],
                     'IDcategoria' => $input['IDcategoria']
            ];
            if(!empty($imagenName)){
                $data['urlImagen'] = '/uploads/imagenesNoticias/' . $imagenName;
            }
            $data['retroceder'] = 1;
            $this->noticiasModel->update($idNoticia, $data);
            $data = $this->noticiasModel->find($idNoticia);
            $data['IDuser'] = $data['IDusuario'];
            unset($data['IDusuario']);
            $data['IDnoticia'] = $data['ID'];
            unset($data['ID']);
            unset($data['retroceder']);
            $this->historialModel->createHistorial($data);  
        }
    }
?>