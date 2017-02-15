<?php

class appsController extends aclController
{

    private $apps;
    private $rar;
    private $zip;

    public function __construct()
    {
        parent::__construct();
        $this->apps = $this->loadModel('apps');
        $this->zip = new ZipArchive();
    }

    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('apps', $this->apps->getApps());
        $this->view->assign('title', 'Apps');
        $this->view->render('index', 'Apps');
    }

    public function item()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('apps' , $this->apps->getApps());
        $this->view->assign('title', 'All app');
        $this->view->render('item', 'All app');
    }

    public function newItem()
    {
        $this->view->assign('title', 'Add new app');
		$this->view->assign('modules', $this->apps->getModules());
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('module')) {
                $this->view->assign('error', 'Please select a module.');
                $this->view->render('newItem', 'Add new app');
                exit;
            }

            if (!$this->getText('app_icon')) {
                $this->view->assign('error', 'Please enter app\'s icon.');
                $this->view->render('newItem', 'Add new app');
                exit;
            }

            if (!$this->getText('app_status')) {
                $this->view->assign('error', 'Please select app\'s status.');
                $this->view->render('newItem', 'Add new app');
                exit;
            }

            $this->apps->insertItem(
                ucfirst($this->getText('module')),
                $this->getText('module'),
                $this->getText('app_icon'),
                $this->getText('app_status')
            );

            $this->redirect('acl/apps/item');
        }

        $this->view->render('newItem', 'Add new app');
    }

    public function edit($id)
    {
        //$this->acl->access('edit_item');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/apps/item');
        }

        if (!$this->apps->getApp($this->filterInt($id))) {
            $this->redirect('acl/apps/item');
        }

        $this->view->assign('modules', $this->apps->getModules());
        $this->view->assign('app', $this->apps->getApp($this->filterInt($id)));

        $this->view->assign('title', 'Edit app');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            $this->apps->edit(
                $this->filterInt($id),
                ucfirst($this->getText('module')),
                $this->getText('module'),
                $this->getText('app_icon'),
                $this->getText('app_status')
            );

            $this->redirect('acl/apps/item');
        }

        $this->view->render('edit', 'Edit app');
    }

    public function delete($id)
    {
        //$this->acl->access('delete_item');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/apps/item');
        }

        if (!$this->apps->getApp($this->filterInt($id))) {
            $this->redirect('acl/apps/item');
        }

        $this->apps->delete($this->filterInt($id));
        $this->redirect('acl/apps/item');
    }

}
