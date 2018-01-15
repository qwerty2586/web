<?php

$ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once $ROOT.'/vendor/autoload.php';
require_once $ROOT.'/php/Database.class.php';
require_once $ROOT.'/php/Responder.class.php';
require_once $ROOT.'/php/Renderer.class.php';

$db = new DB\Database;
$r = new \Responder\Responder;
$rend = new \Renderer\Renderer($db);

// autoloader all composer


// load twig
$loader = new Twig_Loader_Filesystem($ROOT.'/templates');
$twig = new Twig_Environment($loader,[
//    'cache' => $ROOT.'/templates/cache'
]);