<?php

class usersController extends aclController
{
    private $users;

    public function __construct()
    {
        parent::__construct();
        $this->users = $this->loadModel('users');
    }

    public function index($page = FALSE)
    {
        //$this->acl->access('Users');
        $this->view->setJs(array('main'));

        if (!$this->filterInt($page)) {
            $page = false;
        } else {
            $page = (int)$page;
        }

        $pagination = new Pagination();

        $this->view->assign('users', $pagination->pager($this->users->getUsers(), $page));
        $this->view->assign('pagination', $pagination->getView('word', 'acl/users/page'));

        $this->view->assign('title', 'Users');
        $this->view->render('index', 'Users');
    }

    public function new_user()
    {
        //$this->acl->access('new_user');

        $this->view->assign('title', 'New User');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);
            $this->view->assign('roles' , $this->users->getRoles());

            if(!$this->getSql('f_name')){
                $this->view->assign('error' , 'Please enter user\'s first name.');
                $this->view->render('new_user', 'New User');
                exit;
            }

            if(!$this->validEmail($this->getWordParam('email'))){
                $this->view->assign('error' , 'Entered email address is invalid. Please enter valid email address.');
                $this->view->render('new_user', 'New User');
                exit;
            }

            if($this->users->varifyEmail($this->getWordParam('email'))){
                $this->view->assign('error' , '<b>'. $this->getWordParam('email') .'</b> has been already registered');
                $this->view->render('new_user', 'New User');
                exit;
            }

            if(!$this->getAlphaNum('username')){
                $this->view->assign('error' , 'Please enter user\'s username.');
                $this->view->render('new_user', 'New User');
                exit;
            }

            if($this->users->varifyusername($this->getAlphaNum('username'))){
                $this->view->assign('error' , 'The username <b>'. $this->getAlphaNum('username') .'</b> has already exist. Please enter new one.');
                $this->view->render('new_user', 'New User');
                exit;
            }

            if(!$this->getSql('password')){
                $this->view->assign('error' , 'Please enter your password.');
                $this->view->render('new_user', 'New User');
                exit;
            }

            if($this->getWordParam('password') != $this->getWordParam('c_password')){
                $this->view->assign('error' , 'Your entered password does not match. Please enter your same password.');
                $this->view->render('new_user', 'New User');
                exit;
            }
            if(!$this->getWordParam('dob')){
                $this->view->assign('error' , 'Please enter user\'s date of birth.');
                $this->view->render('new_user', 'New User');
                exit;
            }

            if(!$this->getText('gender')){
                $this->view->assign('error' , 'Please select user\'s gender.');
                $this->view->render('new_user', 'New User');
                exit;
            }

            if(!$this->getInt('role')){
                $this->view->assign('error' , 'Please enter user\'s role.');
                $this->view->render('new_user', 'New User');
                exit;
            }

            $this->users->insertUser(
                $this->getSql('f_name'),
                $this->getSql('l_name'),
                $this->getWordParam('email'),
                $this->getSql('password'),
                $this->getAlphaNum('username'),
                $this->getWordParam('dob'),
                $this->getText('gender'),
                $this->getInt('role'),
                $this->getText('profession')
            );

            if($this->users->varifyusername($this->getAlphaNum('username'))){
                $this->view->assign('error' , 'Registration could not Complete.');
                $this->view->render('new_user', 'New User');
                exit;
            }
            print_r(array(
                $this->getSql('f_name'),
                $this->getSql('l_name'),
                $this->getWordParam('email'),
                $this->getSql('password'),
                $this->getAlphaNum('username'),
                $this->getWordParam('dob'),
                $this->getText('gender'),
                $this->getInt('role'),
                $this->getText('profession'),
            ));

            $this->view->assign('success' , 'New user <b>'. $this->getSql('f_name') . '</b> added successfully.');
            $this->redirect(
                'acl/users/upload_profile_photo/alan_'.
                $this->getAlphaNum('username')
            );

        }

        $this->view->assign('roles' , $this->users->getRoles());
        $this->view->render('new_user', 'New User');
    }

    public function edit($id)
    {
        //$this->acl->access('edit_user');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/users');
        }

        if (!$this->users->getUser($this->filterInt($id))) {
            $this->redirect('acl/users');
        }

        $this->view->assign('title', 'Edit User');
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);
            $this->view->assign('Edata', $this->users->getEUser($this->filterInt($id)));
            $this->view->assign('roles' , $this->users->getRoles());

            if(!empty($this->validEmail($this->getWordParam('email'))) && !$this->validEmail($this->getWordParam('email'))){
                $this->view->assign('error' , 'Entered email address is invalid. Please enter valid email address.');
                $this->view->render('edit', 'Edit User');
                exit;
            }

            if($this->users->varifyEmail($this->getWordParam('email'))){
                $this->view->assign('error' , '<b>'. $this->getWordParam('email') .'</b> has been already registered');
                $this->view->render('edit', 'Edit User');
                exit;
            }

            if($this->getAlphaNum('username')){
            if($this->users->varifyusername($this->getAlphaNum('username'))){
                $this->view->assign('error' , 'The username <b>'. $this->getAlphaNum('username') .'</b> has already exist. Please enter new one.');
                $this->view->render('edit', 'Edit User');
                exit;
            }}

            if(!empty($this->getWordParam('password'))) {

                if ($this->getWordParam('password') != $this->getWordParam('c_password')) {
                    $this->view->assign('error', 'Your entered password does not match. Please enter your same password.');
                    $this->view->render('edit', 'Edit User');
                    exit;
                }
            }

            $this->users->editUser(
                $this->filterInt($id),
                $this->getSql('f_name'),
                $this->getSql('l_name'),
                $this->getWordParam('email'),
                $this->getSql('password'),
                $this->getAlphaNum('username'),
                $this->getWordParam('dob'),
                $this->getText('gender'),
                $this->getInt('role'),
                $this->getText('profession'),
                $this->getText('activity'),
                $this->getWordParam('r_date')
            );

            if($this->users->varifyusername($this->getAlphaNum('username'))){
                $this->view->assign('error' , 'User <b>'. $this->getSql('f_name') . '</b>\'s information update could not Complete.');
                $this->view->render('edit', 'Edit User');
                exit;
            }

            $this->redirect('acl/users');
        }

        $this->view->assign('Edata', $this->users->getEUser($this->filterInt($id)));
        $this->view->assign('roles' , $this->users->getRoles());
        $this->view->render('edit', 'Edit User');
    }

    public function delete($id)
    {
        //$this->acl->access('delete_role');

        if (!$this->filterInt($id)) {
            $this->redirect('acl/users');
        }

        if (!$this->users->getUser($this->filterInt($id))) {
            $this->redirect('acl/users');
        }

        $this->users->deleteUser($this->filterInt($id));
        $this->redirect('acl/users');
    }

    public function upload_profile_photo($username)
    {
        if (!$username) {
            $this->redirect('acl/users');
        }

        if (!$this->users->getUsername($username)) {
            $this->redirect('acl/users');
        }

        $id = $this->users->getUserId($username);

        $this->view->assign('title', 'Upload profile Photo');
        $this->view->setJsPlugin(array('jquery.validate'));
        $this->view->setJs(array('main'));

        if ($this->getInt('add') == 1) {
            $this->view->assign('data', $_POST);

            $image = '';

            if (isset($_FILES['pro_pic']['name'])) {
                $media = ROOT . 'public' . DS . 'media' . DS . 'profile_photos' . DS;
                $upload = new upload($_FILES['pro_pic']);
                $upload->allowed = array('image/*');
                $upload->file_new_name_body = 'pro_pic_' . uniqid();
                $upload->process($media);

                if ($upload->processed) {
                    $image = $upload->file_dst_name;;
                }
                else {
                    $this->view->assign('error', $upload->error);
                    $this->view->render('upload_profile_photo', 'Upload profile photo');
                    exit;
                }
            }

            $this->users->setProPic(implode(',',$id), $image);
            $this->view->assign('success', 'Profile picture Uploaded successfully.');
            
            $this->redirect("acl/users");
        }

        $this->view->render('upload_profile_photo', 'Upload profile photo');
    }

    public function permissions_users()
    {
        $this->view->setJs(array('main'));
        $this->view->assign('title', 'User');
        $this->view->assign('users', $this->users->getUsers());
        $this->view->render('index');
    }

    public function permissions($userId)
    {
        $id = $this->filterInt($userId);

        if(!$id) {
            $this->redirect('user');
        }

        if($this->getInt('val') == 1){
            $values = array_keys($_POST);
            $replace = array();
            $delete = array();

            for($i = 0; $i < count($values); $i++){
                if(substr($values[$i], 0, 5) == 'perm_'){
                    if($_POST[$values[$i]] == 'x'){
                        $delete[] = array(
                            'user'      =>  $id,
                            'permision' =>  substr($values[$i], -1)
                        );
                    }
                    else{
                        if($_POST[$values[$i]] == 1){
                            $v = 1;
                        }
                        else{
                            $v = 0;
                        }

                        $replace[] = array(
                            'user'      =>  $id,
                            'permision' =>  substr($values[$i], -1),
                            'value'     =>  $v
                        );
                    }

                }
            }

            for($i = 0; $i < count($delete); $i++){
                $this->users->deletePermision(
                    $delete[$i]['user'],
                    $delete[$i]['permision']);
            }

            for($i = 0; $i < count($replace); $i++){
                $this->users->editPermision(
                    $replace[$i]['user'],
                    $replace[$i]['permision'],
                    $replace[$i]['value']);
            }

        }

        $permisionsUser = $this->users->getPermisionUser($id);
        $permisionsRole = $this->users->getPermisionsRole($id);

        if(!$permisionsUser || !$permisionsRole){
            $this->redirect('user');
        }

        $this->view->assign('title', 'User\'s Permissions');
        $this->view->assign('permisions', array_keys($permisionsUser));
        $this->view->assign('user', $permisionsUser);
        $this->view->assign('role', $permisionsRole);
        $this->view->assign('info', $this->users->getUser($id));

        $this->view->render('permissions');
    }
}