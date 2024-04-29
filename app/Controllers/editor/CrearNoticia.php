<?php
namespace App\Controllers\editor;
use App\Controllers\BaseController;

class CrearNoticia extends BaseController{
    protected $helpers = ['form'];

    public function index(){
        return view('/editor/CrearNoticia');
    }

    public function guardar(){

        $formInput = $this->request->getPost();
        //print_r($formInput);
        print_r($this->validarCampos($formInput));
        exit;
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
                'rules' => 'max_size[imagen,5000]|is_image[image]',
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
                'rules' => 'required|is_not_unique[categorias.nombre]',
                'errors' => [
                    'required' => "La categoria es obligatoria",
                    'is_not_unique' => "La categoria no es valida"
                ]
            ]
        ];
        if(!$this->validateData($formInput,$reglas)){
            return 'hola';
        }else{
            return 'chau';
        }
    }
}

?>