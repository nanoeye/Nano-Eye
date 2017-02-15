<?php

class menuModelWidget extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMenus(){
        $menu = $this->db->query("SELECT * FROM menus");

        return $menu->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenu($menu){
        $sql = $this->db->query("SELECT * FROM menus WHERE POSITION = '$menu'");

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenuConfig(){
       $MenuConfig = $this->db->query("SELECT * FROM menuConfig");

       return $MenuConfig->fetch(PDO::FETCH_ASSOC);
    }

    public function getSiteInfo()
    {
        $siteInfo = $this->db->prepare("SELECT * FROM `site_info`");
        $siteInfo->execute();

        return $siteInfo->fetchAll(PDO::FETCH_ASSOC);
    }
    
}