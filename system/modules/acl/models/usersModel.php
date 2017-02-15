<?php

class usersModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function insertUser($f_name, $l_name, $email, $password, $username, $dob, $gender, $role, $profession)
    {
        $password = Hash::getHash($password);
        $username = 'alan_' . $username;
        $code     = rand(1245786124, 9999999999);

        if(empty($l_name)) {$lt_name = null;} else {$lt_name = "'" . $l_name . "'";}
        if(empty($profession)) {$prof = null;} else {$prof = "'" . $profession . "'";}

        $basic  = "INSERT INTO users VALUES (null, '$f_name', $lt_name, '$email', '$password', '$username', 'active', '$role', '1', now(), '$code')";
        $add    = "INSERT INTO users_info VALUES (null, '$dob', '$gender', $prof, NULL)";

        $i = $this->db->prepare($basic);
        $i->execute();

        $i = $this->db->prepare($add);
        $i->execute();
    }

    public function editUser($id, $f_name, $l_name, $email, $password, $username, $dob, $gender, $role, $profession, $activity, $r_date)
    {
        $con = array();
        $cont= array();

        if(!empty($f_name)) { $con[] = "`f_name` = '$f_name'";}

        if(!empty($l_name)) { $con[] = "`l_name` = '$l_name'";}

        if(!empty($email)) { $con[] = "`email` = '$email'";}

        if(!empty($password))
        {
            $password = Hash::getHash($password);
            $con[] = "`password` = '$password'";
        }

        if(!empty($username)) { $con[] = "`username` = '$username'";}

        if(!empty($dob)) { $cont[] = "`dob` = '$dob'";}

        if(!empty($gender)) { $cont[] = "`gender` = '$gender'";}

        if(!empty($role)) { $con[] = "`role` = '$role'";}

        if(!empty($profession)) { $cont[] = "`profession` = '$profession'";}

        if(!empty($activity)) { $con[] = "`activity` = '$activity'";}

        if(!empty($r_date)) { $con[] = "`r_date` = '$r_date'";}

        if(is_array($con) && is_array($cont)){
            $var1 = implode(',' , $con);
            $var2 = implode(',' , $cont);
        }

        $this->db->query("UPDATE users SET $var1 WHERE `id` = $id; UPDATE users_info SET $var2 WHERE `id` = $id");
    }

    public function deleteUser($id)
    {
        $id = (int) $id;
        $this->db->query("DELETE from users where id = $id");
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
            "SELECT u.f_name, u.l_name, r.role FROM users u, roles r " .
            "WHERE u.role = r.id_role AND u.id = '$userId' "
        );

        return $user->fetch();
    }

    public function getEUser($userId)
    {
        $user = $this->db->query(
            "SELECT u.*, ui.*, r.role FROM users u, users_info ui, roles r " .
            "WHERE u.role = r.id_role AND u.id = '$userId' AND ui.id = '$userId'"
        );

        return $user->fetch();
    }

    public function getRoles()
    {
        $role = $this->db->query("SELECT * FROM roles");

        return $role->fetchAll(PDO::FETCH_ASSOC);
    }

}
