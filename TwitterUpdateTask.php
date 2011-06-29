<?php

require_once ("phing/Task.php");
require_once ("phing/tasks/my/twitteroauth/twitteroauth.php");


/* get the lines below from http://twittertokens.6px.eu/ */

define('CONSUMER_KEY', 'V1UsnZJrMXMUKJFoqsQ');
define('CONSUMER_SECRET', 'UUazcBfXrWW1jcpiSU8XHPQy7CmHc1EMki8gzptQU');
define('OAUTH_TOKEN', '325453522-EuCuda0ruaPwKf9yjt5nhqr14i5egHJPeVRGVxQv');
define('OAUTH_TOKEN_SECRET', 'OkFH3Yd3RBM3ZfV3ecwdfEvGEiEi15XmUtOmDpaONM');

class TwitterUpdateTask extends Task {

    private $message;

    /*
     * The setter for the status message
     */
    public function setMessage($str){
        $this->message=$str;
    }


    public function main(){
        /* Connect to twitter */
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);
        /* Pass the status message as a parameter */
        $parameters = array('status' => $this->message);
        /* Post the data to the API endpoint */
        $status = $connection->post('statuses/update', $parameters);

        if (isset($status->error)){
            /* if there is an error, fail the build */
            throw new BuildException($status->error);
        }else{
            /* if there is no error, show a success message */
            $this->log ("Status posted to twitter");
        }
    }
}