<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 11/25/17
 * Time: 2:01 PM
 */


namespace DB;


define("FILE","sqlite:".$_SERVER['DOCUMENT_ROOT']."/db/db.sqlite");

// tabulky
define("UZIVATELE","uzivatele");
define("HODNOCENI","hodnoceni");
define("PRAVA","prava");
define("PRISPEVKY","prispevky");


class Database
{
    private $db;
    private $temp_statement;

    public function __construct()
    {
        $this->db = new \PDO(FILE);

        $this->db->query("PRAGMA encoding=\"UTF-8\";");
    }

    private function prepare($query) {
        $this->temp_statement = $this->db->prepare($query);
        $this->temp_statement->setFetchMode(\PDO::FETCH_ASSOC);
    }

    private function bind($param,$value) {
        $this->temp_statement->bindValue($param, $value);
    }

    private function execute() {
        return $this->temp_statement->execute();
    }
    private function fetchAll() {
        return $this->temp_statement->fetchAll();
    }
    private function fetch() {
        return $this->temp_statement->fetch();
    }

    public function get_user($log,$pas) {
        $this->prepare( "SELECT * FROM ".UZIVATELE." WHERE login=:login AND heslo=:heslo ;" );
        $this->bind(":login",$log);
        $this->bind(":heslo",$pas);
        $this->execute();
        return $this->fetch();
    }

    public function new_user($name, $log, $pas, $mail) {
        $this->prepare( "INSERT INTO ".UZIVATELE." (jmeno, login, heslo, email) VALUES (:name, :login,:pas,:mail);");
        $this->bind(":name",$name);
        $this->bind(":login",$log);
        $this->bind(":pas",$pas);
        $this->bind(":mail",$mail);
        $this->execute();
    }

    public function get_user_by_id($id) {
        $this->prepare( "SELECT * FROM ".UZIVATELE." WHERE iduzivatel=:iduzivatel ;" );
        $this->bind(":iduzivatel",$id);
        $this->execute();
        return $this->fetch();
    }

    public function get_user_by_login($login) {
        $this->prepare( "SELECT * FROM ".UZIVATELE." WHERE login=:login ;" );
        $this->bind(":login",$login);
        $this->execute();
        return $this->fetch();
    }

    public function get_user_rights($user) {
        $this->prepare( "SELECT * FROM ".PRAVA." WHERE idprava=:idprava ;" );
        //var_dump($user);
        $this->bind(":idprava",$user["idprava"]);
        $this->execute();
        return $this->fetch();
    }

    public function get_users() {
        $this->prepare( "SELECT * FROM ".UZIVATELE.";" );
        $this->execute();
        return $this->fetchAll();
    }
}