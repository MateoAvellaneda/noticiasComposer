<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        if(!isset($this->session->id)){
            return view('anonimo/homeView');
        }elseif($this->session->rol == 1){
            return view('editor/homeView');
        }elseif($this->session->rol == 2){
            return view('validador/homeView');
        }elseif($this->session->rol == 3){
            return view('editorValidador/homeView');
        }
    }
}
