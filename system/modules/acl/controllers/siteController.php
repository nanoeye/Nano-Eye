<?php

class siteController extends aclController
{
    private $site;

    public function __construct()
    {
        parent::__construct();
        $this->site = $this->loadModel('site');
    }

    public function index()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('siteInfo' , $this->site->getSiteInfo());
        $this->view->assign('title', 'Manage website');
        $this->view->render('index', 'Manage website');
    }

    public function edit($id)
    {
        //$this->acl->access('edit_site');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/site');
        }

        if (!$this->site->getSiteInfo($this->filterInt($id))) {
            $this->redirect('acl/site');
        }
        $this->view->assign('title', 'Edit site Informaion');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

/*            if (!$this->getText('name')) {
                $this->view->assign('error', 'You must enter your site\'s name.');
                $this->view->render('edit', 'edit website');
                exit;
            }

            if (!$this->getText('doc_root')) {
                $this->view->assign('error', 'You must enter your siteৱ\'s site root.');
                $this->view->render('edit', 'edit website');
                exit;
            }

            if (!$this->getText('http_host')) {
                $this->view->assign('error', 'You must enter your siteৱ\'s host server.');
                $this->view->render('edit', 'edit website');
                exit;
            }

            if (!$this->getText('favicon')) {
                $this->view->assign('error', 'You must enter your siteৱ\'s favicon.');
                $this->view->render('edit', 'edit website');
                exit;
            }

            if (!$this->getText('default_home')) {
                $this->view->assign('error', 'You must enter your siteৱ\'s default home page.');
                $this->view->render('edit', 'edit website');
                exit;
            }*/

            $this->site->editSite(
                $this->filterInt($id),
                $this->getText('name'),
                $this->getText('doc_root'),
                $this->getText('http_host_add'),
                $this->getText('default_home')
            );

            $this->redirect('acl/site');
        }

        $this->view->assign('site', $this->site->getSiteInfo());
        $this->view->render('edit', 'Edit website');
    }

    public function upload_logo($id)
    {
        //$this->acl->access('edit_site');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/site');
        }

        if (!$this->site->getSiteInfo($this->filterInt($id))) {
            $this->redirect('acl/site');
        }
        $this->view->assign('title', 'Upload logo');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            $image = '';
            $icon_dir = '';

            if (isset($_FILES['favicon']['name'])) {
                $dir = 'public/media/site/logo/';/*'public' . DS . 'media' . DS . 'site' . DS. 'logo' . DS;*/
                $media = ROOT . $dir;
                $upload = new upload($_FILES['favicon']);
                $upload->allowed = array('image/*');
                $upload->file_new_name_body = 'logo_' . uniqid();
                $upload->process($media);

                if ($upload->processed) {
                    $image = $upload->file_dst_name;
                    $icon_dir = BASE_URL . $dir;
                }
                else {
                    $this->view->assign('error', $upload->error);
                    $this->view->render('upload_logo', 'Upload Favicon');
                    exit;
                }
            }

            $this->site->setLogo($id, $icon_dir, $image);
            $this->view->assign('success', 'Favicon uploaded successfully.');

            $this->redirect("acl/site");
        }

        $this->view->render('upload_logo', 'Upload Favicon');
    }
}