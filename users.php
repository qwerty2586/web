<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/Context.class.php';
$ctx = new Context();

//// GET
if ($_SERVER['REQUEST_METHOD']=='GET') {
    echo $ctx->get_renderer()->render_page("users");
    return;
}


//// POST
switch ($_POST["action"]) {
    case "change_rights" :
        $iduser = $_POST["iduser"];
        $new_idright = $_POST["new_idright"];
        if ($ctx->get_rights()->has_admin_rigths()) {
            $ctx->get_db()->change_user_rights($iduser,$new_idright);
            $ctx->get_responder()->ok();
        } else {
            $ctx->get_responder()->error("You dont have rights change rights of others");
        }
        break;
}