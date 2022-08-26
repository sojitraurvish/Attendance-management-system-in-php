
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
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- <?php
        // $conn=mysqli_connect("localhost","root","","admintest");
        // if(!$conn)
        // {die();

        // }
        // else{
        //     echo"Connection success";
        // }
        // $admin_id=3;

        // $showdata="select * from tbl_faculty where FacultyID=2";
        //      $query=mysqli_query($conn,$showdata);

        //       $data = mysqli_fetch_array($query)

        ?> -->
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
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
            $q="select * from tbl_faculty where UserID='".$_SESSION["userid"]."'";
            $rows=$con->query($q);
                    if($rows->num_rows>0)
                    {
                        foreach($rows as $data)
                        {
                       
        ?>
    <fieldset>
        <legend>Faculty Profile</legend>
        <img width="20%" height="20%" src="uplode/faculty.png" alt="Italian Trulli">
        <table table style="float: right;">
            <tr>
                <td>
                    <label> Name:</label>
                    <input type="text" name="fname" value="<?php echo $data['FacultyFname'] ?> <?php echo $data['FacultyMname'] ?> <?php echo $data['FacultyLname'] ?>" disabled />
                </td>

                <td>
                    <label>Dob</label>
                    <input type="text" name="dob" value="<?php echo $data['FacultyDOB'] ?>" disabled />
                </td>
            </tr>
            <?php
            if ($data['FacultyGender']  == "M") {
                $gender = "Male";
            } else {
                $gender = "Female";
            }
            ?>


            <tr>
                <td>
                    <label>Gender</label>
                    <input type="text" name="gender" value="<?php echo $gender ?>" disabled />
                </td>
                <td>
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $data['FacultyEmail'] ?>" disabled />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Contact no</label>
                    <input type="text" name="contact" value="<?php echo $data['FacultyContactNo'] ?>" disabled />
                <td>


                    <label>Local Address</label>
                    <input type="textarea" name="laddress" value="<?php echo $data['FacultylLocalAddress'] ?>" disabled />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Permanant Address</label>
                    <input type="text" name="paddress" value="<?php echo $data['FacultyPermenantAddress'] ?>" disabled />
                </td>
                <td>
                    <label>Aadhar Card Number</label>
                    <input type="text" name="acardno" value="<?php echo $data['FacultyAadharcardNo'] ?>" disabled />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Course</label>
                    <input type="text" name="course" value="<?php echo $data['FacultyAadharcardNo'] ?>" disabled />
                </td>

                <td>
                    <label>Highest Qualification</label>
                    <input type="text" name="highqual" value="<?php echo $data['FacultyHighestQulification'] ?>" disabled />
                </td>

            </tr>
            <tr>
                <td>
                    <label>Blood group</label>
                    <input type="text" name="blood" value="<?php echo $data['FacultyBloodGroup'] ?>" disabled />
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