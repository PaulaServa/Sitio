<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

 
session_start();
 
if(isset($_POST['email'])){
 
    $email = $_POST['email'];
	$name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
 
 
    //Load composer's autoloader
   // require 'vendor/autoload.php';
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
 
    $mail = new PHPMailer(true);                            
    try {
		
    //////////////////////////////////////////////////// Server settings
	
        $mail->isSMTP();   
        $mail->CharSet = 'UTF-8';		
        $mail->Host = 'mail.yourdomain.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'info@yourdomain.com';     
        $mail->Password = 'yourpassword';             
        $mail->SMTPOptions = array(
            'tls' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'tls';                           
        $mail->Port = 587;                                   
 
        //Send Email
        $mail->setFrom('info@yourdomain.com');
        //Recipients
		$mail->addReplyTo('info@yourdomain.com');
		
	//////////////////////////////////////////////////// Server settings	
		
		// Mail address where you want to receive messages
        $mail->addAddress('hello@yourdomain.com'); 

    //////////////////////////////////////////////////// 		
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        // $mail->Body    = $message;
		$mail->Body    = "From : ".$name."<br /> E-mail : ".$email."<br /> Message : ".$message;
 
        $mail->send();
 
       $_SESSION['result'] = 'Message has been sent';
	   $_SESSION['status'] = 'ok';
	   return true; 
    } catch (Exception $e) {
	   $_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	   $_SESSION['status'] = 'error';
	   return false;
    }
 
	// header("location: index.php");
 
}
?>