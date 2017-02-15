<?php

class regModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function varifyusername($username) {
        $id = $this->db->query("SELECT id, code FROM users WHERE username = '$username'");

        return $id->fetch();
    }

    public function varifyEmail($email) {
        $id = $this->db->query("SELECT id FROM users WHERE email = '$email'");

        if ($id->fetch()) {
            return TRUE;
        }

        return FALSE;
    }

    public function addUser($f_name, $l_name, $email, $password, $username) {
        $password = Hash::getHash($password);
        $username = 'alan_' . $username;
        $role = '4';
        $random = rand(124578, 999999999);

        $this->db->prepare("INSERT INTO users VALUES (null, :f_name, :l_name, :email, :password, :username, 'active', :role, 0, now(), :code)")
                ->execute(
                        array(
                            ':f_name' => $f_name,
                            ':l_name' => $l_name,
                            ':email' => $email,
                            ':password' => $password,
                            ':username' => $username,
                            ':role' => $role,
                            'code' => $random
        ));
    }
    
    public function getUser($id, $code){
        $username = $this->db->query("SELECT * from users WHERE id = '$id' and code = '$code'");
        return $username->fetch();
    }
    
    public function activeUser($id, $code){
        $username = $this->db->query("UPDATE users SET status = 1 WHERE id = '$id' and code = '$code'");
        return $username->fetch();
    }

    public function siteInfo() {
        $siteInfo = $this->db->query("SELECT * FROM `site_info`");

        return $siteInfo;
    }
}
