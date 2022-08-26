<?php

include('function.inc.php');
include('smtp/PHPMailerAutoload.php');


$email = "19bmiit036@gmail.com";
$subject  = "Otp veryfication";
$html ="<h1>".rand(111111,999999)."</h1>";
echo send_email($email, $html, $subject);

?>