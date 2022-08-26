<?php
    if(!session_start())
    {
        session_start();
    }
    
        if(isset($_SESSION["username"]))
        {
            if($_SESSION["usertype"]=="A")
            {
                header("location:admin/dashboard.php");
            }
            elseif($_SESSION["usertype"]=="F")
            {
                header("location:faculty/dashboard.php");
            }
            elseif($_SESSION["usertype"]=="S")
            {
                header("location:student/dashboard.php");
            }
        }

        require 'database/user.php';
        
        $user=new User();

        $usernameError=$passwordError="";
        if(isset($_POST["myLogin"]))
        {

            if(empty($_POST["myUsername"]) || empty($_POST["myPassword"]))
            {
                if(empty($_POST["myUsername"]))
                {
                    $usernameError="* Username is required";
                }
                if(empty($_POST["myPassword"]))
                {
                    $passwordError="* Password is required";
                }
            }
            else
            {
                // $con->select_db("attendance");
                // $q="select * from login";
                
                $rows=$user->checkUserExistance($_POST["myUsername"]);

                if($rows->num_rows>0)
                {
                    foreach($rows as $row)
                    {
                        /*if($row["Username"]!=$_POST["myUsername"])
                        {
                            $usernameError="* Invalid username";
                        }*/
                        if(!password_verify($_POST["myPassword"],$row["Password"]))
                        {
                            $passwordError="* invalid password";
                        }
                        if(password_verify($_POST["myPassword"],$row["Password"]))
                        {
                            if($row["Username"]==$row["Password"])
                            {
                                header("location:forgotpassword.php");
                            }
                        }
                        if($row["Username"]==$_POST["myUsername"] && password_verify($_POST["myPassword"],$row["Password"]))
                        {
                            
                            $_SESSION["userid"]=$row["UserID"];
                            $_SESSION["username"]=$row["Username"];
                            $_SESSION["password"]=$row["Password"];
                            $_SESSION["usertype"]=$row["Usertype"];

                            if (isset($_POST['saveUsrPwd'])) 
                            {
                                if(!isset($_COOKIE["username"]))
                                {
                                    setcookie("username",$_SESSION["username"], time() + 30);
                                }
                            }

                                if($row["Usertype"]=="A")
                                {
                                    header("location:admin/dashboard.php");
                                }
                                elseif($row["Usertype"]=="F")
                                {
                                    header("location:faculty/dashboard.php");
                                }
                                elseif($row["Usertype"]=="S")
                                {
                                    header("location:student/dashboard.php");
                                }
                                else
                                {
                                    echo "invalid Role";
                                }
                            
                            
                            
                        }
                    }
                }
                else
                {
                    $usernameError="* Invalid username";
                    $passwordError="* invalid password";
                }
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
        <h1>Login</h1>
        <form action="" method="post">
            <div class="txt_field">
                <span></span>
                <label for="">Username: </label>    
                <input type="text" name="myUsername"  value="<?php if(isset($_COOKIE["username"])){ echo $_COOKIE["username"]; }?>" placeholder="<?php echo "$usernameError"; ?>" maxlength="320" >   
                <!-- pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})" title="should be: xyz@gmail.com" -->
            </div>
            <div class="txt_field">
                <span></span>
                <label for="">Password: </label>    
                <input type="password" name="myPassword"  placeholder="<?php echo "$passwordError"; ?>" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[ !#$%&'()*+,-./:;<=>?@[\]^_`{|}~]).{8,16}" title="Must contain at least one number and one uppercase one lowercase letter and spicial symbole, and at least 8 or more characters">   
            </div>

            <div class="forgotpassword">
                <a href="forgotpassword.php">Forgot Password?</a>
            </div>

            <div>
                <br>
                <input type="checkbox" name="saveUsrPwd">&nbsp;Remember Me
                <br>
            </div>

            <div>
                
                <input type="submit" name="myLogin" value="Login">
            </div>
            
        </form>
    </div>

    
</body>
</html>