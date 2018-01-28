<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 28.01.2018
 * Time: 11:02
 */

$ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once $ROOT.'/vendor/autoload.php';
require_once $ROOT.'/php/Database.class.php';
require_once $ROOT.'/php/Responder.class.php';
require_once $ROOT.'/php/Renderer.class.php';
require_once $ROOT.'/php/Login.class.php';
require_once $ROOT.'/php/Session.class.php';

class Context
{
    private $ses = null; // objekt MySession
    private $login = null;
    private $db = null;
    private $renderer = null;
    private $responder = null;

    public function get_login() {
        if ($this->login == null) {
            $this->login = new Login($this);
        }
        return $this->login;
    }

    public function get_session() {
        if ($this->ses == null) {
            $this->ses = new Session();
        }
        return $this->ses;
    }

    public function get_db()
    {
        if ($this->db == null) {
            $this->db = new DB\Database();
        }
        return $this->db;
    }

    public function get_renderer()
    {
        if ($this->renderer == null) {
            $this->renderer = new Renderer\Renderer($this);
        }
        return $this->renderer;
    }

    public function get_responder()
    {
        if ($this->responder == null) {
            $this->responder = new Responder\Responder();
        }
        return $this->responder;
    }




}