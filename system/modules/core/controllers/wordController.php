<?php

class wordController extends Controller
{
    private $word;

    public function __construct()
    {
        parent::__construct();
        $this->word = $this->loadModel('word');
    }

    public function index()
    {
        $this->redirect();
    }

    public function view($word)
    {
        if (!$word) {
            $this->redirect('search?q=' . $word);
        }

        if (!$this->word->getWord($word)) {
            $this->redirect('search?q=' . $word);
        }

        $this->view->assign('title', 'Word');
        $this->view->assign('data', $this->word->getWord($word));
        $this->view->render('view', 'Search');
    }

}