<?php

namespace Models;
use Phalcon\Mvc\Model;

class reservasiModel extends Model
{
    public function initialize()
    {
        $this->setSource('reservasi_ruangan');
    }

    public $no_surat;
    public $id_peminjam;
    public $id_ruangan;
    public $nama_agenda;
    public $deskripsi;
    public $waktu_mulai_penggunaan;
    public $waktu_akhir_penggunaan;
    public $jumlah_peserta;
    public $status_reservasi;
}
?>