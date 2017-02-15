<?php

class rolesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRole($roleId)
    {
        $role = $this->db->query("SELECT * FROM roles WHERE id_role = '$roleId' ");

        return $role->fetch();
    }

    public function insertRole($role)
    {
        $this->db->prepare("INSERT INTO roles VALUES (null, :role)")
            ->execute(
                array(
                    ':role' => $role
                ));

    }

    public function editRole($roleId, $role)
    {
        $id = (int) $roleId;

        $this->db->prepare("UPDATE roles SET role = :role WHERE id_role = :id")
            ->execute(
                array(
                    ':id' => $id,
                    ':role' => $role
                ));

    }

    public function deleteRole($id)
    {
        $id = (int) $id;
        $this->db->query("DELETE from roles where id_role = $id");
    }
    
    public function getRoles()
    {
        $role = $this->db->query("SELECT * FROM roles");

        return $role->fetchAll();
    }
}