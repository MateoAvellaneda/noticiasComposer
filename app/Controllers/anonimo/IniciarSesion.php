<?php

namespace App\Controllers\anonimo;
use App\Controllers\BaseController;
use App\Models\UsuariosModel;
class IniciarSesion extends BaseController
{
    protected $helpers = ['form'];

    public function __construct(){
    }

    public function index(){
        return view('anonimo/iniciarSesionView');
    }

    public function iniciarSesion(){

        $reglas = [
            'nickname' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => "El nombre de usuario es obligatorio",
                    'min_length' => "El nombre debe tener minimo 5 caracteres",
                    'max_length' => "El nombre debe tener maximo 20 caracteres"
                ]
            ],
            'pass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "La contrasenia es obligatoria"
                ]
            ]
        ];
        if (!$this->validate($reglas)){ 
            return view('anonimo/iniciarSesionView');
        }else{
            $data = $this->request->getPost();
            return $this->checkSesion($data);
        }
    }

    private function checkSesion($data){
        $usuariosModel = new UsuariosModel();
        $respuesta = $usuariosModel->checkUser($data['nickname'], $data['pass']);
        if(empty($respuesta)){
            return view('anonimo/iniciarSesionView', ['error' => 'nombre de usuario o contrasenia incorrecta.']);
        }else{
             if(password_verify($data['pass'],$respuesta['passw'])){
                $this->session->set('id', $respuesta['ID']);
                $this->session->set('rol', $respuesta['rol']);
                return redirect()->to(base_url());
             }else{
                return view('anonimo/iniciarSesionView', ['error' => 'nombre de usuario o contrasenia incorrecta.']);
             }

        }
    }

    
}

?>