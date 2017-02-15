<?php

class contentsController extends officeController
{
    private $contents;

    public function __construct()
    {
        parent::__construct();

        $this->contents = $this->loadModel('contents');
    }

    public function index()
    {
        echo 'ok';
        $this->contents->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'ajahar');
    }

    public function dir($dir){

        if (!$this->filterInt($dir)) {
            $this->redirect('office');
        }

        if (!$this->contents->getDir($this->filterInt($dir))) {
            $this->redirect('office');
        }

        $this->view->assign('title', $this->contents->getDirName($this->filterInt($dir)));
        $this->view->setJs(array('main'));

        $this->view->assign('oj_files', $this->contents->getFiles($dir));
        $this->view->render('dir', 'NE office');
        $this->contents->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Edit ALAN office\'s dir');
    }

}