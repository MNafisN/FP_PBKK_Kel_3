<?php

use Models\bahanbakuModel;

class BahanbakuController extends ControllerBase
{
    public function indexAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

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
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function saveAction()
    {
        $bahanbaku = new bahanbakuModel();
        $nama_bahan = $this->request->getPost('nama_bahan');
        $kondisi_bahan = $this->request->getPost('kondisi_bahan');
        $jumlah_bahan = $this->request->getPost('jumlah_bahan');
        
        $cek_id = bahanbakuModel::findFirst(
            [
                'order' => 'id_bahan DESC'
            ]
        );
        $latest_id = $cek_id->id_bahan;
        
        $str_id = strlen($latest_id);
        $zeroes = array();
        for ($i=0; $i<$str_id; $i++) {
            if ($latest_id[$i] == '0') {
                array_push($zeroes, $latest_id[$i]);
            }
        }
        $zeroes = implode($zeroes);
    
        $parts = explode('0', $latest_id);
        end($parts);
        $id = current($parts);
        reset($parts);
        ++$id;
    
        $id_bahan = 'SY' . $zeroes . "" . $id;

        $cek_duplikat = bahanbakuModel::findFirstByNama_bahan($nama_bahan);
        
        if ($nama_bahan == '' || $jumlah_bahan == '') {
            $this->flashSession->error('Data tidak lengkap');
            return $this->response->redirect('/bahanbaku/form');
        }
        elseif ($cek_duplikat->kondisi_bahan == $kondisi_bahan) {
            $this->flashSession->warning('Data bahan baku sudah terdaftar sebelumnya');
            return $this->response->redirect('/bahanbaku/form');
        }
        else {
            $bahanbaku->id_bahan = $id_bahan;
            $bahanbaku->nama_bahan = $nama_bahan;
            $bahanbaku->kondisi_bahan = $kondisi_bahan;
            $bahanbaku->jumlah_bahan = $jumlah_bahan;
            if ($bahanbaku->save() === false) {
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