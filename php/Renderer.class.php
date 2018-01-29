<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 14.01.2018
 * Time: 23:15
 */

namespace Renderer;

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once ROOT . '/vendor/autoload.php';

class Renderer {
    private $loader;
    private $twig;
    private $db;

    private $ctx;

    private $PAGES = [
        "news" => "News",
        "users" => "Users",
        "articles" => "Articles",
        "login" => "Login"
    ];




    /** @var \Context $ctx */
    public function __construct($ctx) {

        $this->loader = new \Twig_Loader_Filesystem(ROOT . '/templates');
        $this->twig = new \Twig_Environment($this->loader, [
            //  uncomment line for enabling cache
            // 'cache' => $ROOT.'/templates/cache'
        ]);
        $this->db = $ctx->get_db();
        $this->ctx = $ctx;

    }

    public function render_page($page) {
        $header = $this->render_header($page);
        $navbar = $this->render_navbar($page);
        $content = $this->render_content($page);
        return $this->twig->render("document.twig", [
            "header" => $header,
            "navbar" => $navbar,
            "content" => $content
        ]);

    }

    private function render_header($page) {
        return $this->twig->render("header.twig", ["title" => $this->get_title($page)]);
    }

    private function get_title($page) {
        return $this->PAGES[$page];
    }

    private function render_content($page) {
        switch ($page) {
            case "login" :
                return $this->twig->render("pages/login.twig");
                break;
            case "articles" :
                $params = [
                    "articles_json" => $this->ctx->get_article()->get_all_articles_json(),
                    "articles" => $this->ctx->get_article()->get_all_articles(),
                    "users" => $this->get_users(),
                    "my_rigths" => $this->ctx->get_rights()->get_user_rigths(),
                    "rights" => $this->ctx->get_rights()::RIGHTS
                ];
                return $this->twig->render("pages/articles.twig", $params);
                break;
            default :
                return $page;
        }
    }

    private function render_navbar($page) {
        $params = [
            "title" => $this->get_title($page),
            "current_page" => $page,
            "pages" => $this->PAGES,
            "index" => "news",
            "login" => "login",
            "user" => ""
        ];

        if ($this->ctx->get_login()->is_user_loged()) {
            $params["login"] = "logout";
            $params["user"] = $this->get_user_login();
        }

        return $this->twig->render("navbar.twig", $params);
    }

    private function get_user_rights() {
        return $this->db->get_user_rights($this->ctx->get_login()->get_user_id())["idright"];
    }

    private function get_user_login() {
        return $this->db->get_user_by_id($this->ctx->get_login()->get_user_id())["login"];
    }

    private function get_user_id() {
        return $this->ctx->get_login()->get_user_id();
    }

    private function get_users() {
        return $this->db->get_users();
    }
}