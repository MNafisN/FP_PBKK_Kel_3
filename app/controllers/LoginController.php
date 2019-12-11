<?php

use Models\simarModel;

class LoginController extends ControllerBase
{
    public function indexAction()
    {
        $this->assets->addCss('css/style.css');
        $this->assets->addCss('css/table.css');
    }
    public function checkAction()
    {
        $this->assets->addCss('css/style.css');
        $this->assets->addCss('css/table.css');
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('pass');
        $pass = md5($password);

        $queryLogin = simarModel::findFirstByUsername($username);
        
        if ($pass == $queryLogin->pass)
        {
            $this->session->set('login', ['username' => $queryLogin->username]);

            $this->response->redirect('/index');
        }
        elseif (!$queryLogin)            
        {
            $this->flashSession->error('Username dan password tidak cocok');
            return $this->response->redirect('/login');
        }
    }
}