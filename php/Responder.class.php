<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 07.01.2018
 * Time: 2:03
 */

namespace Responder;


class Responder
{
    private $locked=false;

    public function ok() {
        echo "ok";
        $this->locked=true;
    }

    public function not_implemented() {
        echo "NOT_YET_IMPLEMENTED";
        $this->locked=true;
    }



    public function danger($message) {
        $this->error($message);
    }

    public function error($message) {
        $this->respond("DANGER",$message);
    }

    public function success($message) {
        $this->respond("SUCCESS",$message);
    }

    public function info($message) {
        $this->respond("INFO",$message);
    }

    private function respond($tag, $message)
    {
        if ($this->locked) return;
        echo $tag."|".$message."\n";
    }
}