<?php
    session_start();
    setcookie("OTP",$_SESSION["OTP"], time() + 60);

    // echo $_COOKIE["OTP"];
    $otpError="";
    if(isset($_POST["myOTPBtn"]))
    {
        if(isset($_COOKIE["OTP"]))
        {
            if($_COOKIE["OTP"]==$_POST["myOTP"])
            {
                echo "successfull";
                header("location:conformpassword.php");
            }
            else
            {
                $otpError="* Wrong OTP";
            }
        }
        else
        {
            $otpError="* Resend OTP";
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
    
    <style>
        #resend{
            display: none;
        }

        .center p{
        text-align:center;
        padding:0 0 20px 0;
        }

        ::placeholder {
        color: red;
        }
    </style>
</head>
<body>
    
    <div class="center">
        <h1>OTP Verification</h1>
            <p id="timer">

            </p>
        <form action="" method="post">
            <div class="txt_field">
                <span></span>
                <label for="">Enter OTP: </label>    
                <input type="number" name="myOTP" min="111111" max="999999" maxlength="6" step="1" placeholder="<?php echo "$otpError"; ?>" pattern="[0-9]{6}" title="should be 6 digit like :123456" required>   
            </div>
            

            <div id="resend">
                <a href="emailresend.php?">Resend?</a>
            </div>

            <div>
                
                <input type="submit" name="myOTPBtn" value="Verify OTP">
            </div>
            
        </form>
    </div>


<script>
var time=60;
// var coundown=document.getElementById("timer");
// document.getElementById("timer").placeholder=;

setInterval(update,1000);

function update()
{

    var sec=time%60;
    document.getElementById("timer").innerHTML=`Check Mail For OTP In:${time} second` ;
    if(time!=0)
    {
    	time--;
	}
    else if(time==0)
    {
        document.getElementById("timer").innerHTML=`OTP Expired`;
        document.getElementById("resend").style.display='inline-block';
    }
    
}

</script>
</body>
</html>