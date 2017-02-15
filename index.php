<?php


ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)). DS);
define('APP_PATH', ROOT . 'application'. DS);

try
{
    require_once APP_PATH . 'Autoload.php';
    require_once APP_PATH . 'Configs.php';


    Session::init();

    $registry = Registry::getInstance();
    $registry->request = new Request();
    $registry->db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR);
    $registry->acl = new ACL();

    Bootstrap::run($registry->request);
}

catch(Exception $e)
{
    echo $e->getMessage();
}
