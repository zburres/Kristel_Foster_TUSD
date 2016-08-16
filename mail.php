<?php

     if(isset($_POST['Submit'])) {

        //check for header injections (security?)
        function has_hi($str){
            return preg_match("/[\r\n]/", $str );
        }

        $name  = trim($_POST['name']);
        $email = trim($_POST['email']);
        $msg   = $_POST['message'];
        $doors = $_POST['doors'];
        $calls = $_POST['calls'];
        $sign = $_POST['sign'];

        //Checking for hi for security reasons
        if (has_hi($name) || has_hi($email)){
            die(); //If hi detected, kill script
        }

        if (!$name || !$email || !$msg) {
            echo '<h4 class="error">All text fields required.</h4><a href="mail.php" class="button">Reset</a>';
            exit;
        }

        $to = "zburres@gmail.com";
        $subject = "$name sent you a message via your contact form"
        $message = "Name: $name\r\n";
        $message .= "Email: $email\r\n";
        $message .= "Message: \r\n $msg";


        //checkboxes:

        if (isset($_POST['doors']) ){
            $message .= "\r\n I AM willing to knock on doors to re-elect Kristel. \r\n";
        }
        if (isset($_POST['calls']) ){
            $message .= "\r\n I AM willing to make calls to re-elect Kristel. \r\n";
        }
        if (isset($_POST['sign']) ){
            $message .= "\r\n I AM willing to display a yard sign to re-elect Kristel. \r\n";
        }

        $message = wordwrap($message, 72);

        //mail headers

        $headers = "MIME-version: 1.0\r\n";
        $headers .= "content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "From: $name <$email> \r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= "X-MSMail-Priority: High\r\n\r\n";

        //send the email

        mail($to, $subject, $message, $headers)

        echo '<h2>Your message has been sent. Thank you!</h2>'

     }

?>