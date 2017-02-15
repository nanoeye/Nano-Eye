<?php

class regController extends userController
{
    private $reg;

    public function __construct()
    {
        parent::__construct();

        $this->reg = $this->loadModel('reg');
    }

    public function index()
    {

        $this->view->setJs(array('main'));
        $this->view->seTemplate('goahead');

        if (Session::get('auth')) {
            $this->redirect();
        }

        $this->view->assign('title', 'Sign Up');

        if ($this->getInt('enviar') == 1) {
            $this->view->assign('datas', $_POST);

            if (!$this->getSql('f_name')) {
                $this->view->assign('error', 'Please enter your first name.');
                $this->view->render('index', 'Register');
                exit;
            }

            if (!$this->getSql('l_name')) {
                $this->view->assign('error', 'Please enter your last name.');
                $this->view->render('index', 'Register');
                exit;
            }

            if (!$this->getAlphaNum('username')) {
                $this->view->assign('error', 'Please enter your username.');
                $this->view->render('index', 'Register');
                exit;
            }

            if ($this->reg->varifyusername($this->getAlphaNum('username'))) {
                $this->view->assign('error', 'The username <b>' . $this->getAlphaNum('username') . '</b> has already exist. Please enter new one.');
                $this->view->render('index', 'Register');
                exit;
            }

            if (!$this->validEmail($this->getWordParam('email'))) {
                $this->view->assign('error', 'Entered email address is invalid. Please enter valid email address.');
                $this->view->render('index', 'Register');
                exit;
            }

            if ($this->reg->varifyEmail($this->getWordParam('email'))) {
                $this->view->assign('error', '<b>' . $this->getWordParam('email') . '</b> has been already registered');
                $this->view->render('index', 'Register');
                exit;
            }

            if (!$this->getSql('password')) {
                $this->view->assign('error', 'Please enter your password.');
                $this->view->render('index', 'Register');
                exit;
            }

            if ($this->getWordParam('password') != $this->getWordParam('c_password')) {
                $this->view->assign('error', 'Your entered password does not match. Please enter your same password.');
                $this->view->render('index', 'Register');
                exit;
            }

            $this->reg->addUser(
                $this->getSql('f_name'),
                $this->getSql('l_name'),
                $this->getWordParam('email'),
                $this->getSql('password'),
                $this->getAlphaNum('username')
            );

            $mail = new PHPMailer;

            $username = $this->reg->varifyusername($this->getAlphaNum('username'));

            if ($username) {
                $this->view->assign('error', 'Registration could not Complete.');
                $this->view->render('index', 'Register');
                exit;
            }


            $mail->From = 'www.nanoeye.com';
            $mail->FromName = 'Nano Eye';
            $mail->Subject = 'Active your account.';
            $mail->Body = 'Hello <strong>' . $this->getSql('f_name') . '</strong> .' .
                '<p> You recently create a account in <strong>web.alan.local</strong>. But ' .
                'your account inactive now and it will be inactive untill activation of your account. ' .
                'So your must need active your account for use it and enjoy our all facilities. ' .
                '<a href = "' . BASE_URL . 'user/reg/activation/' . $username['id'] . '/' . $username['code'] .
                '">' . BASE_URL . 'user/reg/activation/' . $username['id'] . '/' . $username['code'] .
                '</a>.</p>';

            $mail->AltBody = '<p>Service Porvider could not support HTML.</p>';
            $mail->AddAddress($this->getWordParam('email'));
            $mail->Send();

            $this->view->assign('datas', FALSE);
            $this->view->assign('success', 'New user <b>' . $this->getSql('f_name') .
                '</b> has been registered successfully and we sen an email to your email address <b>' .
                $this->getWordParam('email') . '</b>. Receive the mail and active your valuable account.');

            //$this->redirect('user/reg/next');
        }
        $this->view->render('index', 'Register');
    }

    public function next()
    {
        /*start test coding*/
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

        $this->dict->insertWord(
            $this->getText('word'), $this->getText('spelling'), $this->getText('meaning'),
            $this->getText('r_word'), $this->getWordParam('examples'), $image
        );
        /*end test coding*/
        $this->view->assign('title', 'Complete your profile!');
        $this->view->render('next', 'Register');
    }

    public function check_mail()
    {


    }

    public function activation($id, $code)
    {
        if (!$this->filterInt($id) || !$this->filterInt($code)) {
            $this->view->assign('error', 'This code <strong>' . $this->filterInt($code) . '</strong> of active <strong>' . $this->filterInt($id) . '<strong> account does not exist.');
            $this->view->render('activation', 'Register');
            exit;
        }

        $row = $this->reg->getUser(
            $this->filterInt($id),
            $this->filterInt($code)
        );

        if (!$row) {
            $this->view->assign('error', 'This code <strong>' . $this->filterInt($code) . '</strong> of active <strong>' . $this->filterInt($id) . '</strong> account does not exist.');
            $this->view->render('activation', 'Register');
            exit;
        }

        if ($row['status'] == 1) {
            $this->view->assign('error', 'This user already activated.');
            $this->view->render('activation', 'Register');
            exit;
        }

        $this->reg->activeUser(
            $this->filterInt($id),
            $this->filterInt($code)
        );

        $row = $this->reg->getUser(
            $this->filterInt($id),
            $this->filterInt($code)
        );

        if ($row['status'] == 0) {
            $this->view->assign('error', 'Failed to active the <b>' . $this->getSql('name') . '</b> user\' account.');
            $this->view->render('activation', 'Register');
            exit;
        }

        $this->view->assign('title', 'Registered user account activation');
        $this->view->assign('success', 'New user <b>' . $this->getSql('name') . '</b> has been actived successfully.');
        $this->view->render('activation', 'Register');
    }

}