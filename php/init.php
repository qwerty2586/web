<?php

$ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once $ROOT.'/db/Database.class.php';
$db = new DB\Database;


// load twig
require_once $ROOT.'/libs/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem($ROOT.'/templates');
$twig = new Twig_Environment($loader);