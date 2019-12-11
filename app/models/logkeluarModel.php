<?php

namespace Models;
use Phalcon\Mvc\Model;

class logkeluarModel extends Model
{
    public function initialize()
    {
        $this->setSource('log_keluar');
    }

    public $id_log_keluar;
    public $id_bahan;
    public $id_user;
    public $kondisi_bahan;
    public $jumlah_bahan;
    public $date_keluar;
}
?>