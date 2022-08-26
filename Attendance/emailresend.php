<?php
    include 'mailer/function.inc.php';
    include 'mailer/smtp/PHPMailerAutoload.php';
    
    session_start();

    $email = $_SESSION["emailForOTP"];
    $subject  = "OTP Verification";
    $html =rand(111111,999999);
    send_email($email, $html, $subject);
    $_SESSION["OTP"]=$html;
    header("location:otpverification.php");
    //$_SESSION["emailForOTP"]=$_POST["myEmail"];
    //$_SESSION["myUsername"]=$_POST["myUsername"];
    // setcookie("username",$html, time() + 60);
?>