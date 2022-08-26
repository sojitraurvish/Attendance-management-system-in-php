<?php
    require 'database/user.php';
    $user=new User();
    $con=$user->connection();

    session_start();
    $conformPasswordError=$newPasswordError="";
    if(isset($_SESSION["myUsername"]))
        {
            if(isset($_POST["myChangePassword"]))
            {
                $rows=$user->checkUserExistance($_SESSION["myUsername"]);
                if($rows->num_rows>0)
                {
                    foreach($rows as $row)
                    {
                        if($row["Username"]==$_SESSION["myUsername"])
                        {
                            if($_POST["myNewPassword"]==$_POST["myConformPassword"])
                            {
                                echo $row["Password"]."<br>".password_hash($_POST["myNewPassword"],PASSWORD_DEFAULT);
                                if(!$row["Password"]==password_verify($_POST["myNewPassword"],PASSWORD_DEFAULT))
                                {
                                    $hash=password_hash($_POST["myNewPassword"],PASSWORD_DEFAULT);
                                    $q="update tbl_user set Password='$hash' where Username='".$row["Username"]."'";

                                    if($con->query($q)==true)
                                    {
                                        echo "password updated successfully";
                                        unset($_SESSION["OTP"]);
                                        unset($_SESSION["myUsername"]);
                                        unset($_SESSION["emailForOTP"]);
                                        header("location:index.php");
                                    }
                                    else
                                    {
                                        echo "<br> Error:".$con->error;
                                    }
                                }
                                else
                                {
                                    $newPasswordError="* Password Can't Same As Old Password";
                                }

                                
                            }
                            else
                            {
                                $conformPasswordError="* Password Not Match";
                            }
                        }
                    }
                }
                else
                {
                    header("location:index.php");
                }
            }
        }
        else
        {
            header("location:index.php");
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
    <style>
        ::placeholder{
            color:red;
        }
    </style>
</head>
<body>
    
    <div class="center">
        <h1>New Password</h1>
        <form action="" method="post">
            <div class="txt_field">
                <span></span>
                <label for="">New Password: </label>    
                <input type="password" name="myNewPassword" placeholder="<?php echo $newPasswordError?>" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[ !#$%&'()*+,-./:;<=>?@[\]^_`{|}~]).{8,16}" title="Must contain at least one number and one uppercase one lowercase letter and spicial symbole, and at least 8 or more characters" required>   
            </div>
            <div class="txt_field">
                <span></span>
                <label for="">Conform Password: </label>    
                <input type="password" name="myConformPassword" placeholder="<?php echo $conformPasswordError?>" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[ !#$%&'()*+,-./:;<=>?@[\]^_`{|}~]).{8,16}" title="Must contain at least one number and one uppercase one lowercase letter and spicial symbole, and at least 8 or more characters" required>   
            </div>

            <div>
                
                <input type="submit" name="myChangePassword" value="Change Password">
            </div>
            
        </form>
    </div>