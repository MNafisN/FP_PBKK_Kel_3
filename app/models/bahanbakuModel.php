<?php

namespace Models;
use Phalcon\Mvc\Model;

class bahanbakuModel extends Model
{
    public function initialize()
    {
        $this->setSource('data_bahan_baku');
    }

    public $id_bahan;
    public $nama_bahan;
    public $kondisi_bahan;
    public $jumlah_bahan;
}
?>