<?php

namespace App\Controllers;
class CerrarSesion extends BaseController{
    
    public function cerrarSesion(){
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}