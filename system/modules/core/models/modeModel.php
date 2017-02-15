<?php

class modeModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getWords()
    {
        $words = $this->db->prepare("SELECT `word` FROM dict");
        $words->execute();

        return $words->fetchAll(PDO::FETCH_ASSOC);
    }
    
}