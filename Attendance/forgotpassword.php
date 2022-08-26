<?php
    require 'database/user.php';
    include 'mailer/function.inc.php';
    include 'mailer/smtp/PHPMailerAutoload.php';

    $usernameError="";
    if(isset($_POST["myEmailOTP"]))
    {
                $user=new User();
                $rows=$user->checkUserExistance($_POST["myUsername"]);

                if($rows->num_rows>0)
                {
                    foreach($rows as $row)
                    {
                        /*if($row["Username"]!=$_POST["myUsername"])
                        {
                            $usernameError="* Invalid username";
                        }*/
                        if($row["Username"]==$_POST["myUsername"])
                        {
                            $result=$user->userDetails($row["Usertype"],$row["UserID"]);
                            if($result)
                            {
                                foreach($result as $var)
                                {
                                    if($row["Usertype"]=="A" || $row["Usertype"]=="a" )
                                    {
                                        $email = $var["AdminEmail"];
                                        
                                    }
                                    elseif($row["Usertype"]=="F" || $row["Usertype"]=="f" )
                                    {
                                        $email = $var["FacultyEmail"];
                                    }
                                    elseif($row["Usertype"]=="S" || $row["Usertype"]=="s" )
                                    {
                                        $email = $var["StudentEmail"];
                                    }

                                        $subject  = "OTP Verification";
                                        $html =rand(111111,999999);
                                        if(send_email($email, $html, $subject))
                                        {
                                            session_start();
                                            $_SESSION["OTP"]=$html;
                                            $_SESSION["myUsername"]=$_POST["myUsername"];
                                            $_SESSION["emailForOTP"]=$var["AdminEmail"];
                                            // setcookie("username",$html, time() + 60);
                                            header("location:otpverification.php");
                                        }
                                        else
                                        {
                                            header("location:forgotpassword.php");
                                            $usernameError="* Mail Not Sent Try Again";
                                        }
                                    
                                    
                                }
                            }
                            else
                            {
                                $usernameError="* Invalid username";
                            }
                            
                            
                        }
                    }
                }
                else
                {
                    $usernameError="* Invalid username";
                }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- font family url -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/Attendance/common/asset/dist/css/login.css"><!--css link-->
</head>
<body>
    
    <div class="center">
        <h1>Forgot Password</h1>
        <form action="" method="post">
            
            <div class="txt_field">
                <span></span>
                <label for="">Enter Username: </label>    
                <input type="text" name="myUsername" maxlength="320" placeholder="<?php if(isset($usernameError)){echo $usernameError;}?>"  required>   
                <!-- pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})" title="should be: xyz@gmail.com" -->
            </div>

            <!-- <div class="txt_field">
                <span></span>
                <label for="">Enter Email For OTP: </label>    
                <input type="text" name="myEmail" maxlength="320" required>   
            </div> -->

            <div>
                <input type="submit" name="myEmailOTP" value="Send OTP">
            </div>
            <!-- attendancesissystem@gmail.com -->
        </form>
    </div>

    
</body>
</html>