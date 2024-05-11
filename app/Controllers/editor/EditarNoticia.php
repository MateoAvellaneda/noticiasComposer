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
            $noticia = $this->noticiasModel->find($idNoticia);
            if(empty($noticia)){
                return view('editor/misNoticiasView');
            }else{

                $categorias = $this->categoriasModel->findAll();
                $data = [];
                $data['valuesNoticia'] = $noticia;
                $data['categorias'] = $categorias;
                return view('editor/editarNoticia', $data);
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
                'categoria' => [
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
    }
?>