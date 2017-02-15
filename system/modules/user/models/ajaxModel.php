<?php

class ajaxModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getPaises(){
        $paises = $this->db->query("SELECT * FROM paises");
        return $paises->fetchAll();
    }
    
    public function getCiudades($pais){
        $ciudades = $this->db->query("SELECT * FROM ciudades WHERE pais = '{$pais}'");
        $ciudades->setFetchMode(PDO::FETCH_ASSOC);
        return $ciudades->fetchAll();
    }
    
    public function insertCiudad($ciudad, $pais){
        $this->db->query("INSERT INTO ciudades VALUES (null, '{$ciudad}', '{$pais}')");
    }
}
