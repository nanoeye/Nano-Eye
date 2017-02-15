<?php

class rolesController extends aclController
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
        $this->roles = $this->loadModel('roles');
    }

    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('title', 'Administration\'s roles');
        $this->view->assign('roles', $this->roles->getRoles());
        $this->view->render('index', 'Roles');
    }

    public function new_role()
    {
        //$this->acl->access('new_role');

        $this->view->assign('title', 'New role');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('role')) {
                $this->view->assign('error', 'You must enter a role.');
                $this->view->render('new_role', 'Roles');
                exit;
            }

            $this->roles->insertRole($this->getText('role'));

            $this->redirect('acl/roles');
        }

        $this->view->render('new_role', 'New Role');
    }

    public function edit($id)
    {
        //$this->acl->access('edit_role');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/roles');
        }

        if (!$this->roles->getRole($this->filterInt($id))) {
            $this->redirect('acl/roles');
        }

        $this->view->assign('title', 'Edit role');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('role')) {
                $this->view->assign('error', 'You must enter a role.');
                $this->view->render('edit', 'Roles');
                exit;
            }

            $this->roles->editRole(
                $this->filterInt($id),
                $this->getText('role')
            );

            $this->redirect('acl/roles');
        }

        $this->view->assign('data', $this->roles->getRole($this->filterInt($id)));
        $this->view->render('edit', 'Edit Role');
    }

    public function delete($id)
    {
        //$this->acl->access('delete_role');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/roles');
        }

        if (!$this->roles->getRole($this->filterInt($id))) {
            $this->redirect('acl/roles');
        }

        $this->roles->deleteRole($this->filterInt($id));
        $this->redirect('acl/roles');
    }
}