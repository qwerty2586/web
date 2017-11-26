<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 11/25/17
 * Time: 2:01 PM
 */

namespace Web;


class Database
{
    private $DB_URL = "sqlite:db/db.sqlite";
    private $db;


    public function __construct()
    {
        $this->db = new \PDO($this->DB_URL);
    }
}