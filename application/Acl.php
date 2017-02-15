<?php

class ACL {

    private $registry;
    private $db;
    private $id;
    private $role;
    private $permisions;

    public function __construct($id = FALSE)
    {
        if($id){
            $this->id = (int) $id;
        }
        else {
            if(Session::get('id_user')){
                $this->id = Session::get('id_user');
            }
            else {
                $this->id = 0;
            }
        }

        $this->registry = Registry::getInstance();
        $this->db = $this->registry->db;
        $this->role = $this->getRole();
        $this->permisions = $this->getPermisionsRole();
        $this->compilerAcl();
    }

    public function compilerAcl()
    {
        $this->permisions = array_merge(
            $this->permisions,
            $this->getPermisionsUser()
        );
    }

    public function getRole()
    {
        $role = $this->db->query(
            "SELECT role FROM users " .
            "WHERE id = '{$this->id}'"
        );

        $role = $role->fetch();
        return $role['role'];
    }

    public function getPermisionsRoleId()
    {
        $ids = $this->db->query(
            "SELECT permision FROM permisions_role " .
            "WHERE role = '{$this->role}'"
        );

        $ids = $ids->fetchAll(PDO::FETCH_ASSOC); 
        
        $id = array();
        
        for($i = 0; $i < count($ids); $i++){
            $id[] = $ids[$i]['permision'];
        }

        return $id;
    }

    public function getPermisionsRole()
    {
        $permisions = $this->db->query(
            "SELECT * FROM permisions_role " .
            "WHERE role = '{$this->role}'"
        );

        $permisions = $permisions->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for($i = 0; $i < count($permisions); $i++){
            $key = $this->getPermisionKey($permisions[$i]['permision']);
            if($key == '') {continue;}

            if ($permisions[$i]['value'] == 1){
                $v = true;
            }
            else {
                $v = false;
            }

            $data[$key] = array(
                'key'   =>  $key,
                'permision' => $this->getPermisionNumber($permisions[$i]['permision']),
                'value' => $v,
                'inherit'  => true,
                'id'    =>  $permisions[$i]['permision']
            );
        }

        return $data;
    }

    public function getPermisionKey($permisionID)
    {
        $permisionID = (int) $permisionID;

        $key = $this->db->query(
            "SELECT `key` FROM permisions " .
            "WHERE id_permision = '{$permisionID}'"
        );

        $key = $key->fetch();
        return $key['key'];
    }

    public function getPermisionNumber($permisionID)
    {
        $permisionID = (int) $permisionID;

        $key = $this->db->query(
            "SELECT `permision` FROM permisions " .
            "WHERE id_permision = '{$permisionID}'"
        );

        $key = $key->fetch();
        return $key['permision'];
    }

    public function getPermisionsUser()
    {
        $ids = $this->getPermisionsRoleId();

        if(count($ids))
        {

        $im_var = implode(", ", $ids);
        
        $permisions = $this->db->query("SELECT * FROM permisions_user WHERE user = {$this->id} AND " .
            "permision in (" . $im_var .  ")"
        );

        $permisions = $permisions->fetchAll(PDO::FETCH_ASSOC);  
        }
        
        else{
            $permisions = array();
        }


        $data = array();

        for($i = 0; $i < count($permisions); $i++){
            $key = $this->getPermisionKey($permisions[$i]['permision']);
            if($key == '') {continue;}

            if ($permisions[$i]['value'] == 1){
                $v = true;
            }
            else {
                $v = false;
            }

            $data[$key] = array(
                'key'   =>  $key,
                'permision' => $this->getPermisionNumber($permisions[$i]['permision']),
                'value' => $v,
                'inherit'  => false, 
                'id'    =>  $permisions[$i]['permision']
            );
        }

        return $data;
    }

    public function getPermisions()
    {
        if(isset($this->permisions) && count($this->permisions))
            return $this->permisions;
    }
    
    public function permision($key)
    {
        if(array_key_exists($key, $this->permisions)){
            if($this->permisions[$key]['value'] == true || $this->permisions[$key]['value'] == 1){
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    public function access($key)
    {

        if($this->permision($key)){
            Session::sessionTime();

            return;
        }
        
        header('location:' . BASE_URL . 'error/access/404');
        exit;
    }

}
