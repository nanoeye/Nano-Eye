<?php

class errorController extends Controller 
{

    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index() 
    {
        $this->view->setJs(array('main'));
        $this->view->assign('title' , 'Error');
        $this->view->assign('message' , $this->_getError());
        $this->view->render('index');
    }
    
      public function access($code)
    {
        $$this->view->assign('title' , 'Access Error');
        $this->view->assign('message' , $this->_getError($code));
        $this->view->render('access');
    }

    private function _getError($code = FALSE)
    {
        if($code)
        {
            $code = $this->filterInt($code);
            if(is_int($code))
                $code = $code;
        }
        else
        {
        $code = 'default';
        }
        
        $error['default'] = 'There are may be an occur. As soon as we solve it. Thank you for with us.';
        $error['400'] = 'BAD REQUEST.';
        $error['401'] = 'UNAUTHORIZED ACCESS.';
        $error['403'] = 'ACCESS FORBIDDEN.';
        $error['404'] = 'NOT FOUND.';
        $error['405'] = 'Method Not Allowed.';
        $error['406'] = 'Not Acceptable.';
        $error['407'] = 'Proxy Authentication Required.';
        $error['408'] = 'Request Timeout.';
        $error['409'] = 'Conflict.';
        $error['410'] = 'Gone.';
        $error['411'] = 'Length Required.';
        $error['412'] = 'Precondition Failed.';
        $error['413'] = 'Request Entity Too Large.';
        $error['414'] = 'Request-URI Too Long.';
        $error['415'] = 'Unsupported Media Type.';
        $error['416'] = 'Requested Range Not Satisfiable.';
        $error['417'] = 'Expectation Failed.';
        $error['500'] = 'INTERNAL SERVER ERROR';
        $error['501'] = 'Not Implemented.';
        $error['502'] = 'Bad Gateway.';
        $error['503'] = 'Service Unavailable.';
        $error['504'] = 'Gateway Timeout.';
        $error['505'] = 'HTTP Version Not Supported.';
        $error['8080'] = 'Session Time out.';
        
        if(array_key_exists($code, $error))
        {
            return $error[$code];
        }
        else
        {
            return $error['default'];
        }
    }
}