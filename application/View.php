<?php

require_once ROOT . 'system' . DS . 'libs' . DS . 'smarty' . DS . 'SmartyBC.class.php';

class View extends SmartyBC
{
    private $request;
    private $_js;
    private $acl;
    private $roots;
    private $jsPlugin;
    private $template;
    private static $item;
    private $widget;

    public function __construct(Request $prediction, ACL $acl)
    {
        parent::__construct();
        $this->request = $prediction;
        $this->_js = array();
        $this->acl = $acl;
        $this->roots = array();
        $this->jsPlugin = array();
        $this->template = DEFAULT_LAYOUT;
        self::$item = null;

        $module = $this->request->getModule();
        $controller = $this->request->getController();

        if ($module) {
            $this->roots['view'] = ROOT . 'system' . DS . 'modules' . DS . $module . DS . 'views' . DS . 'pages/' . $controller . DS;
            $this->roots['js'] = BASE_URL . 'system' . DS . 'modules' . DS . $module . DS . 'views' . DS . 'pages/' . $controller . '/js/';
        } else {
            $this->roots['view'] = ROOT . 'system' . DS . 'modules' . DS . 'core' . DS . 'views' . DS . 'pages' . DS . $controller . DS;
            $this->roots['js'] = BASE_URL . 'system' . DS . 'modules' . DS . 'core' . DS . 'views' . DS . 'pages' . DS . $controller . '/js/';
        }
    }

    public static function getViewId()
    {
        return self::$item;
    }

    public function render($view, $item = false, $nolayout = false)
    {
        if ($item){
            self::$item = $item;
        }
        
        $this->template_dir = ROOT . 'system' . DS . 'themes' . DS . $this->template . DS;
        $this->config_dir = ROOT . 'system' . DS . 'themes' . DS . $this->template . DS. 'configs' . DS;
        $this->cache_dir = ROOT . 'tmp' . DS . 'cache' . DS;
        $this->compile_dir = ROOT . 'tmp' . DS . 'template' . DS;

        $media_img = BASE_URL . 'public' . DS . 'media' . DS . 'image' . DS;
        $logo_dir = BASE_URL . 'public' . DS . 'media' . DS . 'site' . DS. 'logo' . DS;
        $favicon = $logo_dir . $this->favicon();
        $profile_photos = BASE_URL . 'public' . DS . 'media' . DS . 'profile_photos' . DS;
        $uploads = BASE_URL . 'public' . DS . 'media' . DS . 'uploads' . DS;

        $redirect_uri = $_SERVER['REQUEST_URI'];

        $js = array();

        if (count($this->_js)) {
            $js = $this->_js;
        }

        $layoutParams = array(
            'root_css' => BASE_URL . 'system' . DS . 'themes' . DS . $this->template . DS . 'css'. DS,
            'root_img' => BASE_URL . 'system' . DS . 'themes' . DS . $this->template . DS . 'img'. DS,
            'root_js' => BASE_URL . 'system' . DS . 'themes' . DS . $this->template . DS . 'js'. DS,
            'js' => $js,
            'jsPlugin' => $this->jsPlugin,
            'media_img' => $media_img,
            'logo_dir' => $logo_dir,
            'favicon' => $favicon,
            'profile_photos' => $profile_photos,
            'uploads' => $uploads,
            'redirect_uri' => $redirect_uri,
            'root' => BASE_URL,
            'configs' => array(
                'app_name' => APP_NAME,
                'app_slogan' => APP_SLOGAN,
                'app_company' => APP_COMPANY
            )
        );

        if (is_readable($this->roots['view'] . $view . '.tpl')) {

            if($nolayout){
                $this->template_dir = $this->roots['view'];
                $this->display($this->roots['view'] . $view . '.tpl');
                exit;
            }
            $this->assign('content', $this->roots['view'] . $view . '.tpl');
        } else {
            throw new Exception('Page or content not found or page location is wrong.');
            //header('location:' . BASE_URL . 'error/access/404');
        }

        $this->assign('widgets', $this->getWidgets());
        $this->assign('acl', $this->acl);
        $this->assign('layoutParams', $layoutParams);
        $this->display('template.tpl');
    }

    public function setJs(array $js)
    {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_js[] = $this->roots['js'] . $js[$i] . '.js';
            }
        } else {
            throw new Exception('JavaScript file not found or error while loading JavaScript files.');
            //header('location:' . BASE_URL . 'error/access/404');
        }
    }

    public function setJsPlugin(array $js)
    {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->jsPlugin[] = BASE_URL . 'public' . DS . 'js' . DS . 'plugin' .DS .  $js[$i] . '.js';
            }
        } else {
            throw new Exception('JavaScript Plugin file not found or error while loading JavaScript files.');
            //header('location:' . BASE_URL . 'error/access/404');
        }
    }

    public function seTemplate($template){
        $this->template = (string) $template;
    }

    public function widget($widget, $method, $options = array())
    {
        if(!is_array($options)){
            $options = array($options);
        }

            if(is_readable(ROOT . 'system' . DS . 'widgets' . DS . $widget . '.php')){
                include_once ROOT . 'system' . DS . 'widgets' . DS . $widget . '.php';

                $widgetClass = $widget . 'Widget';

                if(!class_exists($widgetClass)){
                    throw new Exception('Widget class not found or Widget class call error.');
                }

                if(is_callable($widgetClass, $method)){
                    if(count($options)){
                        return call_user_func_array(array(new $widgetClass, $method), $options);
                    }
                    else {
                        return call_user_func(array(new $widgetClass, $method));
                    }
                }
            }

        throw new Exception('Widget\'s content not found.');
        //header('location:' . BASE_URL . 'error/access/404');
    }

    public function getLayoutPositions()
    {
        if(is_readable(ROOT . 'system' . DS . 'themes' . DS . $this->template . DS . 'configs.php')){
            include_once ROOT . 'system' . DS . 'themes' . DS . $this->template . DS . 'configs.php';

            return get_layout_positions();
        }

        throw new Exception('Layout configuration file not found.');
        //header('location:' . BASE_URL . 'error/access/404');
    }

    public function getWidgets()
    {
        $widgets = array(
            'menu-header' => array(
                'config' => $this->widget('menu', 'getConfig', array('header')),
                'content' => array('menu', 'getMenu', array('header', 'header'))
            ),

            'menu-titlebar' => array(
                'config' => $this->widget('menu', 'getConfig', array('titlebar')),
                'content' => array('menu', 'getMenu', array('titlebar', 'titlebar'))
            ),

            'menu-top' => array(
                'config' => $this->widget('menu', 'getConfig', array('top')),
                'content' => array('menu', 'getMenu', array('top', 'top'))
            ),

            'menu-left' => array(
                'config' => $this->widget('menu', 'getConfig', array('left')),
                'content' => array('menu', 'getMenu', array('left', 'left'))
            ),

            'menu-right' => array(
                'config' => $this->widget('menu', 'getConfig', array('right')),
                'content' => array('menu', 'getMenu', array('right', 'right'))
            ),

            'menu-footer' => array(
                'config' => $this->widget('menu', 'getConfig', array('footer')),
                'content' => array('menu', 'getMenu', array('footer', 'footer'))
            )
        );

        $positions = $this->getLayoutPositions();
        $keys = array_keys($widgets);

        foreach ($keys as $k){
            /* Verification of widgets position visibility. */
            if(isset($positions[$widgets[$k]['config']['position']])){
                /* Verification it's view disability */
                if(!isset($widgets[$k]['config']['hide']) || !in_array(self::$item, $widgets[$k]['config']['hide'])){
                  /* Verification it's view visibility */
                    if($widgets[$k]['config']['show'] === 'all' || in_array(self::$item, $widgets[$k]['config']['show'])){

                        if(isset($this->widget[$k]))
                        {
                            $widgets{$k}['content'][2] = $this->widget[$k];
                        }

                        /*is it's have position in layout*/
                        $positions[$widgets[$k]['config']['position']][] = $this->getWidgetContent($widgets[$k]['content']);
                    }
                }
            }
        }
        
        return $positions;
    }

    public function getWidgetContent(array $content)
    {
        if(!isset($content[0]) || !isset($content[1])){
            throw new Exception('Widget\'s content not found.');
            return;
        }

        if (!isset($content[2])){
            $content[2] = array();
        }

        return $this->widget($content[0], $content[1], $content[2]);
    }

    public function setWidgetOptions($key, $options)
    {
        $this->widget[$key] = $options;
    }

    public function favicon(){
        $setting = new Setting();
        $favicon = $setting->siteFevicon();

        if(!empty($favicon)){
            return $favicon;
        }
    }
}
