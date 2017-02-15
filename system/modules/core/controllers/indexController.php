<?php

class indexController extends Controller
{
    private $index;

    public function __construct()
    {
        parent::__construct();
        $this->index = $this->loadModel('index');
    }

    public function index()
    {
        /*$this->redirect('mode');*/
        $this->view->setJs(array('index'));
        $this->view->assign('title', 'Home');

        $vCounter = new HitCounter();
        $vCounter->processViews();

        $this->view->assign('visitor_total', $vCounter->getTotalHits());
        $this->view->assign('visitor_unique', $vCounter->getTotalVisitor());
        $this->view->assign('MyHits', $vCounter->getMyHits());

        $this->view->render('index', 'Home');
        $this->index->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Home');
    }

    public function cat()
    {
        $this->view->setJs(array('index'));
        $this->view->assign('title', 'Categories');
        $this->view->assign('catagories', $this->index->getCat());
        $this->view->render('cat', 'catagories');
        $this->index->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'catagories');
    }

    public function welcome()
    {
        $this->view->setJs(array('index'));
        $this->view->assign('title', 'Welcome');
        $this->view->render('welcome', 'Welcome');
        $this->index->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Welcome');
    }
}