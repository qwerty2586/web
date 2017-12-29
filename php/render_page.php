<?php

global $ROOT, $PAGE, $TITLE, $db, $twig;


$header = $twig->render("header.twig", ["title" => $TITLE]);
$navbar = $twig->render("navbar.twig", ["title" => $TITLE]);
$content = $PAGE;

$document = $twig->render("document.twig", [
    "header" => $header,
    "navbar" => $navbar,
    "content" => $content]);

echo $document;

