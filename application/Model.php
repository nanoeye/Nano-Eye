<?php

class Model
{
    private $registry;
    protected $db;

    public function __construct()
    {
        $this->registry = Registry::getInstance();
        $this->db = $this->registry->db;
    }
    
    
    public function sendAct($author,$act,$message_type,$message,$page_title){   

        $ip = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $dir = $_SERVER['REQUEST_URI'];
        if(!isset($author)) { $author= null;}
        if(!isset($act)) { $act= null;}
        if(!isset($message_type)) { $message_type= null;}
        if(!isset($message)) { $message= null;}
        if(!isset($page_title)) { $page_title= null;}

        $this->db->prepare("INSERT INTO activities VALUES (null, :author, :ip, :browser, :act, :message_type, :message, :dir, :page_title, now())")
            ->execute(
                array(
                    ':author' => $author,
                    ':ip' => $ip,
                    ':browser' => $browser,
                    ':act' => $act,
                    ':message_type' => $message_type,
                    ':message' => $message,
                    ':dir' => $dir,
                    ':page_title' => $page_title
                ));
    }
    
/*        public function sendAct(){
        $v = new Visitor();
            
        $do = $this->db->prepare("INSERT INTO visitor_details VALUES (null, :vIP, :vCountry, :vOS, :vBrowser, :vLocation, :vPageURL, :vPageTitle, now())");
        $do->execute(array(
            ':vIP' => $v->Visitor(),
            ':vCountry' => $v->VisitorCountry(),
            ':vOS' => $v->VisitorOS(),
            ':vBrowser' => $v->VisitorBrowser(),
            ':vLocation' => $v->VisitorInfo("Visitor", "Address"),
            ':vPageURL' => $v->VisitedPage($_SERVER),
            ':vPageTitle' => $v->VisitedPageTitle($v->VisitedPage($_SERVER))
            ));
        }*/
}