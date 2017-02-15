<?php

class Bootstrap
{
    public static function run(Request $prediction)
    {
        $m = new Modules();
        $module = $prediction->getModule();
        $controller = $prediction->getController() . 'Controller';
        $method = $prediction->getMethod();
        $args = $prediction->getArgs();

        if($module){
            $rootModule = $m->rootModule($module);

            if(is_readable($rootModule)){
                require_once $rootModule;
                $rootController = ROOT . 'system' . DS . 'modules' . DS. $module . DS . 'controllers'. DS . $controller . '.php';
            }
            else{
                throw new Exception('Required Module not found or Module\'s File loading error.');
                //header('location:' . BASE_URL . 'error/access/404');
            }
        }
        else{
            $rootController = ROOT . 'system' . DS . 'modules' . DS. 'core' . DS . 'controllers'. DS . $controller . '.php';
        }

        if(is_readable($rootController))
        {
            require_once $rootController;
            $controller = new $controller;
            
            if(is_callable(array($controller, $method)))
            {
                $method = $prediction->getMethod();
            }
            else
                {
                $method = 'index';
                }

            if(isset($args))
            {
                call_user_func_array(array($controller, $method), $args);
            }
            else
            {
                call_user_func(array($controller, $method));
            }
        }    
         else
        {
            throw new Exception(
                '<title> Not Found: ' . $_SERVER['REQUEST_URI'] . '</title>' .
                '<h2> HTTP Error: Not Found </h2> '.
                '<p> Request URL: ' . $_SERVER['REQUEST_URI'] . ' </p>'
            );
            //header('location:' . BASE_URL . 'error/access/404');
        }       
    }
}
