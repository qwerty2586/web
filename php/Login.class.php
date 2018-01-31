<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 28.01.2018
 * Time: 11:00
 */

class Login{

    private $ses;
    private $_ID = "id";
    private $_DATE = "date";

    /* @var \Context $ctx */
    public function __construct($ctx){


        $this->ses = $ctx->get_session();
    }


    public function is_user_loged(){
        return $this->ses->isSessionSet($this->_ID);
    }

    public function login($id){
        $this->ses->addSession($this->_ID,$id);
        $this->ses->addSession($this->_DATE,date("d. m. Y, G:m:s"));
    }


    public function logout(){
        $this->ses->removeSession($this->_ID);
        $this->ses->removeSession($this->_DATE);
    }

    public function getUserInfo(){
        $id = $this->ses->readSession($this->_ID);
        $date = $this->ses->readSession($this->_DATE);
        return "ID: $id<br>Date: $date<br>";
    }

    public function get_user_id() {
        return intval($this->ses->readSession($this->_ID));
    }
}