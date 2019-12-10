<?php

use Models\fasilitasModel;
use Models\ruanganModel;

class FasilitasController extends ControllerBase
{
    public function indexAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $this->view->fasilitas = fasilitasModel::find();
            $this->view->ruangan = ruanganModel::find();
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

            $this->view->ruangan = ruanganModel::find();
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function saveAction()
    {
        $fasilitas = new fasilitasModel();

        $nama_fasilitas = $this->request->getPost('nama_fasilitas');
        $id_ruangan = $this->request->getPost('id_ruangan');
        $spesifikasi = $this->request->getPost('spesifikasi');

        $cek_id = fasilitasModel::findFirst(
            [
                'order' => 'id_fasilitas DESC'
            ]
        );
        $latest_id = $cek_id->id_fasilitas;
        
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
    
        $id_fasilitas = 'FS' . $zeroes . "" . $id;

        if ($nama_fasilitas == '' || $id_ruangan == '' || $spesifikasi == '') {
            $this->flashSession->error('Data tidak lengkap');
            return $this->response->redirect('/fasilitas/form');
        }
        else {
            $fasilitas->id_fasilitas = $id_fasilitas;
            $fasilitas->id_ruangan = $id_ruangan;
            $fasilitas->nama_fasilitas = $nama_fasilitas;
            $fasilitas->spesifikasi = $spesifikasi;

            if ($fasilitas->save() === false) {
                $messages = $fasilitas->getMessages();
        
                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
            
                return $this->response->redirect('/fasilitas/form');
            }
            else {
                $this->flashSession->success('Fasilitas ditambahkan');
                return $this->response->redirect('/fasilitas/form');
            }
        }
        // echo $id_fasilitas;
        // return false;
    }
    public function detailAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $id_fasilitas = $this->request->getPost('id_fasilitas');
            $id_ruangan = $this->request->getPost('id_ruangan');

            $this->view->fasilitas = fasilitasModel::findFirstById_fasilitas($id_fasilitas);
            $this->view->ruangan = ruanganModel::findFirstById_ruangan($id_ruangan);
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function deleteAction() 
    {
        $id_fasilitas = $this->request->getPost('id_fasilitas');
        $fasilitas = fasilitasModel::findFirstById_fasilitas($id_fasilitas);

        if ($fasilitas !== false) {
            if ($fasilitas->delete() === false)
            {
                $messages = $fasilitas->getMessages();
        
                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
            
                return $this->response->redirect('/fasilitas/detail');
            } 
            else 
            {
                return $this->response->redirect('/fasilitas');
            }
        }
    }
}