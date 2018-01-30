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
            $ctx->get_db()->delete_article($idarticle);
            $ctx->get_responder()->ok();
        } else {
            $ctx->get_responder()->error("You dont have rights to delete article");
        }
        break;
    case "upload" :
        $name = $_POST["name"];
        $filename = $_FILES['file']['name'];
        $location = $_SERVER['DOCUMENT_ROOT'] .'/uploads/'.$filename;
        move_uploaded_file($_FILES['file']['tmp_name'],$location);
        $ctx->get_db()->new_article($name,$ctx->get_login()->get_user_id(),0,$filename);
        $ctx->get_responder()->ok();
        break;

    case "reviewers" :
        $name1 = $_POST["user1"];
        $name2 = $_POST["user2"];
        $name3 = $_POST["user3"];
        $idarticle = $_POST["idarticle"];

        $id1 = $ctx->get_db()->get_user_by_name($name1)["iduser"];
        $id2 = $ctx->get_db()->get_user_by_name($name2)["iduser"];
        $id3 = $ctx->get_db()->get_user_by_name($name3)["iduser"];

        $ctx->get_db()->create_rating($idarticle,$id1);
        $ctx->get_db()->create_rating($idarticle,$id2);
        $ctx->get_db()->create_rating($idarticle,$id3);
        $ctx->get_db()->article_change_aprouval($idarticle,1);

        $ctx->get_responder()->ok();
        break;
    case "review" :
        $quality = $_POST["quality"];
        $length = $_POST["length"];
        $interesting = $_POST["interesting"];
        $idrating = $_POST["idrating"];
        $review = $_POST["review"];
        $ctx->get_db()->edit_review($idrating,$quality,$length,$interesting,$review,1);
        $ctx->get_responder()->ok();
        break;
}
