<?php

class ajaxController extends userController {
    
    private $ajax;

    public function __construct() {
        parent::__construct();
        $this->ajax = $this->loadModel('ajax');
        $this->access_init();
    }
    
    public function index() {
        $this->view->assign('title','Ajax Uploader');
        $this->view->setJs(array('ajax'));
        $this->view->assign('paises' , $this->ajax->getPaises());
        $this->view->render('index', 'Ajax Uploader');
        $this->ajax->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Ajax Uploader');
    }
    public function getCiudades(){
        if($this->getInt('pais'))
        echo json_encode($this->ajax->getCiudades($this->getInt('pais')));
    }
    
    public function insertCiudad(){
        if($this->getSql('ciudad') && $this->getInt('pais')){
            $this->ajax->insertCiudad(
                    $this->getSql('ciudad'),
                    $this->getInt('pais')
                    );
        }
    }
    
    public function data() {
        $this->view->assign('title','Ajax data Uploader');
        $this->view->setJs(array('ajax'));
        $this->view->assign('paises' , $this->ajax->getPaises());
        $this->view->render('data', 'Ajax Uploader');
        $this->ajax->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Ajax Uploader');
    }
}
