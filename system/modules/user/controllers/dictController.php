<?php

class dictController extends userController
{
    private $dict;

    public function __construct()
    {
        parent::__construct();
        $this->dict = $this->loadModel('dict');
        $this->access_init();
    }

    public function index($page = FALSE)
    {

        $this->view->setJs(array('main'));

        if (!$this->filterInt($page)) {
            $page = false;
        } else {
            $page = (int)$page;
        }

        $pagination = new Pagination();

        $this->view->assign('words', $pagination->pager($this->dict->getWords(), $page));
        $this->view->assign('pagination', $pagination->getView('word', 'user/dict/page'));
        $this->view->assign('title', 'Dictionary');
        $this->view->render('index', 'Dictionary');
        $this->dict->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited this page', 'Dictionary');
    }

    public function new_word()
    {
        $this->acl->access('new_word');

        $this->view->assign('title', 'Add New word');
        $this->view->setJsPlugin(array('jquery.validate'));
        $this->view->setJs(array('new_word'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);
            $this->view->assign('cat', $this->dict->getDictCat());

            if (!$this->getWordParam('word')) {
                $this->view->assign('error', 'You must enter a word.');
                $this->view->render('new_word', 'Dictionary');
                exit;
            }

            if (!$this->getText('spelling')) {
                $this->view->assign('error', 'You must enter the word\'s spelling.');
                $this->view->render('new_word', 'Dictionary');
                exit;
            }

            if (!$this->getText('meaning')) {
                $this->view->assign('error', 'You must enter the word\'s meaning.');
                $this->view->render('new_word', 'Dictionary');
                exit;
            }

            $image = '';

            if (isset($_FILES['image']['name'])) {
                $media = ROOT . 'public' . DS . 'media' . DS . 'uploads' . DS;
                $upload = new upload($_FILES['image']);
                $upload->allowed = array('image/*');
                $upload->file_new_name_body = 'upl_' . uniqid();
                $upload->process($media);

                if ($upload->processed) {
                    $image = $upload->file_dst_name;;
                    $thumb = new upload($upload->file_dst_pathname);
                    $thumb->image_resize = TRUE;
                    $thumb->image_x = 100;
                    $thumb->image_y = 70;
                    $thumb->file_name_body_pre = 'thumb_';
                    $thumb->process($media . 'thumbs' . DS);
                } else {
                    $this->view->assign('error', $upload->error);
                    $this->view->render('new_word', 'Dictionary');
                    exit;
                }
            }

            if (!$this->getInt('cat')) {
                $this->view->assign('error', 'You must select a category.');
                $this->view->render('new_word', 'Dictionary');
                exit;
            }

            $this->dict->insertWord(
                $this->getText('word'), $this->getWordParam('spelling'), $this->getText('meaning'),
                $this->getText('r_word'), $this->getWordParam('examples'), $image, $this->getInt('cat')
            );

            $this->redirect('user/dict');
        }

        $this->view->assign('cat', $this->dict->getDictCat());
        $this->view->render('new_word', 'Dictionary');
        $this->dict->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited this page', 'Dictionary');
    }

    public function edit($id)
    {
        $this->acl->access('edit_word');

        if (!$this->filterInt($id)) {
            $this->redirect('user/dict');
        }

        if (!$this->dict->getWord($this->filterInt($id))) {
            $this->redirect('user/dict');
        }

        $this->view->assign('title', 'Edit Word');
        $this->view->setJsPlugin(array('jquery.validate'));
        $this->view->setJs(array('new_word'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            if (!$this->getWordParam('word')) {
                $this->view->assign('error', 'You must enter a word.');
                $this->view->render('edit', 'Dictionary');
                exit;
            }

            if (!$this->getText('spelling')) {
                $this->view->assign('error', 'You must enter the word\'s spelling.');
                $this->view->render('edit', 'Dictionary');
                exit;
            }

            if (!$this->getText('meaning')) {
                $this->view->assign('error', 'You must enter the word\'s meaning.');
                $this->view->render('edit', 'Dictionary');
                exit;
            }
            $this->dict->editWord(
                $this->filterInt($id), $this->getWordParam('word'), $this->getText('spelling'), $this->getText('meaning'),
                $this->getText('r_word'), $this->getWordParam('examples')
            );

            $this->redirect('user/dict');
        }

        $this->view->assign('data', $this->dict->getWord($this->filterInt($id)));
        $this->view->render('edit', 'Dictionary');
        $this->dict->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited this page', 'Dictionary');
    }

    public function delete($id)
    {
        if (!$this->filterInt($id)) {
            $this->redirect('user/dict');
        }

        if (!$this->dict->getWord($this->filterInt($id))) {
            $this->redirect('user/dict');
        }

        $this->dict->deleteWord($this->filterInt($id));
        $this->redirect('user/dict');
    }

    public function view($id)
    {
        if (!$this->filterInt($id)) {
            $this->redirect('user/dict');
        }

        if (!$this->dict->getWord($this->filterInt($id))) {
            $this->redirect('user/dict');
        }

        $this->view->assign('title', 'Word' . $this->getText('word'));
        $this->view->assign('data', $this->dict->getWord($this->filterInt($id)));
        $this->view->render('view', 'Dictionary');
        $this->dict->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Dictionary');
    }

    public function pureba($page = FALSE)
    {
        $pagination = new Pagination();

        $ajaxModel = $this->loadModel('ajax');
        $this->view->setJs(array('pureba'));
        $this->view->assign('paises', $ajaxModel->getPaises());
        $this->view->assign('pureba', $pagination->pager($this->dict->getPureba()));
        $this->view->assign('pagination', $pagination->getView('paginationAjax'));
        $this->view->assign('title', 'Pureba');
        $this->view->render('pureba', 'Pureba Paginaiton');
        $this->dict->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Dictionary');
    }

    public function purebaAjax()
    {
        $page = $this->getInt('page');
        $number = $this->getSql('number');
        $pais = $this->getInt('pais');
        $ciudad = $this->getInt('ciudad');
        $reg = $this->getInt('reg');

        $condition = "";

        if($number){
            $condition .= " AND `number` like '%$number%' ";
        }

        if($pais){
            $condition .= " AND `id_pais` = '$pais' ";
        }

        if($ciudad){
            $condition .= " AND `id_ciudad` = '$ciudad' ";
        }

        $pagination = new Pagination();

        $this->view->setJs(array('pureba'));
        $this->view->assign('pureba', $pagination->pager($this->dict->getPureba($condition), $page, $reg));
        $this->view->assign('pagination', $pagination->getView('paginationAjax'));
        $this->view->assign('title', 'Pureba');
        $this->view->render('ajax/pureba', false, true);
        $this->dict->sendAct(Session::get('f_name'), 'visited', 'successfully', 'successfully visited', 'Dictionary');
    }
}
