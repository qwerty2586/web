<?php

global $ROOT, $PAGE, $TITLE, $db, $twig;

$PAGES = [
    "news" => "News",
    "users" => "Users"
];


$header = $twig->render("header.twig", ["title" => $TITLE]);
$navbar = $twig->render("navbar.twig", [
    "title" => $TITLE,
    "current_page" => $PAGE,
    "pages" => $PAGES,
    "index" => "news"
]);
$content = $PAGE;

$document = $twig->render("document.twig", [
    "header" => $header,
    "navbar" => $navbar,
    "content" => $content
]);

echo $document;

?>