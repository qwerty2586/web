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


echo "OK";