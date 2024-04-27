<?php
namespace App\Controllers\editor;
use App\Controllers\BaseController;

class CrearNoticia extends BaseController{
    

    public function index(){
        return view('/editor/CrearNoticia');
    }

    public function guardar(){

        
        print_r($this->request->getPost());
    }
}

?>