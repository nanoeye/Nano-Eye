<?php

/**
 * Created by PhpStorm.
 * User: Al Amin
 * Date: 9/28/2016
 * Time: 12:13 PM
 */
class siteModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSiteInfo()
    {
        $siteInfo = $this->db->prepare("SELECT * FROM `site_info`");
        $siteInfo->execute();

        return $siteInfo->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editSite($id, $name, $doc_root, $http_host_add, $default_home)
    {
        $id = (int) $id;
        $edit = array();

        if(!empty($name)) { $edit[] = "`name` = '$name'"; }
        if(!empty($doc_root)) {$edit[] = "`doc_root` = '$doc_root'"; }
        if(!empty($http_host_add)) {$edit[] = "`http_host_add` = '$http_host_add'"; }
        if(!empty($default_home)) {$edit[] = "`default_home` = '$default_home'"; }

        $var = implode(',' , $edit);

        $this->db->query("UPDATE `site_info` SET $var WHERE `id` = $id");
    }

    public function setLogo($id, $icon_dir, $favicon)
    {
        $id = (int) $id;
        $upload = array();

        if(!empty($icon_dir)) { $upload[] = "`icon_dir` = '$icon_dir'"; }
        if(!empty($favicon)) {$upload[] = "`favicon` = '$favicon'"; }

        $var = implode(',' , $upload);

        $this->db->query("UPDATE `site_info` SET $var  WHERE `id` = $id");
    }
}