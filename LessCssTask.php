<?php

require_once "phing/Task.php";
require_once('phing/tasks/my/less.inc.php');

class LessCssTask extends Task {

    /**
     * The message passed in the buildfile.
     */
    private $message = null;
    private $input=null;
    private $output=null;

    /**
     * The setter for the attribute "message"
     */
    public function setMessage($str) {
        $this->message = $str;
    }
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
        $test='';
	    $files=glob($this->input.'/*.less');

		foreach($files as $file){
			$parts = pathinfo($file);
			$filename=$parts ['filename'];
			$ext=$parts ['extension'];
            //$less = new lessc($this->input.'/'.$filename.'.'.$ext);
            //$css.=$less->parse();
			lessc::ccompile($this->input.'/'.$filename.'.'.$ext, $this->output.'/'.$filename.'.css');

		}
        //in case there are normal css files
        $css_files=glob($this->output.'/*.css');

        //CSS is ok, now minimize
        $com='yuicompressor -o '.$this->output.'/style.css '.implode(' ',$css_files);

        system($com);
        
      //print($com."\r\n");
    }
}

