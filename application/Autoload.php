<?php

    function autoLoadCore($class) {
        if(file_exists(APP_PATH . ucfirst(strtolower($class)) . '.php'))
            include_once APP_PATH . ucfirst(strtolower($class)) . '.php';
    }

    function autoLoadLibs($class) {
        if(file_exists(ROOT. 'system' . DS . 'libs' . DS . 'class.' . strtolower($class) . '.php'))
            include_once ROOT. 'system' . DS . 'libs' . DS . 'class.' . strtolower($class) . '.php';
    }

spl_autoload_register('autoLoadCore');
spl_autoload_register('autoLoadLibs');
