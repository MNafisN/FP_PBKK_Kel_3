<?php

use Models\bahanbakuModel;
use Models\logmasukModel;

class LogmasukController extends ControllerBase
{
    public function indexAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $this->view->masuk = logmasukModel::find();
            $this->view->bahanbaku = bahanbakuModel::find();
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

            $this->view->bahanbaku = bahanbakuModel::find(['columns' => 'distinct nama_bahan']);
            // $this->view->bahanbaku = bahanbakuModel::find();
            
            // var_dump($bahanbaku[0]->nama_bahan);
            // return false;
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function saveAction()
    {
        $logmasuk = new logmasukModel();
        $bahanbaku = new bahanbakuModel();
        
        $cek_id = logmasukModel::findFirst(
            [
                'order' => 'id_log_masuk DESC'
            ]
        );
        $id_log_masuk = $cek_id->id_log_masuk;
        ++$id_log_masuk;
        $nama_bahan = $this->request->getPost('nama_bahan');
        $kondisi_bahan = $this->request->getPost('kondisi_bahan');
        $jumlah_bahan = $this->request->getPost('jumlah_bahan');
        date_default_timezone_set('Asia/Jakarta');
        $date_masuk = date("Y-m-d H:i:s");
        $names = bahanbakuModel::findByNama_bahan($nama_bahan);
        foreach ($names as $bahan) {
            if ($bahan->kondisi_bahan == $kondisi_bahan) {
                $id_bahan = $bahan->id_bahan;
                $jumlah_bahan_terbaru = $jumlah_bahan + $bahan->jumlah_bahan;
            }
        }
        
        if ($jumlah_bahan == '') {
            $this->flashSession->error('Data tidak lengkap');
            return $this->response->redirect('/logmasuk/form');
        }
        else {
            $logmasuk->id_log_masuk = $id_log_masuk;
            $logmasuk->id_bahan = $id_bahan;
            $logmasuk->kondisi_bahan = $kondisi_bahan;
            $logmasuk->jumlah_bahan = $jumlah_bahan;
            $logmasuk->date_masuk = $date_masuk;

            $bahanbaku->id_bahan = $id_bahan;
            $bahanbaku->nama_bahan = $nama_bahan;
            $bahanbaku->kondisi_bahan = $kondisi_bahan;
            $bahanbaku->jumlah_bahan = $jumlah_bahan_terbaru;
            
            if ($logmasuk->save() === false) {
                $messages = $logmasuk->getMessage();

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
                $this->flashSession->success('Bahan baku ditambahkan');
                return $this->response->redirect('/bahanbaku/form');
            }
        }
    }
}