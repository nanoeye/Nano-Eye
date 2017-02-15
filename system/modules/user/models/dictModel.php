<?php


class dictModel extends Model 
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
    
    public function getWord($id)
    {
        $id = (int) $id;
        $word = $this->db->query("select * from dict where id = $id");
        return $word->fetch();
        
    }

    public function insertWord($word, $spelling, $meaning, $r_word, $examples, $image, $cat)
    {
        $cat = (int) $cat;
        
        $this->db->prepare("INSERT INTO dict VALUES (null, :word, :spelling, :meaning, :r_word, :examples, :image, :cat)")
                ->execute(
                        array(
                            ':word' => $word,
                            ':spelling' => $spelling,
                            ':meaning' => $meaning,
                            ':r_word' => $r_word,
                            ':examples' => $examples,
                            ':image' => $image,
                            ':cat' => $cat
                        ));
        
    }
    
    public function editWord($id, $word, $spelling, $meaning, $r_word, $examples, $cat)
    {
        $id = (int) $id;
        $cat = (int) $cat;
        
        $this->db->prepare("UPDATE dict SET word = :word, spelling = :spelling, meaning = :meaning, r_word = :r_word, examples = :examples, :cat WHERE id = :id")
                ->execute(
                        array(
                            'id' => $id,
                            ':word' => $word,
                            ':spelling' => $spelling,
                            ':meaning' => $meaning,
                            ':r_word' => $r_word,
                            ':examples' => $examples,
                            ':cat' => $cat
                        ));
        
    }
    
    public function deleteWord($id)
    {
        $id = (int) $id;
        $this->db->query("DELETE from dict where id = $id");
    }
    
    public function insertPureba($number)
    {
        $this->db->prepare("INSERT INTO page VALUES (null, :number)")
                ->execute(
                        array(
                            ':number' => $number
                        ));
        
    }
    
    public function getPureba($condition = '')
    {
        $page= $this->db->query("select r.*, p.pais, c.ciudad from pages r, paises p, ciudades c where r.id_pais = p.id " .
            "and r.id_ciudad = c.id $condition order by id asc");
        return $page->fetchall(PDO::FETCH_ASSOC);
        
    }

    public function getDictCat()
    {
        $dictCat = $this->db->query("SELECT * from dict_cat");

        return $dictCat->fetchAll(PDO::FETCH_ASSOC);
    }

}
