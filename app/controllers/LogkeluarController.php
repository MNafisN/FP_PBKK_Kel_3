<?php

use Models\bahanbakuModel;
use Models\simarModel;
use Models\logkeluarModel;

class LogkeluarController extends ControllerBase
{
    public function indexAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $this->view->keluar = logkeluarModel::find();
            $this->view->bahanbaku = bahanbakuModel::find();
            $this->view->users = simarModel::find();

            // $usrname = $this->session->get("login");
            // $usrname2 = $usrname['username'];
            // $this->view->users2 = simarModel::findByUsername($usrname2);
            // var_dump($users2); return false;
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function formAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $this->view->users = simarModel::find();
            $this->view->bahanbaku = bahanbakuModel::find(['columns' => 'distinct nama_bahan']);
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function saveAction()
    {
        $logkeluar = new logkeluarModel();
        $bahanbaku = new bahanbakuModel();
        
        $cek_id = logkeluarModel::findFirst(
            [
                'order' => 'id_log_keluar DESC'
            ]
        );
        $id_log_keluar = $cek_id->id_log_keluar;
        ++$id_log_keluar;
        $username = $this->request->getPost('username');
        $user = simarModel::findFirstByUsername($username);
        $id_user = $user->id_user;
        $nama_bahan = $this->request->getPost('nama_bahan');
        $kondisi_bahan = $this->request->getPost('kondisi_bahan');
        $jumlah_bahan = $this->request->getPost('jumlah_bahan');
        date_default_timezone_set('Asia/Jakarta');
        $date_keluar = date("Y-m-d H:i:s");
        $names = bahanbakuModel::findByNama_bahan($nama_bahan);
        foreach ($names as $bahan) {
            if ($bahan->kondisi_bahan == $kondisi_bahan) {
                $id_bahan = $bahan->id_bahan;
                if ($jumlah_bahan > $bahan->jumlah_bahan) {
                    $this->flashSession->error('Stok tidak cukup');
                    return $this->response->redirect('/logkeluar/form');
                }
                $jumlah_bahan_terbaru = $bahan->jumlah_bahan - $jumlah_bahan;
            }
        }
        
        if ($jumlah_bahan == '') {
            $this->flashSession->error('Data tidak lengkap');
            return $this->response->redirect('/logkeluar/form');
        }
        else {
            $logkeluar->id_log_keluar = $id_log_keluar;
            $logkeluar->id_bahan = $id_bahan;
            $logkeluar->id_user = $id_user;
            $logkeluar->kondisi_bahan = $kondisi_bahan;
            $logkeluar->jumlah_bahan = $jumlah_bahan;
            $logkeluar->date_keluar = $date_keluar;

            $bahanbaku->id_bahan = $id_bahan;
            $bahanbaku->nama_bahan = $nama_bahan;
            $bahanbaku->kondisi_bahan = $kondisi_bahan;
            $bahanbaku->jumlah_bahan = $jumlah_bahan_terbaru;
            
            if ($logkeluar->save() === false) {
                $messages = $logkeluar->getMessage();

                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
            
                return $this->response->redirect('/bahanbaku/form');
            }
            elseif ($bahanbaku->save() === false) {
                $messages = $bahanbaku->getMessages();
        
                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
            
                return $this->response->redirect('/bahanbaku/form');
            }
            else {
                $this->flashSession->success('Bahan baku diambil');
                return $this->response->redirect('/logkeluar/form');
            }
        }
    }
}