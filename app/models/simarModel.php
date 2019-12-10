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

/*    public function auth($username, $password)
    {
        $pass = md5($password);

        $query = sirupatModel::findFirstByUsername($username);

        if ($query)
        {
            return $query;
        }// query()
        //     ->where('username = :username:')
        //     ->andWhere('pass = :pass:')
        //     ->execute();
        
        // if ($query)
        // {
        //     return $query;
        // }
        // else
        // {
        //     return "kamu dapat error :(";
        // }

    } */
}
?>