<?php
namespace App\Controllers\editor;
use App\Controllers\BaseController;

class CrearNoticia extends BaseController{
    

    public function index(){
        return view('/editor/CrearNoticia');
    }
}

?>