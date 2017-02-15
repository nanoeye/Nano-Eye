<?php

class wordModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getWord($word)
    {
        $data = (string) $word;

        $query = $this->db->query("SELECT * FROM dict WHERE word = '$data'"); /*there was an error. i will solve later.*/

        return $query->fetch();
    }

}