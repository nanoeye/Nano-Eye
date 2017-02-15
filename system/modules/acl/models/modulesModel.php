<?php

class modulesModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertModule($module) {
        $this->db->prepare("INSERT INTO modules VALUES (null, :md_name, '')")
                ->execute(
                        array(
                            ':md_name' => $module
        ));
    }

    public function editModule($id, $module, $status) {

        $id = (int) $id;

        $this->db->prepare("UPDATE `modules` SET `md_name` = :md_name, `md_status` = :md_status WHERE `md_id` = $id")
                ->execute(
                        array(
                            ':md_name' => $module,
                            ':md_status' => $status
        ));
    }

    public function deleteModule($id) {
        $id = (int) $id;
        $this->db->query("DELETE from modules where `md_id` = $id");
    }

    public function getModules() {
        $m = $this->db->prepare("SELECT * FROM `modules`");
        $m->execute();
        $data = $m->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
    
    public function getModule($id)
    {
        $m = $this->db->query("SELECT * FROM `modules` WHERE `md_id` = $id");
        $data = $m->fetchAll(PDO::FETCH_ASSOC);

        return $data[0];
    }

    public function insertApp($name, $icon, $url) {
        $this->db->prepare("INSERT INTO apps VALUES (null, :app_name, :app_icon, :app_url)")
            ->execute(
                array(
                    ':app_name' => $name,
                    ':app_icon' => $icon,
                    ':app_url' => $url
                ));
    }

    public function editApp($id, $name, $icon, $url) {

        $id = (int) $id;

        $this->db->prepare("UPDATE `apps` SET `app_name` = :app_name, `app_icon` = :app_icon, `app_url` = :app_url WHERE `app_id` = $id")
            ->execute(
                array(
                    ':app_name' => $name,
                    ':app_icon' => $icon,
                    ':app_url' => $url
                ));
    }

    public function deleteApp($id) {
        $id = (int) $id;
        $this->db->query("DELETE from apps where `app_id` = $id");
    }

    public function getApps()
    {
        $aclMenu = $this->db->query("SELECT * FROM `apps`");

        return $aclMenu->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApp($id)
    {
        $aclMenu = $this->db->query("SELECT * FROM `apps` WHERE `app_id` = $id");
        $data = $aclMenu->fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }

}
