<?php

class modulesController extends aclController
{
    private $modules;

    public function __construct()
    {
        parent::__construct();
        $this->modules = $this->loadModel('modules');
    }

    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('title', 'Modules');
        $this->view->assign('modules', $this->modules->getModules());
        $this->view->render('index', 'Modules');
    }

    public function newModule(){
        $this->view->setJs(array('main'));
        $this->view->assign('title', 'New module');

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

 /*           if (!$this->getText('md_name')) {
                $this->view->assign('error', 'You must enter module\'s name.');
                $this->view->render('edit', 'Modules');
                exit;
            }*/

            $module = '';

            if (isset($_FILES['module']['name'])) {
                $dir = ROOT . 'system' . DS . 'modules' . DS;
                $upload = new upload($_FILES['module']);
                $upload->allowed = array('application/zip');

                if ($upload->uploaded){
                    $upload->Process($dir);
                    if($upload->processed){
                        $uf = $dir . $upload->file_dst_name;
                        $zip = new ZipArchive();
                        $res = $zip->open($uf);
                        if($res == true){
                            $zip->extractTo($dir);
                            $zip->close();

                            unlink($uf);
                        }
                        else{
                            $this->view->assign('error', 'Module upload couldn\'t completed.');
                            $this->view->render('newModule', 'New module');
                            exit;
                        }

                        $module = $upload->file_src_name_body;
                    }
                    else{
                        $this->view->assign('error', $upload->error);
                        $this->view->render('newModule', 'New module');
                        exit;
                    }
                }
            }

            $this->modules->insertModule($module,'');
            $this->view->assign('success', 'New module uploaded successfully.');

            $this->redirect("acl/modules");
        }

        $this->view->render('newModule', 'New module');
    }

    public function edit($id)
    {
        //$this->acl->access('edit_modules');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/modules');
        }

        if (!$this->modules->getModule($this->filterInt($id))) {
            $this->redirect('acl/modules');
        }

        $this->view->assign('title', 'Edit Modules');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('md_name')) {
                $this->view->assign('error', 'You must enter module\'s name.');
                $this->view->render('edit', 'Modules');
                exit;
            }

            if (!$this->getText('md_status')) {
                $this->view->assign('error', 'You must enter module\'s status.');
                $this->view->render('edit', 'Modules');
                exit;
            }

            $this->modules->editModule(
                $this->filterInt($id),
                $this->getText('md_name'),
                $this->getText('md_status')
            );

            //$this->view->assign('success', 'module updated successfully.');
            $this->redirect('acl/modules');
        }

        $this->view->assign('data', $this->modules->getModule($this->filterInt($id)));
        $this->view->render('edit', 'Edit Modules');
    }

    public function delete($id)
    {
        //$this->acl->access('delete_modules');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/modules');
        }

        if (!$this->modules->getModule($this->filterInt($id))) {
            $this->redirect('acl/modules');
        }

        $this->modules->deleteModule($this->filterInt($id));
        $this->redirect('acl/modules');
    }

    public function apps()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('title', 'Apps');
        $this->view->assign('apps', $this->modules->getApps());
        $this->view->render('apps', 'Apps');
    }
    
    public function newApp()
    {
        $this->view->assign('title', 'Add new apps');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('app_name')) {
                $this->view->assign('error', 'You must enter app\'s name.');
                $this->view->render('e', 'Apps');
                exit;
            }

            if (!$this->getText('app_icon')) {
                $this->view->assign('error', 'You must enter app\'s icon.');
                $this->view->render('e', 'Apps');
                exit;
            }

            if (!$this->getText('app_url')) {
                $this->view->assign('error', 'You must enter app\'s url.');
                $this->view->render('e', 'Apps');
                exit;
            }

            $this->modules->insertApp(
                $this->getText('app_name'),
                $this->getText('app_icon'),
                $this->getText('app_url')
            );

            //$this->view->assign('success', 'app updated successfully.');
            $this->redirect('acl/modules/apps');
        }
        
        $this->view->assign('modules', $this->modules->getModules());
        $this->view->render('newApp', 'Add new app');
    }

    public function e($id){
        //$this->acl->access('edit_apps');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/modules/apps');
        }

        if (!$this->modules->getApp($this->filterInt($id))) {
            $this->redirect('acl/modules/apps');
        }

        $this->view->assign('title', 'Edit Apps');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getText('app_name')) {
                $this->view->assign('error', 'You must enter app\'s name.');
                $this->view->render('e', 'Apps');
                exit;
            }

            if (!$this->getText('app_icon')) {
                $this->view->assign('error', 'You must enter app\'s icon.');
                $this->view->render('e', 'Apps');
                exit;
            }

            if (!$this->getText('app_url')) {
                $this->view->assign('error', 'You must enter app\'s url.');
                $this->view->render('e', 'Apps');
                exit;
            }

            $this->modules->editApp(
                $this->filterInt($id),
                $this->getText('app_name'),
                $this->getText('app_icon'),
                $this->getText('app_url')
            );

            //$this->view->assign('success', 'app updated successfully.');
            $this->redirect('acl/modules/apps');
        }

        $this->view->assign('modules', $this->modules->getModules());
        $this->view->assign('data', $this->modules->getApp($this->filterInt($id)));
        $this->view->render('e', 'Edit Apps');
    }

    public function d($id){
        //$this->acl->access('delete_apps');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/modules/apps');
        }

        if (!$this->modules->getApp($this->filterInt($id))) {
            $this->redirect('acl/modules/apps');
        }

        $this->modules->deleteApp($this->filterInt($id));
        $this->redirect('acl/modules/apps');
    }
}