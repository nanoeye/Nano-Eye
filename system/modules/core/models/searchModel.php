<?php

class SearchModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getWords()
    {
        $word = $this->db->query("select * from dict");
        return $word->fetchall();
    }

    public function getWord($q)
    {
        $word = $this->db->query("select * from dict where word LIKE '%$q%' OR r_word LIKE '%$q%' OR meaning LIKE '%$q%'");
        return $word->fetchall(PDO::FETCH_ASSOC);

    }

}