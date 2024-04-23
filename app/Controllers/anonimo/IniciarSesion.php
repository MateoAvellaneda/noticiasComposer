<?php

namespace App\Controllers\anonimo;
use App\Controllers\BaseController;

class IniciarSesion extends BaseController
{
    public function index(){
        return view('anonimo/iniciarSesionView');
    }
}

?>