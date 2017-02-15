<?php

class logController extends userController {

    private $log;

    public function __construct() {
        parent::__construct();
        $this->log = $this->loadModel('log');

        $this->view->seTemplate('goahead');
    }

    public function index() {
        
        if (Session::get('auth')) {
            $this->redirect();
        } else {
            $this->redirect('user/log/in');
        }
    }

    public function in() {
        $this->view->assign('title', 'Log In');

        if ($this->getInt('enviar') == 1) {
            $this->view->assign('datas', $_POST);

            if (!$this->getAlphaNum('username')) {
                $this->view->assign('error', 'Invalid or incorrect username.');
                $this->view->render('in', 'Login');
                $this->log->sendAct($this->getAlphaNum('username'), 'error', 'Invalid or incorrect', 'pass:'. $this->getAlphaNum('username'), 'Log In');
                exit;
            }

            if (!$this->getSql('password')) {
                $this->view->assign('error', 'Invalid or incorrect password.');
                $this->view->render('in', 'Login');
                $this->log->sendAct($this->getAlphaNum('username'), 'error', 'Invalid or incorrect', 'pass:'. $this->getSql('password'), 'Log In');
                exit;
            }

            $row = $this->log->getUser( 'alan_'.
                    $this->getAlphaNum('username'), $this->getSql('password')
            );

            if (!$row) {
                $this->view->assign('error', 'Log In fail. Invalid or incorrect username & password.');
                $this->view->render('in', 'Login');
                $this->log->sendAct($this->getAlphaNum('username'), 'error', 'Log In fail', 'pass:'. $this->getSql('password'), 'Log In');
                exit;
            }

            if ($row['status'] != 1) {
                $this->view->assign('error', 'User or Username not exist.');
                $this->view->render('in', 'Login');
                $this->log->sendAct($this->getAlphaNum('username'), 'error', 'not exist', 'pass:'. $this->getSql('password'), 'Log In');
                exit;
            }

            Session::set('auth', TRUE);
            Session::set('level', $row['role']);
            Session::set('username', $row['username']);
            Session::set('f_name', $row['f_name']);
            Session::set('id_user', $row['id']);
            Session::set('time', time());

            $this->log->sendAct(Session::get('f_name'), 'loged in', 'successfully', 'pass:'. $this->getSql('password'), 'Log In');
            $this->redirect_uri($this->getSearchText('redirect'));
        }

        $this->view->render('in', 'Login');
        $this->log->sendAct('no username', 'visited', 'successfully', 'successfully visited', 'Log In');
    }

    public function out() {
        Session::destroy();
        $this->redirect();
    }

    public function loging() {
        $this->view->assign('title', 'Loging. Wait for a moment.');
        if ($this->getInt('enviar') == 1) {
            $this->view->assign('datas', $_POST); 

            if ($this->datas['username'] && $this->datas['password']) {
                $row = $this->log->getUser(
                        $this->datas['username'],
                        $this->$this->datas['password']
                );

                Session::set('auth', TRUE);
                Session::set('level', $row['role']);
                Session::set('username', $row['username']);
                Session::set('id_user', $row['id']);
                Session::set('time', time());

                $this->redirect();
            }
        } else {
            $this->redirect('user/log/in');
        }
    }

}
