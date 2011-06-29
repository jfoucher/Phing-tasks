<?php

require_once "phing/Task.php";
require_once('phing/tasks/my/less.inc.php');

class GitTagsTask extends Task {

    /**
     * The message passed in the buildfile.
     */
    private $tags = null;


    /**
     * The setters
     */
    public function setTags($str) {
        $this->tags = $str;
    }


    /**
     * The init method: Do init steps.
     */
    public function init() {
      // nothing to do here
    }

    /**
     * The main entry point method.
     */
    public function main() {
        echo 'tags';
        print_r($this->tags);
    }
}

