<?php

abstract class Controller {

    private $registry;
    protected $view;
    protected $acl;
    protected  $request;

    public function __construct() {
        $this->registry = Registry::getInstance();
        $this->acl = $this->registry->acl;
        $this->request =  $this->registry->request;
        $this->view = new View($this->request, $this->acl);
    }

    abstract public function index();

    protected function access_init(){
        if (!Session::get('auth')) {
            $this->redirect('user/log/in?redirect='. $_SERVER['REQUEST_URI']);
        }
    }

    protected function loadModel($model, $module = FALSE) {
        $model = $model . 'Model';
        $rootModel = ROOT . 'system' . DS . 'modules' . DS. 'core' . DS . 'models' . DS . $model . '.php';

        if(!$module){
            $module = $this->request->getModule();
        }

        if($module){
            if($module != 'default'){
                $rootModel = ROOT . 'system' . DS . 'modules' . DS . $module . DS . 'models' . DS . $model . '.php';
            }
        }

        if (is_readable($rootModel)) {
            require_once $rootModel;
            $model = new $model;
            return $model;
        } else {
       // echo $rootModel; exit;
            throw new Exception('Required Model not found or Model loading error.');
        }

    }

    protected function getLibrary($library) {
        $rootLibrary = ROOT . 'system' . DS . 'libs' . DS . 'class.'. $library . '.php';

        if (is_readable($rootLibrary)) {
            require_once $rootLibrary;
            $library = new $library;
            return $library;
        } else {
            throw new Exception('Library files not found or while Library file loading error.');
        }
    }

    protected function getText($value) {
        if (isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = htmlspecialchars($_POST[$value], ENT_QUOTES);
            return $_POST[$value];
        }
        return '';
    }

    protected function getInt($value) {
        if (isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = filter_input(INPUT_POST, $value, FILTER_VALIDATE_INT);
            return $_POST[$value];
        }
        return 0;
    }

    protected function redirect($root = FALSE) {
        if ($root) {
            header('location:' . BASE_URL . $root);
            exit;
        } else {
            header('location:' . BASE_URL);
            exit;
        }
    }

    protected function redirect_uri($uri) {
        if (!empty($uri)) {
            header('location:' . WEB_URI . $uri);
            exit;
        } else {
            header('location:' . WEB_URI);
            exit;
        }
    }

    protected function filterInt($int) {
        $int = (int) $int;

        if (is_int($int)) {
            return $int;
        } else {
            return 0;
        }
    }

    protected function getWordParam($value) {
        if (isset($_POST[$value])) {
            return $_POST[$value];
        }
    }
    
    protected function getSql($value) {
        if(isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = strip_tags($_POST[$value]);
            return trim($_POST[$value]);
        }
    }
    
    protected function getAlphaNum($value) {
        if(isset($_POST[$value]) && !empty($_POST[$value])) {
            $_POST[$value] = (string) preg_replace('/[^A-Z0-9_]/i' , '' , $_POST[$value]);
            return trim($_POST[$value]);
        }
    }
    
    public function validEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return FALSE;
        }
        
        return TRUE;
    }

    public function getSearchText($value) {
        if (isset($_GET[$value]) && !empty($_GET[$value])) {
            $_GET[$value] = htmlspecialchars($_GET[$value], ENT_QUOTES);
            return $_GET[$value];
        }
        return '';
    }

}
