<?php
        // load DB
        require_once 'db/Database.class.php';
        $db = new DB\Database;


        // load twig
        require_once 'libs/twig/lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem('templates');
        $twig = new Twig_Environment($loader);

$template_params["nadpis"] = "Seznam osob";
// vyplnim "nejaky" obsah
// - na ukázku je použit obsah s HTML, který může poskytnout např. WYSIWYG editor.
$template_params["obsah"] = "<p>První odstavec <b>textu</b>.</p> <p>Druhý <i>odstavec</i> textu.</p>";
// uzivatele
$template_params["uzivatele"] = array(
    array("jmeno"=>"František", "prijmeni"=>"Novotný"),
    array("jmeno"=>"Emil", "prijmeni"=>"Opatrný"),
    array("jmeno"=>"Běta", "prijmeni"=>"Malá")
);
// ovoce
$template_params["ovoce"] = array("jablko","hruška","třešeň","švestka");
        $header = $twig->loadTemplate("header.twig");
        echo $header->render($template_params);


