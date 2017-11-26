<?php
require_once "./../db/Database.class.php";

$db = new \DB\Database();


$db->new_user("qwerty","qwerty","qwerty","qwerty");

$r = $db->get_user("qwerty","qwerty");
var_dump($r);
$r = $db->get_user("qwerty","qwertz");
var_dump($r);


// test unicness
$db->new_user("qwerty","qwerty","qwerty","qwerty");

$r = $db->get_user("qwerty","qwerty");
var_dump($r);
