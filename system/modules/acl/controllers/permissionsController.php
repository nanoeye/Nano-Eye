<?php

class permissionsController extends aclController
{
    private $permissions;

    public function __construct()
    {
        parent::__construct();
        $this->permissions = $this->loadModel('permissions');
    }


    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('title', 'Administration\'s permissions');
        $this->view->assign('permissions', $this->permissions->getPermisionsAll());
        $this->view->render('index', 'Permissions');
    }
    public function new_permission()
    {
        //$this->acl->access('new_permission');

        $this->view->assign('title', 'New Permission');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('permission')) {
                $this->view->assign('error', 'You must enter a permission.');
                $this->view->render('new_permission', 'Permissions');
                exit;
            }
            if (!$this->getText('key')) {
                $this->view->assign('error', 'You must enter a key.');
                $this->view->render('new_permission', 'Permissions');
                exit;
            }

            $this->permissions->insertPermission(
                $this->getText('permission'),
                $this->getText('key')
            );

            $this->redirect('acl/permissions');
        }

        $this->view->render('new_permission', 'New Permission');
    }

    public function edit($id)
    {
        //$this->acl->access('edit_permission');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/permissions');
        }

        if (!$this->permissions->getPermisions($this->filterInt($id))) {
            $this->redirect('acl/permissions');
        }

        $this->view->assign('title', 'Edit Permission');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('permision')) {
                $this->view->assign('error', 'You must enter a permission.');
                $this->view->render('edit', 'Permissions');
                exit;
            }
            if (!$this->getText('key')) {
                $this->view->assign('error', 'You must enter a key.');
                $this->view->render('edit', 'Permissions');
                exit;
            }

            $this->permissions->editPermission(
                $this->filterInt($id),
                $this->getText('permision'),
                $this->getText('key')
            );

            //$this->view->assign('success', 'Permission updated successfully.');
            $this->redirect('acl/permissions');
        }

        $this->view->assign('data', $this->permissions->getPermisions($this->filterInt($id)));
        $this->view->render('edit', 'Edit Permission');
    }

    public function delete_permission($id)
    {
        //$this->acl->access('delete_permission');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/permissions');
        }

        if (!$this->permissions->getPermisionsAll($this->filterInt($id))) {
            $this->redirect('acl/permissions');
        }

        $this->permissions->deletePermission($this->filterInt($id));
        $this->redirect('acl/permissions');
    }

    public function permissions_role($roleId)
    {
        $id = $this->filterInt($roleId);

        if (!$id) {
            $this->redirect('acl/roles');
        }

        $row = $this->permissions->getRole($id);

        if (!$row) {
            $this->redirect('acl/roles');
        }

        $this->view->assign('title', 'Administration\'s permissions role');

        if ($this->getInt('val') == 1) {
            $values = array_keys($_POST);
            $replace = array();
            $delete = array();

            for ($i = 0; $i < count($values); $i++) {
                if (substr($values[$i], 0, 100) == 'perm_') {
                    if ($_POST[$values[$i]] == 'x') {
                        $delete[] = array(
                            'role' => $id,
                            'permision' => substr($values[$i], -1)
                        );
                    } else {
                        if ($_POST[$values[$i]] == 1) {
                            $v = 1;
                        } else {
                            $v = 0;
                        }

                        $replace[] = array(
                            'role' => $id,
                            'permision' => substr($values[$i], -1),
                            'value' => $v
                        );
                    }

                }
            }

            for ($i = 0; $i < count($delete); $i++) {
                $this->permissions->deletePermisionRole(
                    $delete[$i]['role'],
                    $delete[$i]['permision']);
            }

            for ($i = 0; $i < count($replace); $i++) {
                $this->permissions->editPermisionRole(
                    $replace[$i]['role'],
                    $replace[$i]['permision'],
                    $replace[$i]['value']);
            }

        }

        $this->view->assign('role', $row);
        $this->view->assign('permissions', $this->permissions->getPermisionsRole($id));
        $this->view->render('permissions_role', 'Permission Role');
    }
}