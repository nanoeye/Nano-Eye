<?php

class Session
{

    public static function init()
    {
        session_start();
    }

    public static function destroy($value = FALSE)
    {
        if($value) {
            if(is_array($value)) {
                for($i = 0; $i < count($value); $i++) {
                    if(isset($_SESSION[$value[$i]])) {
                        unset($_SESSION[$value[$i]]);
                    }
                }
            } else {
                if(isset($_SESSION[$value])) {
                    unset($_SESSION[$value]);
                }
            }
        } else {
            session_destroy();
        }
    }

    public static function set($value, $username)
    {
        if(!empty($value))
            $_SESSION[$value] = $username;
    }

    public static function get($value)
    {
        if(isset($_SESSION[$value]))
            return $_SESSION[$value];
    }

    public static function access($level)
    {
        if(!Session::get('auth')){
            header('location:' . BASE_URL . 'error/access/401');
            exit;
        }

        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))){
            header('location:' . BASE_URL . 'error/access/401');
            exit;
        }
    }

    public static function accessView($level)
    {
        if(!Session::get('auth')) {
            return FALSE;
        }

        Session::sessionTime();
        
        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
            return FALSE;
        }

        return TRUE;
    }

    public static function getLevel($level)
    {
        $role['root'] = 1;
        $role['admin'] = 2;
        $role['editor'] = 3;
        $role['user'] = 4;
        $role['developer'] = 5;

        if(!array_key_exists($level, $role)) {
            throw new Exception('Error the Access.');
        } else {
            return $role[$level];
        }
    }


    public static function accessRestrict(array $level, $noAdmin = FALSE)
                    {
        if(!Session::get('auth')){
            header('location:' . BASE_URL . 'error/access/401');
            exit;
        }
        
        Session::sessionTime();
        
        if($noAdmin == FALSE){
            if(Session::get('level') == 'admin'){
                return;
            }
        }
        
        if(count($level)){
            if(in_array(Session::get('level'), $level)){
                return;
            }
        }
        
       header('location:' . BASE_URL . 'error/access/403');
    }
    
    public static function accessViewRestrict(array $level, $noAdmin = FALSE)
    {
         if(!Session::get('auth')){
            return FALSE;
        }
        
        Session::sessionTime();
        
        if($noAdmin == FALSE){
            if(Session::get('level') == 'admin'){
                return TRUE;
            }
        }
        
        if(count($level)){
            if(in_array(Session::get('level'), $level)){
                return TRUE;
            }
        }
        
        return FALSE;;
    }
    
    public static function sessionTime(){
        if(!Session::get('time') || !defined('SESSION_TIME')){
            throw new Exception('Session Time is not set');
        }
        
        if(SESSION_TIME == 0){
            return;
        }
        
        if(time() - Session::get('time') > (SESSION_TIME * 60)){
            Session::destroy();
            header('location:' . BASE_URL . 'error/access/8080');
        }
        else {
            Session::set('time', time());
        }
    }

}