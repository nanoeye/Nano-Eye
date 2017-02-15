<?php

class indexModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setProPic($id, $pro_pic)
    {
        $this->db->query("UPDATE users_info SET `pro_pic` = '$pro_pic' WHERE `id` = '$id'");
    }

    public function getUserId($username)
    {
        $id = $this->db->prepare("SELECT id FROM users WHERE username = '$username'");
        $id->execute();

        return $id->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsername($username)
    {
        $sql =  $this->db->query("SELECT `username` FROM `users` WHERE `username` = '$username'");

        if($sql->fetch())
        {
            return TRUE;
        }

        return FALSE;
    }

    public function getUsers()
    {
        $users = $this->db->query("SELECT u.*, ui.*, r.role FROM users u, users_info ui, roles r WHERE u.id = ui.id AND u.role = r.id_role");

        return $users->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($userId)
    {
        $user = $this->db->query(
            "SELECT u.*, ui.*, r.role FROM users u, users_info ui, roles r " .
            "WHERE u.role = r.id_role AND u.id = '$userId' "
        );

        return $user->fetch();
    }

}