<?php
namespace App\Controllers\editor;
use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;
use App\Models\CategoriasModel;

use CodeIgniter\I18n\Time;
class CrearNoticia extends BaseController{
    protected $helpers = ['form'];
    private $noticiasModel;
    private $historialModel;
    private $categoriasModel;

    public function __construct(){
        $this->noticiasModel = new NoticiasModel();
        $this->historialModel = new HistorialModel();
        $this->categoriasModel = new CategoriasModel();
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
        $data = ['categorias' => $this->categoriasModel->findAll()];
        if($this->session->get('rol') == 1){
            return view('/editor/CrearNoticia', $data);
        }else{
            return view('/editorValidador/CrearNoticia', $data);
        }
        
    }

    public function guardar(){
        $this->checkSession();
        $data = ['categorias' =>  $this->categoriasModel->findAll()];
        $formInput = $this->request->getPost();
        if($this->validarCampos($formInput)){
            $error = $this->checkMinBorrador($formInput);
            if(!empty($error)){
                $data['error'] = $error;
                if($this->session->get('rol') == 1){
                    return view('/editor/CrearNoticia', $data);
                }else{
                    return view('/editorValidador/CrearNoticia', $data);
                }
            }else{
                $nombreImagen = $this->saveImage();
                $this->crearNoticia($formInput, $nombreImagen);
                if($this->session->get('rol') == 1){
                    return view('/editor/noticiaCreadaExito');
                }else{
                    return view('/editorValidador/noticiaCreadaExito');
                }
            }
        }else{
            if($this->session->get('rol') == 1){
                return view('/editor/CrearNoticia', $data);
            }else{
                return view('/editorValidador/CrearNoticia', $data);
            }
        }
        // if(!$this->validarCampos($formInput)){

        // }
    }

    private function validarCampos($formInput){
        $reglas = [
            'titulo' => [
                'rules' => 'required|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => "El título es obligatorio",
                    'min_length' => "El título debe tener mínimo 5 caracteres",
                    'max_length' => "El título es muy largo (máximo 255 caracteres)"
                ]
            ],
            'imagen' => [
                'rules' => 'max_size[imagen,5000]|is_image[imagen]',
                'errors' => [
                    'max_size' => "La imagen supera el mínimo de peso (5mb)",
                    'is_image' => "El archivo subido no es una imagen válida",
                ]
            ],
            'descripcion' => [
                'rules' => 'required|min_length[30]',
                'errors' => [
                    'required' => "La descripción es obligatoria",
                    'min_length' => "La descripción debe tener mínimo 30 caracteres"
                ]
            ],
            'categoria' => [
                'rules' => 'required|is_not_unique[categorias.ID]',
                'errors' => [
                    'required' => "La categoría es obligatoria",
                    'is_not_unique' => "La categoría no es válida"
                ]
            ]
        ];
        if($this->validateData($formInput,$reglas)){
            return true;
        }else{
            return false;
        }
    }

    private function saveImage(){
        $imagen = $this->request->getFile('imagen');
        if(!empty($imagen)){
            if($imagen->isValid() && !$imagen->hasMoved()){
                $imagen->move('./uploads/imagenesNoticias', $imagen->getRandomName());
                return $imagen->getName();
            }
        }
        return '';
    }

    private function crearNoticia($input, $nombreImagen){
        $data = ['IDusuario' => $this->session->get('id'),
                 'titulo' => $input['titulo'],
                 'descripcion' => $input['descripcion'],
                 'IDcategoria' => $input['categoria']
                ];

        if(isset($input['borrador'])){
            $data['estado'] = 'borrador';
        }elseif(isset($input['validar'])){
            $data['estado'] = 'validar';
        }

        if(!empty($nombreImagen)){
            $data['urlImagen'] = '/uploads/imagenesNoticias/' . $nombreImagen;
        }
            $data['activo'] = 1;

        $fechaActual = Time::now('America/Argentina/Buenos_Aires', 'en_US');
        $data['fecha'] = $fechaActual->toDateString();
        $fechaFin = $fechaActual->addMonths(1);
        $data['fechaFin'] = $fechaFin->toDateTimeString();

        $idNoticia = $this->noticiasModel->createNoticia($data);

        $this->insertHistorial($data, $idNoticia);
    }

    private function insertHistorial($data, $idNoticia){
        $data['IDuser'] = $data['IDusuario'];
        unset($data['IDusuario']);
        $data['IDnoticia'] = $idNoticia;
        $this->historialModel->createHistorial($data);
    }

    private function checkMinBorrador($input){
        if(isset($input['borrador'])){
            $db = \config\Database::connect();
            $builder = $db->table('noticias');
            $builder->where('IDusuario', $this->session->get('id'));
            $builder->where('estado', 'borrador');
            $builder->where('activo', 1);
            $cantdActivasenBorrador =  $builder->countAllResults();
            if($cantdActivasenBorrador > 2){
                $error = 'Se supera la cantidad máxima de noticias activas en borrador (máximo 3)';
                return $error;
            }else{
                return '';
            }
        }else{
            return '';
        }
    }
}

?>