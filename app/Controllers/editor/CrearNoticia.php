<?php
namespace App\Controllers\editor;
use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;
use CodeIgniter\I18n\Time;
class CrearNoticia extends BaseController{
    protected $helpers = ['form'];
    private $noticiasModel;
    private $historialModel;

    public function __construct(){
        $this->noticiasModel = new NoticiasModel();
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

    public function index(){
        $this->checkSession();
        return view('/editor/CrearNoticia');
    }

    public function guardar(){
        $this->checkSession();
        $formInput = $this->request->getPost();
        if($this->validarCampos($formInput)){
            $nombreImagen = $this->saveImage();
            $this->crearNoticia($formInput, $nombreImagen);
            echo "holavarria";
        }else{
            return view('editor/CrearNoticia');
        }
        // if(!$this->validarCampos($formInput)){

        // }
    }

    private function validarCampos($formInput){
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

        if(isset($input['activado'])){
            $data['activo'] = 1;
        }else{
            $data['activo'] = 0;
        }
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
}

?>