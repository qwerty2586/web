<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/Context.class.php';
$ctx = new Context();

//// GET
if ($_SERVER['REQUEST_METHOD']=='GET') {
    echo $ctx->get_renderer()->render_page("news");
    return;
}

//// POST