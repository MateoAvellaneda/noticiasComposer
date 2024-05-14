<?php

namespace App\Controllers\validador;

use App\Controllers\BaseController;
use App\Models\NoticiasModel;
use App\Models\HistorialModel;

class MisValidaciones extends BaseController
{
    private $noticiasModel;
    private $historialModel;

    public function __construct()
    {
        $this->noticiasModel = new NoticiasModel();
        $this->historialModel = new HistorialModel();
    }

    private function checkSession()
    {
        $id = $this->session->get('id');
        if (is_null($id)) {
            return $this->response->redirect(site_url());
        } elseif ($this->session->get('rol') == 1) {
            return $this->response->redirect(site_url());
        }
    }

    public function misValidaciones()
    {
        $this->checkSession();
        $data = ['noticias' => ''];
        $data['noticias'] = $this->getMisValidadaciones();
        return view('validador/misValidacionesView', $data);
    }

    private function getMisValidadaciones()
    {
        $idUsuario = $this->session->get('id');
        $db = \config\Database::connect();
        $builder = $db->table('noticias');
        $builder->select('noticias.ID, noticias.titulo, noticias.estado,noticias.retroceder ,usuarios.fullname');
        $builder->join('usuarios', 'noticias.IDusuario = usuarios.ID');
        $builder->join('historial', 'noticias.ID = historial.IDnoticia');
        $estados = ['publicada', 'rechazada'];
        $builder->whereIn('noticias.estado',$estados);
        $builder->where('historial.IDuser', $idUsuario);
        $builder->where('numCambio = (SELECT MAX(numCambio) FROM historial WHERE IDnoticia = noticias.ID)', NULL, FALSE);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
