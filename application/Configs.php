<?php

$db = new Configuration();

define('DB_HOST', $db->db_host);
define('DB_USER', $db->db_user);
define('DB_PASS', $db->db_pass);
define('DB_NAME', $db->db_name);
define('DB_CHAR', $db->db_char);
define('DB_PREFIX', $db->db_prefix);

define('DEFAULT_CONTROLLER', 'index');
define('SESSION_TIME', 10);
//define('HASH_KEY', '57c1d48ba721a');

$config = new Setting();

define('BASE_URL', $config->checkedadd());
define('WEB_URI', 'http://' . $_SERVER['HTTP_HOST']);
define('DEFAULT_LAYOUT', $config->siteDefaultLayout());

define('APP_NAME', $config->siteName());
define('APP_SLOGAN', $config->siteSlogan());
define('APP_COMPANY', $config->siteCompany());

class Configuration {

    public $db_host;
    public $db_user;
    public $db_pass;
    public $db_name;
    public $db_char;
    public $db_prefix;

    public function __construct() {
        $this->db_host = "";
        $this->db_user = "";
        $this->db_pass = "";
        $this->db_name = "";
        $this->db_char = "";
        $this->db_prefix = "";
        $this->connection();
    }

    private function connection() {

        if (empty($this->db_host || $this->db_user || $this->db_pass || $this->db_name || $this->db_char || $this->db_prefix)) {

            $system = new System();
            if (is_dir($system->configDir)) {
                if (file_exists($system->setupFile)) {
                    if ($system->setuped == "ok") {

                        $this->db_host = $system->getVarData("db_host");
                        $this->db_user = $system->getVarData("db_user");
                        $this->db_pass = $system->getVarData("db_pass");
                        $this->db_name = $system->getVarData("db_name");
                        $this->db_char = $system->getVarData("db_char");
                        $this->db_prefix = $system->getVarData("db_prefix");
                    } else {
                        $system->setup();
                    }
                } else {
                    throw new Exception("Database configuration file not found.");
                }
            } else {
                throw new Exception("Database configuration directoty not found.");
            }
        } else {
            throw new Exception("Database configuration error. Please check database configuration and give us right configuration information.");
        }
    }

}
