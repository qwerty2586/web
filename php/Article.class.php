<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 28.01.2018
 * Time: 19:40
 */

class Article {
    private $db;
    private $myid;

    /** @var \Context $ctx */
    public function __construct($ctx) {
        $this->db = $ctx->get_db();
        $this->myid = $ctx->get_login()->get_user_id();

    }



    function get_all_articles() {
        $data = $this->db->get_articles();
        $reviews = $this->get_all_reviews();
        for ($i = 0; $i < sizeof($data); $i++) {
            $data[$i]["username"] = $this->db->get_user_by_id($data[$i]["iduser"])["name"];
            $my_review = -1;
            $article_reviews = [];
            foreach ($reviews as $review) {
                if ($review["idarticle"] == $data[$i]["idarticle"]) {
                    if ($review["finished"] == 1) {
                        array_push($article_reviews,$review["idrating"] );
                    }
                    if ($review["iduser"] == $this->myid) {
                        if ($review["finished"] == 1) {
                            $my_review = $review["idrating"];
                        }
                    }
                }
            }
            $data[$i]["my_review"] = $my_review;
            $data[$i]["article_reviews"] = $article_reviews;
        }
        return $data;
    }

    function delete_article($idarticle) {
        $this->db->delete_article($idarticle);
    }

    public function get_all_reviews() {
        return $this->db->get_reviews();
    }
}