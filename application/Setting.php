<?php

class Setting
{

    private $db;
    private $base_url;
    private $checkedurl;
    private $hosturl;

    public function __construct()
    {
        $this->hosturl = $_SERVER['HTTP_HOST'];
        $this->db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR);
        $this->checkedurl = $this->checkedadd();
        $this->base_url = $this->checkedurl;
    }

    public function siteName()
    {
        $siteName = $this->db->prepare("SELECT `name` FROM `site_info`");
        $siteName->execute();
        $var = $siteName->fetch();

        return $var['name'];
    }

    public function siteSlogan()
    {
        $siteSlogan = $this->db->prepare("SELECT `slogan` FROM `site_info`");
        $siteSlogan->execute();
        $var = $siteSlogan->fetch();

        return $var['slogan'];
    }

    public function siteCompany()
    {
        $siteCompany = $this->db->prepare("SELECT `company` FROM `site_info`");
        $siteCompany->execute();
        $var = $siteCompany->fetch();

        return $var['company'];
    }

    public function siteHostAdd()
    {
        $siteHost = $this->db->prepare("SELECT `http_host_add` FROM `site_info`");
        if ($siteHost) {
            $siteHost->execute();
            $var = $siteHost->fetch();

            return $var['http_host_add'];
        }
    }

    public function siteHostIP()
    {
        $siteHost = $this->db->prepare("SELECT `http_host_ip` FROM `site_info`");
        if ($siteHost) {
            $siteHost->execute();
            $var = $siteHost->fetch();

            return $var['http_host_ip'];
        }
    }

    public function siteDefaultLayout()
    {
        $siteDefaultLayout = $this->db->prepare("SELECT `default_layout` FROM `site_info`");
        $siteDefaultLayout->execute();
        $var = $siteDefaultLayout->fetch();

        return $var['default_layout'];
    }

    public function siteFevicon()
    {
        $siteDefaultLayout = $this->db->prepare("SELECT `favicon` FROM `site_info`");
        $siteDefaultLayout->execute();
        $var = $siteDefaultLayout->fetch();

        return $var['favicon'];
    }

    public function checkedadd(){
        if (is_numeric($this->hosturl)){
            $this->siteHostIP();

        }
        else{
            $this->siteHostAdd();
        }

        return 'http://' . $this->hosturl . '/';
    }
}