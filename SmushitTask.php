<?php

require_once "phing/Task.php";
require_once('phing/tasks/my/smushit.inc.php');

class SmushitTask extends Task {


    private $input=null;

    public function setInput($str) {
        $this->input = $str;
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
        

	    $images=glob($this->input.'*.*');
        //print_r($images);
		foreach($images as $image){
            $smushit = new SmushIt();
            $parts = pathinfo($image);
			$filename=$parts ['filename'];
			$ext=$parts ['extension'];
            try{
                $local_result = $smushit->compress($image);
                $img_data=file_get_contents($local_result->dest);
                file_put_contents($image,$img_data);
                //print_r($local_result);
                print($image." compressed\r\n");
            }catch(Exception $e){
                print($e->getMessage()."\r\n");
            }

		}
    }
}
