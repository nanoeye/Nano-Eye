<?php

class indexModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCat()
    {
        $cat = $this->db->query("SELECT * FROM catagories");

        return $cat->fetchAll(PDO::FETCH_ASSOC);
    }
}