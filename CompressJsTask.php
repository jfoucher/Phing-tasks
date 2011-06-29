<?php

require_once "phing/Task.php";

class CompressJsTask extends Task {

    private $input=null;
    private $output=null;

    public function setInput($str) {
        $this->input = $str;
    }
    public function setOutput($str) {
        $this->output = $str;
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
        $js_files=glob($this->input.'/*.js');

        $com='yuicompressor -o '.$this->output.'/script.js '.implode(' ',$js_files);

        system($com);
        
      //print($com."\r\n");
    }
}

