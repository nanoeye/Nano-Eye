<?php

class userController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->view->seTemplate('default');
        
    }

    public function index() {}
}