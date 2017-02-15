<?php

class AppsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getApps()
    {
        $apps = $this->db->query("SELECT * FROM `apps`");

        return $apps->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getModules() {
        $m = $this->db->prepare("SELECT * FROM `modules`");
        $m->execute();
        $data = $m->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
	
    public function getApp($id)
    {
        $aclMenu = $this->db->query("SELECT * FROM `apps` WHERE `app_id` = '$id'");

        return $aclMenu->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertItem($name, $url, $icon, $status)
    {
        $this->db->prepare("INSERT INTO `apps` VALUES (null, :name, :url, :icon, :status)")
            ->execute(
                array(
                    ':name' => $name,
                    ':url' => $url,
                    ':icon' => $icon,
                    ':status' => $status
                ));

    }

    public function edit($id, $name, $url, $icon, $status)
    {
        $id = (int) $id;
        $edit = array();

        if(!empty($name)) { $edit[] = "`app_name` = '$name'"; }
        if(!empty($url)) {$edit[] = "`app_url` = '$url'"; }
        if(!empty($icon)) {$edit[] = "`app_icon` = '$icon'"; }
        if(!empty($status)) {$edit[] = "`app_status` = '$status'"; }

        $var = implode(',' , $edit);

        $this->db->query("UPDATE `apps` SET $var WHERE `app_id` = $id");
    }

    public function delete($id)
    {
        $id = (int) $id;
        $this->db->query("DELETE from `apps` where app_id = $id");
    }
}