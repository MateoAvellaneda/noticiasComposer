<?php

namespace App\Controllers\anonimo;
use App\Controllers\BaseController;
use App\Models\UsuariosModel;
class Registrarse extends BaseController
{
    protected $helpers = ['form'];
    public function index(){
        return view('anonimo/registrarseView.php');
    }

    public function registrarUsuario(){
        $reglas = [
            'nickname' => [
                'rules' => 'required|min_length[5]|max_length[20]|is_unique[usuarios.nickname]',
                'errors' => [
                    'required' => "El nombre de usuario es obligatorio",
                    'min_length' => "El nombre debe tener minimo 5 caracteres",
                    'max_length' => "El nombre debe tener maximo 20 caracteres",
                    'is_unique' => "Ya existe un usuario con ese nombre"
                ]
            ],
            'pass' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => "La contrasenia es obligatoria",
                    'min_length' => "La contrasenia debe tener minimo 5 caracteres",
                    'max_length' => "La contrasenia debe tener maximo 20 caracteres"
                ]
            ],
            'pass2' => [
                'rules' => 'required|min_length[5]|max_length[20]|matches[pass]',
                'errors' => [
                    'required' => "La contrasenia es obligatoria",
                    'min_length' => "La contrasenia debe tener minimo 5 caracteres",
                    'max_length' => "La contrasenia debe tener maximo 20 caracteres",
                    'matches' => "Las contrasenias deben coincidir"
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[usuarios.email]',
                'errors' => [
                    'required' => "El correo electronico es obligatorio",
                    'valid_email' => "Debe colocar una direccion de correo electronico valida",
                    'is_unique' => "Ya existe un usuario con ese correo electronico"
                ]
            ],
            'nombre' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'alpha_space' => 'El nombre solo puede tener letras y espacios',
                    'required' => 'El nombre es obligatorio'
                ]
            ],
            'apellido' => [
                'rules' => 'required|alpha',
                'errors' => [
                    'alpha_space' => 'El apellido solo puede tener letras',
                    'required' => 'El apellido es obligatorio'
                ]
            ],
            'rol' => [
                'rules' => 'required|in_list[1,2,3]',
                'errors' => [
                    'required' => 'El rol es obligatorio',
                    'in_list' => 'El rol ingresado no es valido'
                ]
            ]
        ];
        if (!$this->validate($reglas)){ 
            return view('anonimo/registrarseView');
        }else{
            $usuariosModel = new UsuariosModel();
            $formInput = $this->request->getPost();
            $data = [
                'nickname' => $formInput['nickname'],
                'passw' => $formInput['pass'],
                'email' => $formInput['email'],
                'fullname' => ($formInput['nombre'] . ' ' . $formInput['apellido']),
                'rol' => $formInput['rol']
            ];
            if($usuariosModel->createUser($data)){
                echo '<h1>Exitooooo</h1>';
            }else{
                echo '<h1>Muy maaaaal</h1>';
            }
        }
    }
}

?>