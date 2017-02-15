<?php

class indexModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAclMenus()
    {
        $aclMenu = $this->db->query("SELECT * FROM `acl_menu`");

        return $aclMenu->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAclMenu($id)
    {
        $aclMenu = $this->db->query("SELECT * FROM `acl_menu` WHERE `am_id` = '$id'");

        return $aclMenu->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertItem($name, $title, $url, $icon)
    {
        $this->db->prepare("INSERT INTO `acl_menu` VALUES (null, :name, :title, :url, :icon)")
            ->execute(
                array(
                    ':name' => $name,
                    ':title' => $title,
                    ':url' => $url,
                    ':icon' => $icon
                ));

    }

    public function editItem($id, $name, $title, $url, $icon)
    {
        $id = (int) $id;
        $edit = array();

        if(!empty($name)) { $edit[] = "`am_name` = '$name'"; }
        if(!empty($title)) {$edit[] = "`am_title` = '$title'"; }
        if(!empty($url)) {$edit[] = "`am_url` = '$url'"; }
        if(!empty($icon)) {$edit[] = "`am_icon` = '$icon'"; }

        $var = implode(',' , $edit);

        $this->db->query("UPDATE `acl_menu` SET $var WHERE `am_id` = $id");
    }

    public function deleteAclMenu($id)
    {
        $id = (int) $id;
        $this->db->query("DELETE from `acl_menu` where am_id = $id");
    }
}