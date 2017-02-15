<?php

class indexController extends aclController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('index');
    }

    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('acl_menu' , $this->model->getAclMenus());
        $this->view->assign('title', 'Control Panel');
        $this->view->render('index', 'Control Panel');
    }

    public function item()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('acl_menu' , $this->model->getAclMenus());
        $this->view->assign('title', 'Acl item');
        $this->view->render('item', 'Acl item');
    }

    public function newItem()
    {
        $this->view->assign('title', 'New acl item');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('am_name')) {
                $this->view->assign('error', 'Please enter item\' name.');
                $this->view->render('newItem', 'New Acl item');
                exit;
            }
            if (!$this->getText('am_title')) {
                $this->view->assign('error', 'Please enter item\' title.');
                $this->view->render('newItem', 'New acl item');
                exit;
            }

            if (!$this->getText('am_url')) {
                $this->view->assign('error', 'Please enter item\' url.');
                $this->view->render('newItem', 'New acl item');
                exit;
            }

            if (!$this->getText('am_icon')) {
                $this->view->assign('error', 'Please enter item\' icon.');
                $this->view->render('newItem', 'New acl item');
                exit;
            }

            $this->model->insertItem(
                $this->getText('am_name'),
                $this->getText('am_title'),
                $this->getText('am_url'),
                $this->getText('am_icon')
            );

            $this->redirect('acl/index/item');
        }

        $this->view->render('newItem', 'New acl item');
    }

    public function edit($id)
    {
        //$this->acl->access('edit_item');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/index/item');
        }

        if (!$this->model->getAclMenu($this->filterInt($id))) {
            $this->redirect('acl/index/item');
        }

        $this->view->assign('title', 'Edit acl item');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            $this->model->editItem(
                $this->filterInt($id),
                $this->getText('am_name'),
                $this->getText('am_title'),
                $this->getText('am_url'),
                $this->getText('am_icon')
            );

            $this->redirect('acl/index/item');
        }

        $this->view->assign('acl_item', $this->model->getAclMenu($this->filterInt($id)));
        $this->view->render('edit', 'Edit acl item');
    }

    public function delete($id)
    {
        //$this->acl->access('delete_item');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/index/item');
        }

        if (!$this->model->getAclMenu($this->filterInt($id))) {
            $this->redirect('acl/index/item');
        }

        $this->model->deleteAclMenu($this->filterInt($id));
        $this->redirect('acl/index/item');
    }
}
