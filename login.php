<?php

$PAGE = 'login';
$TITLE = 'Login';

require_once $_SERVER['DOCUMENT_ROOT'].'/php/init.php';
global $ROOT, $db, $twig;

//// GET
if ($_SERVER['REQUEST_METHOD']=='GET') {
    require $ROOT.'/php/render_page.php';
    return;
}


//// POST


switch ($_POST["action"]) {
    case "login" :
        $login = $_POST["login"];
        $pass = $_POST["pass"];
        $pass = hash("sha256",$pass);
        $user = $db->get_user($login,$pass);
        if ($user) {
            echo "OK";
        } else {
            echo "DANGER|Combination of username and password dont match\n";
        }
        break;
    case "register" :
        $username = $_POST["username"];
        $login = $_POST["login"];
        $pass = $_POST["pass"];
        $mail = $_POST["mail"];
        $all_ok = true;

        // username
        if (strlen($username)<= 2) {
            echo "DANGER|Username must be longer than 2 characters\n";
            $all_ok =false;
        }
        if (strlen($username)>= 25) {
            echo "DANGER|Username must be shorter than 25 characters\n";
            $all_ok =false;
        }

        // login
        if (strlen($login)<= 2) {
            echo "DANGER|Login must be longer than 2 characters\n";
            $all_ok =false;
        } elseif (strlen($login)>= 25) {
            echo "DANGER|Login must be shorter than 25 characters\n";
            $all_ok =false;
        } elseif ($db->get_user_by_login($login)) {
            echo "DANGER|This login is already in use!\n";
            $all_ok =false;
        }

        // password
        if (strlen($pass)<= 6) {
            echo "DANGER|Password must be longer than 6 characters\n";
            $all_ok =false;
        } elseif (strlen($pass)>= 25) {
            echo "DANGER|Password must be shorter than 25 characters\n";
            $all_ok =false;
        }
        if (!preg_match("#[0-9]+#", $pass)) {
            echo "DANGER|Password must include at least one number!\n";
            $all_ok =false;
        }
        if (!preg_match("#[a-zA-Z]+#", $pass)) {
            echo "DANGER|Password must include at least one letter!\n";
            $all_ok =false;
        }

        //mail
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo "DANGER|EMail is invalid\n";
            $all_ok =false;
        }


        if ($all_ok) {
            $pass = hash("sha256",$pass);
            $db->new_user($username,$login,$pass,$mail);
            echo "OK";
        }
        break;
    default: echo "NOT YET IMPLEMENTED";

}