<?php

class logModel extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getUser($username, $password){
        $datas = $this->db->query("SELECT * from users " .
                "WHERE username = '$username' " .
                "AND password = '" . Hash::getHash($password) . "'");
        return $datas->fetch();
    }

}