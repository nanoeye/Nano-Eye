<?php

class contentsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDir($dirId)
    {
        $JobCat = $this->db->query("SELECT * FROM `o_jobs_cats` WHERE `oj_id` = '$dirId'");

        return $JobCat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDirName($dirId)
    {
        $DirName = $this->db->query("SELECT `oj_name` FROM `o_jobs_cats` WHERE `oj_id` = '$dirId'");
        $var = $DirName->fetch();
        return $var['oj_name'];
    }

    public function getFile($filename)
    {
        $JobCat = $this->db->query("SELECT * FROM `o_jobs_file` WHERE `ojf_name` = '$filename'");

        return $JobCat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFiles($dir)
    {
        $JobCat = $this->db->query("SELECT * FROM `o_jobs_file` WHERE `ojf_parent` = '$dir'");

        return $JobCat->fetchAll(PDO::FETCH_ASSOC);
    }
}