<?php

class appModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getApps()
    {
        $apps = $this->db->query("SELECT * FROM `apps` WHERE `app_status` = 'active' ");

        return $apps->fetchAll(PDO::FETCH_ASSOC);
    }
}