<?php

class System extends Configuration
{

    public $configDir;
    public $setupFile;
    public $setuped;
    private $errorMessage;
    private $Message;
    private $step;

    public function __construct()
    {
        $this->configDir = "system" . DS . "libs" . DS . "setup_files" . DS;
        $this->setupFile = $this->configDir . "db";
        $this->setuped = $this->setuped();
        $this->errorMessage = '';
        $this->Message = '';
        $this->step = $this->step();
    }

    private function getText($value)
    {
        if (isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = htmlspecialchars($_POST[$value], ENT_QUOTES);
            return $_POST[$value];
        }
        return '';
    }

    public function getVarData($args)
    {

        $data = file_get_contents($this->setupFile);
        if ($data) {
            $var = preg_split("@[\,]+@", $data);
            /* DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_CHARECTER_SET,DB_PREFIX */
            $var1 = Hash::getReal(array_shift($var));
            $var2 = Hash::getReal(array_shift($var));
            $var3 = Hash::getReal(array_shift($var));
            $var4 = Hash::getReal(array_shift($var));
            $var5 = Hash::getReal(array_shift($var));
            $var6 = Hash::getReal(array_shift($var));

            if ($args == "db_host") {
                return $var1;
                exit;
            }
            if ($args == "db_user") {
                return $var2;
                exit;
            }
            if ($args == "db_pass") {
                return $var3;
                exit;
            }
            if ($args == "db_name") {
                return $var4;
                exit;
            }
            if ($args == "db_char") {
                return $var5;
                exit;
            }
            if ($args == "db_prefix") {
                return $var6;
                exit;
            }
        }
    }

    private function setuped()
    {
        $data = file_get_contents($this->setupFile);
        if ($data) {
            $var = preg_split("@[\,]+@", $data);
            $db_host = Hash::getReal(array_shift($var));
            $db_user = Hash::getReal(array_shift($var));
            $db_pass = Hash::getReal(array_shift($var));
            $db_name = Hash::getReal(array_shift($var));
            $db_char = Hash::getReal(array_shift($var));
            $db_prefix = Hash::getReal(array_shift($var));

            $db = new Database($db_host, $db_name, $db_user, $db_pass, $db_char);
            if ($db) {
                if ($db->query("SELECT * FROM `site_info`")) {
                    return "ok";
                }
            }
        }

        return "not ok";
    }

    public function Setup()
    {
        $this->setupValidation();
        $this->setupHeaderData();

        echo "<div class='col-md-8 col-md-offset-2'><div class='login-panel panel panel-default'>";
        echo "<div class= 'panel-heading'><h3 class= 'panel-title'>
        <img src='/public/media/site/logo/favicon.gif' width='25px' height='25px'/>" .
            $this->step . " configuration" .
            "</h3></div><div class='panel-body'>";

        if (!empty($this->errorMessage)) {

            echo "<div class='alert alert-danger' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                     </button>" . //<span aria-hidden='true'>&times;</span>
                $this->errorMessage .
                "</div>";
        }

        if (!empty($this->Message)) {
            echo "<div class='alert alert-success' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    </button>" . //<span aria-hidden='true'>&times;</span>
                $this->Message .
                "</div>";
        }

        if ($this->step == "Site & Account") {
            $this->siteViewData();
        } else {
            $this->setupViewData();
        }

        echo "</fieldset></div></div></div>";
        exit;
    }

    private function setupViewData()
    {
        echo "<form method='post' class='form-horizontal'>
    <input type='hidden' value='1' name='setup'>
    <div class='form-group'>
        <label for='db_host' class='col-sm-4 control-label'>Host:</label>
        <div class='col-sm-8'>
            <input type='text' name='db_host' class='form-control' id='db_host' placeholder='name of batabase host.'>
        </div>
    </div>

    <div class='form-group'>
        <label for='db_user' class='col-sm-4 control-label'>User:</label>
        <div class='col-sm-8'>
            <input type='text' name='db_user' class='form-control' id='db_user' placeholder='username of database.'>
        </div>
    </div>

    <div class='form-group'>
        <label for='db_pass' class='col-sm-4 control-label'>User's password:</label>
        <div class='col-sm-8'>
            <input type='text' name='db_pass' class='form-control' id='db_pass' placeholder='password of database user.'>
        </div>
    </div>

    <div class='form-group'>
        <label for='db_name' class='col-sm-4 control-label'>Database's name:</label>
        <div class='col-sm-8'>
            <input type='text' name='db_name' class='form-control' id='db_name' placeholder='name of database.'>
        </div>
    </div>

    <div class='form-group'>
        <label for='db_char' class='col-sm-4 control-label'>Database charset:</label>
        <div class='col-sm-8'>
            <input type='text' name='db_char' class='form-control' id='db_char' placeholder='name of database charatecter set.'>
        </div>
    </div>

    <div class='form-group'>
        <label for='db_prefix' class='col-sm-4 control-label'>Table name prefix:</label>
        <div class='col-sm-8'>
            <input type='text' name='db_prefix' class='form-control' id='db_prefix' placeholder='name of database table name prefix.'>
        </div>
    </div>

    <div class='form-group'>
        <div class='col-sm-offset-4 col-sm-8'>
            <button type='submit' class='btn btn-lg btn-primary'>Save</button>
        </div>
    </div>
</form>";
    }

    private function siteViewData()
    {
        echo "<form method='post' class='form-horizontal'>
    <input type='hidden' value='1' name='site'>
    <fieldset>
    <legend> Site configuration</legend>
       <div class='form-group'>
        <label for='site_name' class='col-sm-4 control-label'>New Name:</label>
        <div class='col-sm-8'>
            <input type='text' name='site_name' class='form-control' id='site_name' placeholder='new name.'>
        </div>
    </div>
    
        <div class='form-group'>
        <label for='site_slogan' class='col-sm-4 control-label'>Slogan:</label>
        <div class='col-sm-8'>
            <input type='text' name='site_slogan' class='form-control' id='site_slogan' value='Technology for everyone.'>
        </div>
    </div>
    
            <div class='form-group'>
        <label for='site_company' class='col-sm-4 control-label'>Company:</label>
        <div class='col-sm-8'>
            <input type='text' name='site_company' class='form-control' id='site_company' value='www.nanoeye.com' readonly>
        </div>
    </div>
    
    <legend> Account configuration</legend>
       <div class='form-group'>
        <label for='username' class='col-sm-4 control-label'>Admin username:</label>
        <div class='col-sm-8'>
            <input type='text' name='username' class='form-control' id='username' placeholder='Admin username.'>
        </div>
    </div>
    
        <div class='form-group'>
        <label for='addmin_pass' class='col-sm-4 control-label'>Password:</label>
        <div class='col-sm-8'>
            <input type='password' name='addmin_pass' class='form-control' id='addmin_pass' placeholder='New password.'>
        </div>
    </div>
    
            <div class='form-group'>
        <label for='addmin_con_pass' class='col-sm-4 control-label'>Confirm password:</label>
        <div class='col-sm-8'>
            <input type='password' name='addmin_con_pass' class='form-control' id='addmin_con_pass' placeholder='Confirm password'>
        </div>
    </div>
    
    <div class='form-group'>
        <div class='col-sm-offset-4 col-sm-8'>
            <button type='submit' class='btn btn-lg btn-primary'>Save</button>
        </div>
    </div> 
    </fieldset>
</form>";
    }

    private function setupHeaderData()
    {
        echo
            "<title> Welcome to Nano Eye Installation </title>" .
            "<link href='/system/themes/goahead/css/main.css' rel= 'stylesheet' type='text/css'/>" .
            "<link href='/system/themes/liteboot/css/bootstrap.min.css' rel= 'stylesheet' type='text/css'/>" .
            "<link href='/system/themes/liteboot/css/font-awesome.min.css' rel= 'stylesheet' type='text/css'/>" .
            "<link href='/system/themes/liteboot/css/jquery-ui.css' rel= 'stylesheet' type='text/css'/>" .
            "<script src = '/system/themes/liteboot/js/main.js' type = 'text/javascript'></script>" .
            "<script src = '/system/themes/liteboot/js/jquery.js' type = 'text/javascript'></script>" .
            "<script src = '/system/themes/liteboot/js/jquery-ui.js' type = 'text/javascript'></script>" .
            "<script src = '/system/themes/liteboot/js/jquery-3.1.0.min.js' type = 'text/javascript'></script>" .
            "<script src = '/public/js/plugin/jquery.validate.js' type = 'text/javascript'></script>" .
            "<script src = '/public/js/plugin/jquery.min.js' type = 'text/javascript'></script>";
    }

    private function setupData($db_host, $db_user, $db_pass, $db_name, $db_char, $db_prefix = false)
    {
        if (isset($db_prefix)) {
            $prefix = "," . $db_prefix;
        }

        $data = $db_host . "," . $db_user . "," . $db_pass . "," . $db_name . "," . $db_char . $prefix;
        if (is_dir($this->configDir)) {
            if (file_exists($this->setupFile)) {

                $setupfile = fopen($this->setupFile, "w");
                fputs($setupfile, $data);

                fclose($setupfile);
            } else {
                throw new Exception("Database configuration file not found.");
            }
        } else {
            throw new Exception("Database configuration directoty not found.");
        }
    }

    private function setupValidation()
    {
        if ($this->getText("setup")) {

            if (!$this->getText('db_host')) {
                $this->errorMessage = 'You must fillup with database host address or name.';
            } elseif (!$this->getText('db_user')) {
                $this->errorMessage = 'You must fillup with database\'s active username.';
            } /*                        if (!$this->getText('db_pass')) {
                                        $this->errorMessage = 'You must fillup with database\'s active user\'s password.';
                                    }*/
            elseif (!$this->getText('db_name')) {
                $this->errorMessage = 'You must fillup with database\'s name.';
            } elseif (!$this->getText('db_char')) {
                $this->errorMessage = 'You must fillup with database\'s dataset character.';
            } /*                        if (!$this->getText('db_prefix')) {
                            $this->errorMessage = 'You must fillup with database\'s table prefix.';
                        }
            if (!@mysqli_connect($this->getText('db_host'),$this->getText('db_user'),$this->getText('db_user'),$this->getText('db_name'),'80')){
                $this->Message = 'Database connection failed.';

            }

            elseif (!@mysqli_select_db($this->getText('db_host'),$this->getText('db_name'))){
                $this->Message = 'Database not found.';

            }*/

            else {
                $this->SetupData(Hash::getHash($this->getText("db_host")), Hash::getHash($this->getText("db_user")), Hash::getHash($this->getText("db_pass")), Hash::getHash($this->getText("db_name")), Hash::getHash($this->getText("db_char")), Hash::getHash($this->getText("db_prefix")));
                $this->Message = 'You have been configuration database successfully.';
                header("location:/index");
            }
        } elseif ($this->getText("site")) {

            $doc_root = $_SERVER['DOCUMENT_ROOT'];
            $http_host_add = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            $http_host_ip = 'http://' . $_SERVER['SERVER_ADDR'] . '/';
            $default_home = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            $default_layout = 'search';
            $icon_dir = 'http://' . $_SERVER['HTTP_HOST'] . '/public/media/site/logo/';
            $favicon = 'favicon.gif';

            $data = file_get_contents($this->setupFile);
            if ($data) {
                $var = preg_split("@[\,]+@", $data);
                $db_host = Hash::getReal(array_shift($var));
                $db_user = Hash::getReal(array_shift($var));
                $db_pass = Hash::getReal(array_shift($var));
                $db_name = Hash::getReal(array_shift($var));
                $db_char = Hash::getReal(array_shift($var));
                $db_prefix = Hash::getReal(array_shift($var));

                $db = new Database($db_host, $db_name, $db_user, $db_pass, $db_char);

                if (!$this->getText('site_name')) {
                    $this->errorMessage = 'You must fillup with website name.';
                } else {
                    $db->query("CREATE TABLE `site_info` (" .
                        "`id` INT(11) NULL AUTO_INCREMENT, " .
                        "`name` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "`slogan` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci', " .
                        "`company` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "`doc_root` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "`http_host_add` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "`http_host_ip` VARCHAR(40) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "`default_home` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "`default_layout` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "`icon_dir` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "`favicon` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci', " .
                        "PRIMARY KEY (`Id`))");
                    $db->prepare("INSERT INTO `site_info` VALUES (null, :site_name, :site_slogan, :company, :doc_root, :http_host_add, :http_host_ip, :default_home, :default_layout, :icon_dir, :favicon)")
                        ->execute(array(
                            ':site_name' => $this->getText('site_name'),
                            ':site_slogan' => $this->getText('site_slogan'),
                            ':company' => $this->getText('site_company'),
                            ':doc_root' => $doc_root,
                            ':http_host_add' => $http_host_add,
                            ':http_host_ip' => $http_host_ip,
                            ':default_home' => $default_home,
                            ':default_layout' => $default_layout,
                            ':icon_dir' => $icon_dir,
                            ':favicon' => $favicon
                        ));
                    $this->Message = 'You have been configuration site information to database successfully.';
                    header("location:/index");
                }
            }
        }
    }

    private function Step()
    {
        $data = file_get_contents($this->setupFile);
        if (empty($data)) {
            return "Database";
        } else {
            return "Site & Account";
        }
    }
}