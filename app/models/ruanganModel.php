<?php

namespace Models;
use Phalcon\Mvc\Model;

class ruanganModel extends Model
{
    public function initialize()
    {
        $this->setSource('data_ruangan');
    }

    public $id_ruangan;
    public $nama_ruangan;
    public $lokasi_ruangan;
    public $kapasitas_ruangan;
}
?>