<?php

namespace Models;
use Phalcon\Mvc\Model;

class simarModel extends Model
{
    public function initialize()
    {
        $this->setSource('simar_user');
    }

    public $id_user;
    public $username;
    public $email;
    public $pass;
    public $nama_karyawan;
    public $role;
}
?>