<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/Context.class.php';
$ctx = new Context();

//// GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo $ctx->get_renderer()->render_page("articles");
    return;
}

//// POST
switch ($_POST["action"]) {
    case "delete" :
        $idarticle = $_POST["idarticle"];
        if ($ctx->get_rights()->has_admin_rigths()) {
            $
            $ctx->get_responder()->ok();
        }
}
        $ctx->get_responder()->ok();