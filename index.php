<?php
        // load DB
        require_once 'db/Database.class.php';
        $db = new Web\Database;


        // načtení twigu
        require_once 'libs/twig/lib/Twig/Autoloader.php';
        Twig_Autoloader::register(); // registrace autoloaderu sablon

        // cesta k adresari se sablonami - od tohoto souboru
        $loader = new Twig_Loader_Filesystem('templates'); // urcim prostor sablon
        $twig = new Twig_Environment($loader); // nactu prostredi s "nacitacem" sablon (takhle je to bez cache)

        // ziskani dane sablony z nacteneho prostredi

        // $template = $twig->loadTemplate('ukazkova-sablona.tpl');
