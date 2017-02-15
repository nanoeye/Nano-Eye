<?php

abstract class Widget
{
    protected function loadModel($model)
    {
        if(is_readable(ROOT . 'system' . DS . 'widgets' . DS. 'models' . DS . $model . '.php')){
            require_once ROOT . 'system' . DS . 'widgets' . DS. 'models' . DS . $model . '.php';

            $modelClass = $model . 'ModelWidget';

            if(class_exists($modelClass)){
                return new $modelClass;
            }
        }

        throw new Exception('Model class not found or Model class loading error.');
    }

    protected function render($view, $data = array(), $ext = '.phtml')
    {
        if(is_readable(ROOT . 'system' . DS . 'widgets' . DS. 'views' . DS . $view . $ext)){
            ob_start();
            extract($data);
            include_once ROOT . 'system' . DS . 'widgets' . DS. 'views' . DS . $view . $ext;
            $content = ob_get_contents();
            ob_end_clean();

            return $content;
        }

        throw new Exception('Widget\'s views content not found');
    }
}