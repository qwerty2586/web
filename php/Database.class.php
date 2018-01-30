<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 11/25/17
 * Time: 2:01 PM
 */


namespace DB;


define("FILE", $_SERVER['DOCUMENT_ROOT'] . "/db/db.sqlite");
define("FILE_DDL", $_SERVER['DOCUMENT_ROOT'] . "/db/ddl.sql");
define("FILE_DML", $_SERVER['DOCUMENT_ROOT'] . "/db/dml.sql");

// tabulky
define("USERS", "users");
define("RIGHTS", "rights");
define("RATINGS", "ratings");
define("ARTICLES", "articles");

// UZIVATELE
define("IDUSER", "iduser");
define("NAME", "name");
define("LOGIN", "login");
define("PASSWORD", "password");
define("EMAIL", "email");

//PRAVA
define("IDRIGHT", "idright");
define("LABEL", "label");
define("WEIGHT", "weight");

// CLANKY
define("IDARTICLE", "idarticle");
define("APROUVAL", "aprouval");
define("FILENAME", "filename");

// RECENZE
define("IDRATING","idrating");
define("QUALITY","quality");
define("LENGTH","length");
define("INTERESTING","interesting");
define("REVIEW","review");
define("FINISHED","finished");



class Database {
    private $db;
    private $temp_statement;

    public function __construct() {

        // if db is not created, function create new db and import tables and data
        if (!file_exists(FILE)) {
            $this->create_db();
        }

        $this->db = new \PDO("sqlite:" . FILE);
        $this->db->query("PRAGMA encoding=\"UTF-8\";");
    }

    private function create_db() {
        $this->db = new \PDO("sqlite:" . FILE);
        $this->db->query("PRAGMA encoding=\"UTF-8\";");
        $this->import_script(FILE_DDL);
        $this->import_script(FILE_DML);
    }

    private function import_script($script) {
        $lines = file($script);
        $op_data = "";
        foreach ($lines as $line) {
            if (substr($line, 0, 2) == "--" || $line == "") {
                continue;
            }
            $op_data .= $line;
            if (substr(trim($line), -1, 1) == ";") {
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

    private function bind($param, $value) {
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

    public function get_user($log, $pass) {
        $pass = hash("sha256", $pass);
        $this->prepare("SELECT * FROM " . USERS . " WHERE " . LOGIN . "=:login AND " . PASSWORD . "=:heslo ;");
        $this->bind(":login", $log);
        $this->bind(":heslo", $pass);
        $this->execute();
        return $this->fetch();
    }

    public function new_user($name, $log, $pass, $mail) {
        $pass = hash("sha256", $pass);
        $this->prepare("INSERT INTO " . USERS . " (" . NAME . ", " . LOGIN . ", " . PASSWORD . ", " . EMAIL . ", " . IDRIGHT . ") VALUES (:name, :login,:pass,:mail,1);");
        $this->bind(":name", $name);
        $this->bind(":login", $log);
        $this->bind(":pass", $pass);
        $this->bind(":mail", $mail);
        $this->execute();
    }

    public function get_user_by_id($id) {
        $this->prepare("SELECT * FROM " . USERS . " WHERE " . IDUSER . "=:iduzivatel ;");
        $this->bind(":iduzivatel", $id);
        $this->execute();
        return $this->fetch();
    }

    public function get_user_by_login($login) {
        $this->prepare("SELECT * FROM " . USERS . " WHERE " . LOGIN . "=:login ;");
        $this->bind(":login", $login);
        $this->execute();
        return $this->fetch();
    }

    public function get_user_by_name($name) {
        $this->prepare("SELECT * FROM " . USERS . " WHERE " . NAME . "=:name ;");
        $this->bind(":name", $name);
        $this->execute();
        return $this->fetch();
    }

    public function get_user_rights($user) {
        if (is_int($user)) $user = $this->get_user_by_id($user);

        $this->prepare("SELECT * FROM " . RIGHTS . " WHERE " . IDRIGHT . "=:idprava ;");
        $this->bind(":idprava", $user[IDRIGHT]);
        $this->execute();
        return $this->fetch();
    }

    public function get_users() {
        $this->prepare("SELECT * FROM " . USERS . ";");
        $this->execute();
        return $this->fetchAll();
    }

    public function get_articles() {
        $this->prepare("SELECT * FROM " . ARTICLES . ";");
        $this->execute();
        return $this->fetchAll();
    }

    public function delete_article($id) {
        $this->prepare("DELETE FROM " . ARTICLES . " WHERE ".IDARTICLE." =:idarticle ;");
        $this->bind(":idarticle",$id);
        $this->execute();
    }

    public function new_article($name, $iduser, $approuval, $filename) {
        $this->prepare("INSERT INTO " . ARTICLES . " (" . NAME . ", " . IDUSER . ", " . APROUVAL . ", " . FILENAME .
            ") VALUES (:name, :iduser,:approuval,:filename);");
        $this->bind(":name",$name);
        $this->bind(":iduser",$iduser);
        $this->bind(":approuval",$approuval);
        $this->bind(":filename",$filename);
        $this->execute();
    }

    public function create_rating($idarticle,$iduser) {
        $this->prepare("INSERT INTO " . RATINGS . " (" . IDUSER . ", " . IDARTICLE . ", " . QUALITY . ", " . LENGTH . ", " . INTERESTING . ", " . REVIEW .", " . FINISHED .
            ") VALUES (:iduser,:idarticle,-1,-1,-1,:review,0);");
        $this->bind(":iduser",$iduser);
        $this->bind(":idarticle",$idarticle);
        $this->bind(":review","");
        $this->execute();
    }
    public function article_change_aprouval($idarticle,$aprouval) {
        $this->prepare("UPDATE " . ARTICLES . " SET " . APROUVAL . " =:aprouval WHERE " . IDARTICLE . " =:idarticle ;");
        $this->bind(":aprouval",$aprouval);
        $this->bind(":idarticle",$idarticle);
        $this->execute();
    }

    public function get_reviews() {
        $this->prepare("SELECT * FROM " . RATINGS . ";");
        $this->execute();
        return $this->fetchAll();
    }

    public function edit_review($idrating,$quality,$length,$interesting,$review,$finished) {
        $this->prepare("UPDATE " . RATINGS . " SET "
            .QUALITY. " =:quality ,"
            .LENGTH. " =:length ,"
            .INTERESTING. " =:interesting ,"
            .REVIEW. " =:review ,"
            .FINISHED. " =:finished "
            ."WHERE " . IDRATING . " =:idrating ;");
        $this->bind(":idrating",$idrating);
        $this->bind(":quality",$quality);
        $this->bind(":length",$length);
        $this->bind(":interesting",$interesting);
        $this->bind(":review",$review);
        $this->bind(":finished",$finished);
        $this->execute();
        return $this->fetchAll();
    }




}