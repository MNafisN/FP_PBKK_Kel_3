<?php

namespace Models;
use Phalcon\Mvc\Model;

class logmasukModel extends Model
{
    public function initialize()
    {
        $this->setSource('log_masuk');
    }

    public $id_log_masuk;
    public $id_bahan;
    public $kondisi_bahan;
    public $jumlah_bahan;
    public $date_masuk;
}
?>