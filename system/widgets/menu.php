<?php

class menuWidget extends Widget
{
    private $menu;

    public function __construct()
    {
        $this->menu = $this->loadModel('menu');
    }

    public function getMenu($menu, $view, $inverse = null, $siteInfo = null)
    {
        $data['menu'] = $this->menu->getMenu($menu);
        $data['inverse'] = $inverse;
        $data['siteInfo'] = $siteInfo;
        $data['siteInfo'] = $this->menu->getSiteInfo();
        return $this->render($view, $data);
    }

    public function getConfig($menu)
    {
        $menus['header'] = array(
            'position' => 'header',
            'show' => 'all',
            'hide' => array('Login', 'Register', 'default_home')
        );

        $menus['titlebar'] = array(
            'position' => 'titlebar',
            'show' => 'all',
            'hide' => array('Login', 'Register', 'default_home')
        );

        $menus['top'] = array(
            'position' => 'top',
            'show' => 'all',
            'hide' => array('Login', 'Register')
        );

        $menus['left'] = array(
            'position' => 'left',
            'show' => 'all',
            'hide' => array('Home', 'Login', 'Register')
        );
        $menus['right'] = array(
            'position' => 'right',
            'show' => 'all',
            'hide' => array('Home', 'Login', 'Register')
        );
        $menus['footer'] = array(
            'position' => 'footer',
            'show' => 'all',
            'hide' => array('Home', 'Login', 'Register')
        );

        return $menus[$menu];
    }

}