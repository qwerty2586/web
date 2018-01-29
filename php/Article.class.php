<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 28.01.2018
 * Time: 19:40
 */

class Article {
    private $db;

    /** @var \Context $ctx */
    public function __construct($ctx) {
        $this->db = $ctx->get_db();
    }

    function get_all_articles_json() {
        return json_encode($this->get_all_articles());
    }

    function get_all_articles() {
        $data = $this->db->get_articles();
        for ($i = 0; $i < sizeof($data); $i++) {
            $data[$i]["username"] = $this->db->get_user_by_id($data[$i]["iduser"])["name"];
        }
        return $data;
    }

    function delete_article($idarticle) {
        $this->db->delete_article($idarticle);
    }
}