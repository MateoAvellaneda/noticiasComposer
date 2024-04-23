<?php

namespace App\Controllers\anonimo;
use App\Controllers\BaseController;

class Registrarse extends BaseController
{
    public function index(){
        return view('anonimo/registrarseView.php');
    }
}

?>