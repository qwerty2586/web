<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 28.01.2018
 * Time: 23:58
 */

class Rights {
    public const RIGHTS = [
        "author" => 1,
        "reviewer" => 2,
        "admin" => 3
    ];
    private $ctx;

    /** @var \Context $ctx */
    public function __construct($ctx) {
        $this->ctx = $ctx;
    }

    public function has_admin_rigths() {
        return ($this->get_user_rigths() >= Rights::RIGHTS["admin"]);
    }

    public function has_reviewer_rigths() {
        return ($this->get_user_rigths() >= Rights::RIGHTS["reviewer"]);
    }

    public function get_user_rigths() {
        return $this->ctx->get_db()->get_user_rights(
            $this->ctx->get_login()->get_user_id()
        );
    }



}