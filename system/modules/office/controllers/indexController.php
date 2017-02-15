<?php

class indexController extends officeController
{
    private $o;

    public function __construct()
    {
        parent::__construct();
        $this->o = $this->loadModel('index');
        /*$this->o->init();*/
    }

    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('jobs_cats' , $this->o->getJobCats());
        $this->view->assign('title', 'NE Office');
        $this->view->render('index', 'NE Office');
        $this->o->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'NE Office');
    }

    public function item()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('jobs_cats' , $this->o->getJobCats());
        $this->view->assign('title', 'NE Office');
        $this->view->render('item', 'NE Office');
        $this->o->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'NE Office item');
    }

    public function newItem()
    {
        $this->view->assign('title', 'ALAN office new item');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('oj_name')) {
                $this->view->assign('error', 'Please enter item\' name.');
                $this->view->render('newItem', 'ALAN office new item');
                exit;
            }
            if (!$this->getText('oj_title')) {
                $this->view->assign('error', 'Please enter item\' title.');
                $this->view->render('newItem', 'ALAN office new item');
                exit;
            }

            if (!$this->getText('oj_url')) {
                $this->view->assign('error', 'Please enter item\' url.');
                $this->view->render('newItem', 'ALAN office new item');
                exit;
            }

            if (!$this->getText('oj_icon')) {
                $this->view->assign('error', 'Please enter item\' icon.');
                $this->view->render('newItem', 'ALAN office new item');
                exit;
            }

            $this->o->insertItem(
                $this->getText('oj_name'),
                $this->getText('oj_title'),
                $this->getText('oj_url'),
                $this->getText('oj_icon')
            );

            $this->redirect('office/index/item');
        }

        $this->view->render('newItem', 'ALAN office New item');
        $this->o->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'ALAN office New item');
    }

    public function edit($id)
    {
        //$this->acl->access('edit_item');

        if (!$this->filterInt($id)) {
            $this->redirect('office/index/item');
        }

        if (!$this->o->getJobCat($this->filterInt($id))) {
            $this->redirect('office/index/item');
        }

        $this->view->assign('title', 'Edit ALAN office\'s item');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            $this->o->editItem(
                $this->filterInt($id),
                $this->getText('oj_name'),
                $this->getText('oj_title'),
                $this->getText('oj_url'),
                $this->getText('oj_icon')
            );

            $this->redirect('office/index/item');
        }

        $this->view->assign('jobs_cat', $this->o->getJobCat($this->filterInt($id)));
        $this->view->render('edit', 'Edit ALAN office\'s item');
        $this->o->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Edit ALAN office\'s item');
    }

    public function delete($id)
    {
        //$this->acl->access('delete_item');

        if (!$this->filterInt($id)) {
            $this->redirect('office/index/item');
        }

        if (!$this->o->getJobCat($this->filterInt($id))) {
            $this->redirect('office/index/item');
        }

        $this->o->deleteItem($this->filterInt($id));
        $this->redirect('office/index/item');
    }
}
