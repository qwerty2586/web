<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 11/25/17
 * Time: 2:01 PM
 */


namespace DB;


define("FILE","sqlite:db/db.sqlite");

// tabulky
define("UZIVATELE","uzivatele");
define("HODNOCENI","hodnoceni");
define("PRAVA","prava");
define("PRISPEVKY","prispevky");






class Database
{
    private $DB_URL = "sqlite:db/db.sqlite";
    private $db;
    private $temp_statement;

    public function __construct()
    {
        $this->db = new \PDO(FILE);

        $this->db->query("PRAGMA encoding=\"UTF-8\";");
    }

    private function prepare($query) {
        $this->temp_statement = $this->db->prepare($query);
        var_dump($this->temp_statement);
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

    public function get_user($log,$pas) {
        $this->prepare( "SELECT * FROM ".UZIVATELE." WHERE login=:login AND heslo=:heslo ;" );
        $this->bind(":login",$log);
        $this->bind(":heslo",$pas);
        $this->execute();
        return $this->fetchAll();
    }

    public function new_user($name, $log, $pas, $mail) {
        $this->prepare( "INSERT INTO ".UZIVATELE." (jmeno, login, heslo, email) VALUES (:name, :login,:pas,:mail);");
        $this->bind(":name",$name);
        $this->bind(":login",$log);
        $this->bind(":pas",$pas);
        $this->bind(":mail",$mail);
        $this->execute();
    }
}