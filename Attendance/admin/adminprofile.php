<?php
if (!session_start()) {
    session_start();
}

include __DIR__ . '/../database/user.php';
$user = new User();
$con=$user->connection();
$rows = $user->checkUserExistanceForAllPage($_SESSION["username"], $_SESSION["password"], $_SESSION["usertype"]);

if ($rows->num_rows > 0) {
    include 'header.php';
} else {
    echo "result 0";
    header("location:/Attendance/index.php");
}
    

            
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input {
            padding: .5em;
            border: solid 1px #ccc;
            min-width: 100px;
            width: 200px;
        }

        fieldset {
            margin: 2em 0;
            padding: 2em 2em;
            border: solid 1px #ccc;
            border-radius: 6px;
            min-width: 500px;


        }

        legend {
            font-size: 1.25em;
            padding: 0.25;
            color: #999;
        }

        label {
            display: block;
            margin-top: 1em;
        }

        @media screen and (min-width: 430px) {
            legend {
                font-size: 1.75em;
            }

            fieldset {
                width: 30%;
                min-width: 800px;
                margin: auto;
            }

        }

        td {
            padding: 0px 40px;
        }

        input {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
        <?php
            $q="select * from tbl_admin where UserID='".$_SESSION["userid"]."'";
            $rows=$con->query($q);
                    if($rows->num_rows>0)
                    {
                        foreach($rows as $data)
                        {
                       
        ?>
    <fieldset style="align-items: right">
        <legend>Admin Profile</legend>
        <img width="20%" height="20%" src="<?php echo $data['AdminPhoto'];?>" alt="Italian Trulli">
        <table style="float: right;">
        
            <tr>
                <td>
                    <label> Name:</label>
                    <input type="text" name="fname" value="<?php echo $data['AdminFname'] ?> <?php echo $data['AdminMname'] ?> <?php echo $data['AdminLname'] ?>" disabled />
                </td>

                <td>
                    <label>Dob</label>
                    <input type="text" name="dob" value="<?php echo $data['AdminDOB'] ?>" disabled />
                </td>
            </tr>

            <?php
                if($data['AdminGender']=="M" || $data['AdminGender']=="m")
                {
                    $gender="Male";
                }
                elseif($data['AdminGender']=="F" || $data['AdminGender']=="m")
                {
                    $gender="Female";
                }
                elseif($data['AdminGender']=="O" || $data['AdminGender']=="o")
                {
                    $gender="Other";
                }
            ?>

            <tr>
                <td>
                    <label>Gender</label>
                    <input type="text" name="gender" value="<?php echo $gender ?>" disabled />
                </td>
                <td>
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $data['AdminEmail'] ?>" disabled />
                </td>
            </tr>


            <td>
                <label>Contact no</label>
                <input type="text" name="contact" value="<?php echo $data['AdminContactNo'] ?>" disabled />
            </td>

            <td>
                <label>Local Address</label>
                <input type="text" name="laddress" value="<?php echo $data['AdminlLocalAddress'] ?>" disabled />
            </td>
            <tr>
                <td>
                    <label>Permanant Address</label>
                    <input type="text" name="paddress" value="<?php echo $data['AdminPermenantAddress'] ?>" disabled />
                </td>
                <td>
                    <label>Aadhar Card Number</label>
                    <input type="text" name="acardno" value="<?php echo $data['AdminAadharcardNo'] ?>" disabled />
                </td>


            </tr>
            <tr>
                <td>
                    <label>Highest Qualification</label>
                    <input type="text" name="highqual" value="<?php echo $data['AdminHighestQulification'] ?>" disabled />
                </td>
                <td>
                    <label>Blood group</label>
                    <input type="text" name="blood" value="<?php echo $data['AdminBloodGroup'] ?>" disabled />
                </td>
            </tr>
        </table>
    </fieldset>
    <?php
         }
        }
        else
        {
            echo "data not display".$con->error;
        }
    ?>
</body>

</html>