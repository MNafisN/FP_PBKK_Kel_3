<?php

use Models\logmasukModel;
use Models\logkeluarModel;
use Models\bahanbakuModel;
use Models\simarModel;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $this->view->masuk = logmasukModel::find();
            $this->view->keluar = logkeluarModel::find();
            $this->view->bahanbaku = bahanbakuModel::find();
            $this->view->users = simarModel::find();
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect('/login');
    }
    public function formAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $this->view->users = sirupatModel::find();
            $this->view->ruangan = ruanganModel::find();
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function saveAction()
    {
        $reservasi = new reservasiModel();
        
        $no_surat = $this->request->getPost('no_surat');
        $id_peminjam = $this->request->getPost('id_peminjam');
        $id_ruangan = $this->request->getPost('id_ruangan');
        $nama_agenda = $this->request->getPost('nama_agenda');
        $deskripsi = $this->request->getPost('deskripsi');
        $date_awal = $this->request->getPost('date_awal');
        $time_awal = $this->request->getPost('time_awal');
        $date_akhir = $this->request->getPost('date_akhir');
        $time_akhir = $this->request->getPost('time_akhir');
        $jumlah_peserta = $this->request->getPost('jumlah_peserta');
        
        $waktu_awal = $date_awal . " " . $time_awal . ":00";
        $waktu_akhir = $date_akhir . " " . $time_akhir . ":00";
        
        $ruangan = ruanganModel::findFirstById_ruangan($id_ruangan);
        $reserved = reservasiModel::findById_ruangan($id_ruangan);
        
        function cekCrash($reserved, $waktu_awal, $waktu_akhir) {
            foreach ($reserved as $reser) {
                if ($waktu_awal >= $reser->waktu_mulai_penggunaan && $waktu_awal < $reser->waktu_akhir_penggunaan) {
                    return 'crash';
                }
                elseif ($waktu_awal < $reser->waktu_mulai_penggunaan && $waktu_akhir > $reser->waktu_mulai_penggunaan) {
                    return 'crash';
                }
            }
            return 'OK';
        }
        function cekDateTime($date_awal, $time_awal, $date_akhir, $time_akhir) {
            if ($date_awal == '' || $time_awal == '' || $date_akhir == '' || $time_akhir == '') {
                return 'time_null';
            }
            return 'OK';
        }
        $is_null = cekDateTime($date_awal, $time_awal, $date_akhir, $time_akhir);
        if ($is_null == 'time_null') {
            $this->flashSession->error('Waktu kosong');
            return $this->response->redirect('/index/form');
        }
        function cekInput($from, $to, $date="now", $ruang, $peserta, $crash) {
            $date = new \DateTime($date);
            $from = new \DateTime($from);
            $to = new \DateTime($to);

            if ($date >= $from || $date >= $to) {
                return 'past_time';
            }
            elseif ($from > $to) {
                return 'opposite';
            }
            elseif ($peserta > $ruang->kapasitas_ruangan) {
                return 'overflow';
            }
            elseif ($crash == 'crash') {
                return 'crash';
            }
            else {
                return 'OK';
            }
        }
        $is_crash = cekCrash($reserved, $waktu_awal, $waktu_akhir);
        $cek = cekInput($waktu_awal, $waktu_akhir, 'now', $ruangan, $jumlah_peserta, $is_crash);

        
        if ($cek == 'past_time') {
            $this->flashSession->error('Waktu telah berlalu');
            return $this->response->redirect('/index/form');
        }
        elseif ($cek == 'opposite') {
            $this->flashSession->error('Waktu rapat berakhir salah');
            return $this->response->redirect('/index/form');
        }
        elseif ($cek == 'overflow') {
            $this->flashSession->error('Jumlah peserta melebihi kuota ruangan');
            return $this->response->redirect('/index/form');
        }
        elseif ($cek == 'crash') {
            $this->flashSession->error('Jadwal bentrok');
            return $this->response->redirect('/index/form');
        }
        elseif ($cek == 'OK') {
            $reservasi->no_surat = $no_surat;
            $reservasi->id_peminjam = $id_peminjam;
            $reservasi->id_ruangan = $id_ruangan;
            $reservasi->nama_agenda = $nama_agenda;
            $reservasi->deskripsi = $deskripsi;
            $reservasi->waktu_mulai_penggunaan = $waktu_awal;
            $reservasi->waktu_akhir_penggunaan = $waktu_akhir;
            $reservasi->jumlah_peserta = $jumlah_peserta;
            $reservasi->status_reservasi = 'Disetujui';

            if ($reservasi->save() === false)
            {
                $messages = $reservasi->getMessages();
        
                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
            
                return $this->response->redirect('/index/form');
            } 
            else 
            {
                $this->flashSession->success('Reservasi ditambahkan');

                return $this->response->redirect('/index/form');
            }
        }

        $this->view->disable();
    }
    public function detailAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $no_surat = $this->request->getPost('no_surat');
            $id_peminjam = $this->request->getPost('id_peminjam');
            $id_ruangan = $this->request->getPost('id_ruangan');
            
            $this->view->reservasi = reservasiModel::findFirstByNo_surat($no_surat);
            $this->view->ruangan = ruanganModel::findFirstById_ruangan($id_ruangan);
            $this->view->users = sirupatModel::findFirstById_user($id_peminjam);
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function deleteAction() 
    {
        $no_surat = $this->request->getPost('no_surat');
        $reservasi = reservasiModel::findFirstByNo_surat($no_surat);

        if ($reservasi !== false) {
            if ($reservasi->delete() === false)
            {
                $messages = $reservasi->getMessages();
        
                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
            
                return $this->response->redirect('/index/detail');
            } 
            else 
            {
                return $this->response->redirect('/index');
            }
        }
    }
}

