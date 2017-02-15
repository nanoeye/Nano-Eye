<?php

class permissionsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertPermission($permission, $key)
    {
        $this->db->prepare("INSERT INTO permisions VALUES (null, :permission, :key)")
            ->execute(
                array(
                    ':permission'   => $permission,
                    ':key'          =>  $key
                ));

    }

    public function editPermission($id, $permission, $key)
    {
        $id = (int) $id;

        $this->db->prepare("UPDATE permisions SET `permision` = :permission, `key` = :key WHERE `id_permision` = :id")
            ->execute(
                array(
                    ':id'           => $id,
                    ':permission'   => $permission,
                    ':key'          => $key
                ));

    }

    public function deletePermission($id)
    {
        $id = (int) $id;
        $this->db->query("DELETE from permisions where id_permision = $id");
    }

    public function getRole($roleId)
    {
        $role = $this->db->query("SELECT * FROM roles WHERE id_role = '$roleId' ");

        return $role->fetch();
    }

    public function getPermisions($permisionID)
    {
        $permisionID = (int)$permisionID;

        $key = $this->db->query(
            "SELECT * FROM permisions " .
            "WHERE id_permision = '{$permisionID}'"
        );

        return $key->fetch();
    }

    public function getPermisionsAll()
    {
        $permisions = $this->db->query("SELECT * FROM permisions");
        $permisions = $permisions->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($permisions); $i++) {
            if ($permisions[$i]['key'] == '') {
                continue;
            }

            $data[$permisions[$i]['key']] = array(
                'key' => $permisions[$i]['key'],
                'value' => 'x',
                'number' => $permisions[$i]['permision'],
                'id' => $permisions[$i]['id_permision']
            );
        }

        return $data;
    }

    public function getPermisionsRole($roleId)
    {
        $data = array();

        $permisions = $this->db->query("SELECT * FROM permisions_role WHERE role = '$roleId'");
        $permisions = $permisions->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($permisions); $i++) {
            $key = $this->getPermisionKey($permisions[$i]['permision']);

            if ($key == '') {
                continue;
            }

            if ($permisions[$i]['value'] == 1) {
                $v = 1;
            } else {
                $v = 0;
            }

            $data[$key] = array(
                'key' => $key,
                'value' => $v,
                'number' => $this->getPermisionNumber($permisions[$i]['permision']),
                'id' => $permisions[$i]['permision']
            );
        }

        $data = array_merge($this->getPermisionsAll(), $data);
        return $data;
    }

    public function deletePermisionRole($roleId, $permisionId)
    {
        $this->db->query("DELETE FROM permisions_role " .
            "WHERE role = '$roleId' AND permision = '$permisionId'");
    }

    public function editPermisionRole($roleId, $permisionId, $value)
    {
        $this->db->query("REPLACE INTO permisions_role " .
            "SET role = '$roleId', permision = '$permisionId', value = '$value'");
    }

    public function getPermisionKey($permisionID)
    {
        $permisionID = (int)$permisionID;

        $key = $this->db->query(
            "SELECT `key` FROM permisions " .
            "WHERE id_permision = '{$permisionID}'"
        );

        $key = $key->fetch();
        return $key['key'];
    }

    public function getPermisionNumber($permisionID)
    {
        $permisionID = (int)$permisionID;

        $key = $this->db->query(
            "SELECT `permision` FROM permisions " .
            "WHERE id_permision = '{$permisionID}'"
        );

        $key = $key->fetch();
        return $key['permision'];
    }

}