<?php

namespace Models;
use Phalcon\Mvc\Model;

class fasilitasModel extends Model
{
    public function initialize()
    {
        $this->setSource('fasilitas_ruangan');
    }

    public $id_fasilias;
    public $id_ruangan;
    public $nama_fasilitas;
    public $spesifikasi;
}
?>