<?php

class modeController extends Controller
{
    private $mode;

    public function __construct()
    {
        parent::__construct();
        $this->mode = $this->loadModel('mode');

        $this->view->seTemplate('goahead');
    }

    public function index()
    {
        $this->redirect('mode/home');
    }

    public function home()
    {
        $this->view->setJs(array('main')); /*complete later.*/
        $this->view->render('home', 'Mode');
    }

    public function getWords()
    {
        $words = $this->mode->getWords();
        echo json_encode($words);
    }

}