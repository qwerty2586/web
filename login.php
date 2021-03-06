<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/Context.class.php';
$ctx = new Context();

//require_once $_SERVER['DOCUMENT_ROOT'].'/php/init.php';
//global $ROOT, $db, $twig, $r, $rend;

//// GET
if ($_SERVER['REQUEST_METHOD']=='GET') {
    echo $ctx->get_renderer()->render_page("login");
    //echo $rend->render_page("login");
    return;
}


//// POST
$db = $ctx->get_db();
$r = $ctx->get_responder();


switch ($_POST["action"]) {
    case "logout" :
        if ($ctx->get_login()->is_user_loged()) {
            $ctx->get_login()->logout();
            $r->ok();
        } else {
            $r->error("Already logged out!!!");
        }
        break;
    case "login" :
        $login = $_POST["login"];
        $pass = $_POST["pass"];
        $user = $db->get_user($login,$pass);
        if ($user) {
            $ctx->get_login()->login($user["iduser"]);
            $r->ok();
        } else {
            $r->error("Combination of username and password dont match");
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
            $r->error("Username must be longer than 2 characters");
            $all_ok =false;
        }
        if (strlen($username)>= 25) {
            $r->error("Username must be shorter than 25 characters");
            $all_ok =false;
        }

        // login
        if (strlen($login)<= 2) {
            $r->error("Login must be longer than 2 characters");
            $all_ok =false;
        } elseif (strlen($login)>= 25) {
            $r->error("Login must be shorter than 25 characters");
            $all_ok =false;
        } elseif ($db->get_user_by_login($login)) {
            $r->error("This login is already in use!");
            $all_ok =false;
        }

        // password
        if (strlen($pass)<= 6) {
            $r->error("Password must be longer than 6 characters");
            $all_ok =false;
        } elseif (strlen($pass)>= 25) {
            $r->error("Password must be shorter than 25 characters");
            $all_ok =false;
        }
        if (!preg_match("#[0-9]+#", $pass)) {
            $r->error("Password must include at least one number!");
            $all_ok =false;
        }
        if (!preg_match("#[a-zA-Z]+#", $pass)) {
            $r->error("Password must include at least one letter!");
            $all_ok =false;
        }

        //mail
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $r->error("EMail is invalid");
            $all_ok =false;
        }


        if ($all_ok) {
            $db->new_user($username,$login,$pass,$mail);
            $r->ok();
        }
        break;
    default: $r->not_implemented();

}