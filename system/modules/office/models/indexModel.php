<?php

class indexModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getJobCats()
    {
        $JobCat = $this->db->query("SELECT * FROM `o_jobs_cats`");

        return $JobCat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJobCat($id)
    {
        $JobCat = $this->db->query("SELECT * FROM `o_jobs_cats` WHERE `oj_id` = '$id'");

        return $JobCat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertItem($name, $title, $url, $icon)
    {
        $this->db->prepare("INSERT INTO `o_jobs_cats` VALUES (null, :name, :title, :url, :icon)")
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

        if(!empty($name)) { $edit[] = "`oj_name` = '$name'"; }
        if(!empty($title)) {$edit[] = "`oj_title` = '$title'"; }
        if(!empty($url)) {$edit[] = "`oj_url` = '$url'"; }
        if(!empty($icon)) {$edit[] = "`oj_icon` = '$icon'"; }

        $var = implode(',' , $edit);

        $this->db->query("UPDATE `o_jobs_cats` SET $var WHERE `oj_id` = $id");
    }

    public function deleteItem($id)
    {
        $id = (int) $id;
        $this->db->query("DELETE from `o_jobs_cats` where oj_id = $id");
    }
}