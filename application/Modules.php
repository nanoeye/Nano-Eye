<?php

class Modules
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR);
    }

    public function getModules()
    {
        $m = $this->db->prepare("SELECT `md_name` FROM `modules` WHERE `md_status` = 'enable'");
        $m->execute();
        $data = $m->fetchAll(PDO::FETCH_ASSOC);

        $i = 0;
        while ($i < count($data)) {
            $var[] = $data[$i]['md_name'];
            $i++;
        }

        return $var;
    }

    public function rootModule($module)
    {
        return ROOT . 'system' . DS . 'modules' . DS. 'core' . DS . 'controllers'. DS . $module . 'Controller.php';
    }
}
