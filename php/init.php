<?php

$ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once $ROOT . '/php/Database.class.php';
$db = new DB\Database;

require_once $ROOT . '/php/Responder.class.php';
$r = new \Responder\Responder;


// autoloader all composer
require_once $ROOT.'/vendor/autoload.php';

// load twig
$loader = new Twig_Loader_Filesystem($ROOT.'/templates');
$twig = new Twig_Environment($loader,[
//    'cache' => $ROOT.'/templates/cache'
]);