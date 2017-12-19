<?php
require_once "./../db/Database.class.php";

$db = new \DB\Database();

function var_print($val) {
    echo "<pre>";
    echo json_encode($val, JSON_PRETTY_PRINT);
    echo "</pre>";
    echo "<br />";
}


$db->new_user("qwerty","qwerty","qwerty","qwerty");

$r = $db->get_user("qwerty","qwerty");
var_print($r);
$r = $db->get_user("qwerty","qwertz");
var_print($r);


// test unicness
$db->new_user("qwerty","qwerty","qwerty","qwerty");

$r = $db->get_user("qwerty","qwerty");
var_print($r);

$r = $db->get_user_rights($r);
var_print($r);

$r=$db->get_users();
var_print($r);



// test rights

$r=$db->get_user_rights($r[0]);
var_print($r);
