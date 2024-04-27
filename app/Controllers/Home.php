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
        }else{
            return view('anonimo/homeView');
        }
    }
}
