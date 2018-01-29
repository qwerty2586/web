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
    private $_NAME = "name";
    private $_DATE = "date";

    /**
     *  During construct take ssesion from context
     *  @var \Context $ctx
     */
    public function __construct($ctx){

        // inicializuju objekt sessny
        $this->ses = $ctx->get_session();
    }

    /**
     *  Otestuje, zda je uzivatel prihlasen
     *  @return boolean
     */
    public function is_user_loged(){
        return $this->ses->isSessionSet($this->_ID);
    }

    /**
     *  Nastavi do session jmeno uzivatele a datum prihlaseni.
     *  @param string $userName Jmeno uzivatele.
     */
    public function login($id){
        $this->ses->addSession($this->_ID,$id); // jmeno
        $this->ses->addSession($this->_DATE,date("d. m. Y, G:m:s"));
    }

    /**
     *  Logout
     */
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