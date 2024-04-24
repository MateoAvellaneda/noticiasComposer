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
        $data = $this->request->getPost();
        if (! $this->validateData($data, $reglas)){
            return view('anonimo/iniciarSesionView');
        }else{
            $this->checkUser($data);
        }
    }

    public function checkUser($data){
        $UsuarioModel = new UsuariosModel();
        $where = ['nickname' => $data['nickname'], 'pass' => $data['pass']];
        print_r($UsuarioModel->where($where)->first());
    }
}

?>