<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 11/25/17
 * Time: 2:01 PM
 */


namespace DB;


define("FILE",$_SERVER['DOCUMENT_ROOT']."/db/db.sqlite");
define("FILE_DDL",$_SERVER['DOCUMENT_ROOT']."/db/ddl.sql");
define("FILE_DML",$_SERVER['DOCUMENT_ROOT']."/db/dml.sql");

// tabulky
define("USERS","users");
define("RIGHTS","rights");
define("RATINGS","ratings");
define("ARTICLES","articles");

// UZIVATELE
define("IDUSER","iduser");
define("NAME","name");
define("LOGIN","login");
define("PASSWORD","password");
define("EMAIL","email");

//PRAVA
define("IDRIGHT","idright");
define("LABEL","label");
define("WEIGHT","weight");



class Database
{
    private $db;
    private $temp_statement;

    public function __construct()
    {
        if (!file_exists(FILE)) {
            $this->create_db();
        }

        $this->db = new \PDO("sqlite:".FILE );
        $this->db->query("PRAGMA encoding=\"UTF-8\";");
    }

    private function create_db()
    {
        $this->db = new \PDO("sqlite:".FILE );
        $this->db->query("PRAGMA encoding=\"UTF-8\";");
        $this->import_script(FILE_DDL);
        $this->import_script(FILE_DML);
    }

    private function import_script($script)
    {
        $lines = file($script);
        $op_data = "";
        foreach ($lines as $line) {
            if (substr($line, 0, 2) == "--" || $line == "")
            {
                continue;
            }
            $op_data .= $line;
            if (substr(trim($line), -1, 1) == ";")
            {
                $this->prepare($op_data);
                $this->execute();
                $op_data = "";
            }
        }
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
        $this->prepare( "SELECT * FROM ".USERS." WHERE ".LOGIN."=:login AND ".PASSWORD."=:heslo ;" );
        $this->bind(":login",$log);
        $this->bind(":heslo",$pas);
        $this->execute();
        return $this->fetch();
    }

    public function new_user($name, $log, $pas, $mail) {
        $this->prepare( "INSERT INTO ".USERS." (".NAME.", ".LOGIN.", ".PASSWORD.", ".EMAIL.") VALUES (:name, :login,:pas,:mail);");
        $this->bind(":name",$name);
        $this->bind(":login",$log);
        $this->bind(":pas",$pas);
        $this->bind(":mail",$mail);
        $this->execute();
    }

    public function get_user_by_id($id) {
        $this->prepare( "SELECT * FROM ".USERS." WHERE ".IDUSER."=:iduzivatel ;" );
        $this->bind(":iduzivatel",$id);
        $this->execute();
        return $this->fetch();
    }

    public function get_user_by_login($login) {
        $this->prepare( "SELECT * FROM ".USERS." WHERE ".LOGIN."=:login ;" );
        $this->bind(":login",$login);
        $this->execute();
        return $this->fetch();
    }

    public function get_user_rights($user) {
        if (is_int($user)) $user = $this->get_user_by_id($user);

        $this->prepare( "SELECT * FROM ".RIGHTS." WHERE ".IDRIGHT."=:idprava ;" );
        $this->bind(":idprava",$user[IDRIGHT]);
        $this->execute();
        return $this->fetch();
    }

    public function get_users() {
        $this->prepare( "SELECT * FROM ".USERS.";" );
        $this->execute();
        return $this->fetchAll();
    }






}