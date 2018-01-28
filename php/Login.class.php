<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 28.01.2018
 * Time: 11:00
 */

class Login{

    private $ses; // objekt MySession
    private $_ID = "id"; // nazev sessny pro jmeno
    private $_DATE = "date"; // nazev sessny pro datum

    /**
     *  Pri vytvoreni objektu zahaji session.
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
     *  Odhlasi uzivatele.
     */
    public function logout(){
        $this->ses->removeSession($this->_ID);
        $this->ses->removeSession($this->_DATE);
    }

    /**
     *  Vrati informace o uzivateli
     *  @return string Informace o uzivateli.
     */
    public function getUserInfo(){
        $name = $this->ses->readSession($this->_ID);
        $date = $this->ses->readSession($this->_DATE);
        return "ID: $name<br>Date: $date<br>";
    }



}