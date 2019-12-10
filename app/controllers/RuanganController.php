<?php

use Models\ruanganModel;

class RuanganController extends ControllerBase
{
    public function indexAction()
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
        $ruangan = new ruanganModel();

        $nama_ruangan = $this->request->getPost('nama_ruangan');
        $lokasi_ruangan = $this->request->getPost('lokasi_ruangan');
        $kapasitas_ruangan = $this->request->getPost('kapasitas_ruangan');

        $cek_id = ruanganModel::findFirst(
            [
                'order' => 'id_ruangan DESC'
            ]
        );
        $latest_id = $cek_id->id_ruangan; 
        
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
    
        $id_ruangan = 'A' . $zeroes . "" . $id;

        if ($nama_ruangan == '' || $lokasi_ruangan == '' || $kapasitas_ruangan == '') {
            $this->flashSession->error('Data tidak lengkap');
            return $this->response->redirect('/ruangan/form');
        }
        else 
        {
            $ruangan->id_ruangan = $id_ruangan;
            $ruangan->nama_ruangan = $nama_ruangan;
            $ruangan->lokasi_ruangan = $lokasi_ruangan;
            $ruangan->kapasitas_ruangan = $kapasitas_ruangan;

            if ($ruangan->save() === false) {
                $messages = $ruangan->getMessages();
        
                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
            
                return $this->response->redirect('/ruangan/form');
            }
            else {
                $this->flashSession->success('Ruangan ditambahkan');
                return $this->response->redirect('/ruangan/form');
            }
        }
        // return false;
    }
    public function detailAction()
    {
        if ($this->session->has("login"))
        {
            $this->assets->addCss('css/style.css');
            $this->assets->addCss('css/table.css');

            $id_ruangan = $this->request->getPost('id_ruangan');
            
            $this->view->ruangan = ruanganModel::findFirstById_ruangan($id_ruangan);
        }
        else
        {
            $this->response->redirect('/login');
        }
    }
    public function deleteAction() 
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $ruangan = ruanganModel::findFirstById_ruangan($id_ruangan);

        if ($ruangan !== false) {
            if ($ruangan->delete() === false)
            {
                $messages = $ruangan->getMessages();
        
                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
            
                return $this->response->redirect('/ruangan/detail');
            } 
            else 
            {
                return $this->response->redirect('/ruangan');
            }
        }
    }
}