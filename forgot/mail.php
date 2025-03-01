<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  
  require 'PHPMailer-master/src/Exception.php';
  require 'PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/src/SMTP.php';
    
function send_mail($recipient,$subject,$message)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->IsSMTP();
    $mail->Host  = "mail.icst-itdept.com";
  
  $mail->setFrom('info@icst-itdept.com','ICST STUDENT INFORMATION SYSTEM');
  $mail->AddAddress($recipient);
  
  $mail->IsHTML(true);
  $mail->Subject = $subject;
  $content = $message;

  $mail->MsgHTML($content); 
  
  if(!$mail->Send()) {
    //echo "Error while sending Email.";
    //echo "<pre>";
    //var_dump($mail);
    return false;
  } else {
    //echo "Email sent successfully";
    return true;
    }

}

?>