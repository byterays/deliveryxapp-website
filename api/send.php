<?php
if(!$_POST){
    header("Location: ../");
    die();
}


$result=array();

if ($_POST) {
    if ($_POST["is_human"] == "") {
        
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);        
        $from_name =filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        if($phone!=""){

            $message .= "<br/>Please contact me at: $phone<br/>";
        }


        $reply_to = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $has_email=true;

        if($reply_to="")
        {
            $has_email=false;
            $reply_to = "query@deliveryxapp.com";
        }

        $subject = "You've got a message from $from_name";
        // declare variable        
        $headers = "Reply-To: $from_name <$reply_to>\r\n";
        // add more info
        $headers .= "Return-Path: $from_name <$reply_to>\r\n";
        $headers .= "From: $from_name <$reply_to>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

        $success = @mail("sales@deliveryxapp.com", $subject, $message, $headers);
        if($success){
            if($has_email){

                $headers1  = "Reply-To: DeliveryX <sales@deliveryxapp.com>\r\n";
                $headers1 .= "Return-Path: DeliveryX <sales@deliveryxapp.com>\r\n";
                $headers1 .= "From: DeliveryX <sales@deliveryxapp.com>\r\n";        
                $headers1 .= "MIME-Version: 1.0\r\n";
                $headers1 .= "Content-type: text/html; charset=utf-8\r\n";
                $headers1 .= "X-Priority: 3\r\n";
                $headers1 .= "X-Mailer: PHP" . phpversion() . "\r\n";
        
                @mail("$reply_to", 'Thank you for contacting DeliveryX', "Dear $from_name, </br> Thank you for contacting us. We shall reach out to your soon regarding your query. </br></br> Best Regards, <br/>DeliveryX Team", $headers1);
            }

           $result["success"]=true;
           $result["message"]="Your message has been sent successfully.";
        }else{
            $result["success"]=false;
            $result["message"]="Could not submit your message. Please try again later.";            
        }
    }
}

header("Content-Type: application/json");
echo json_encode($result);