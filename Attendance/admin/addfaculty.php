<?php
if (!session_start()) {
    session_start();
}
include __DIR__ . '/../database/user.php';
$user = new User();
$con = $user->connection();

$rows = $user->checkUserExistanceForAllPage($_SESSION["username"], $_SESSION["password"], $_SESSION["usertype"]);

if ($rows->num_rows > 0) {
    include 'header.php';
} else {
    echo "result 0";
    header("location:/Attendance/index.php");
}

if (isset($_POST["mySubmit"])) {
    $q = "insert into tbl_user(Username,Password,UserType,UserStatus,UserCreatedAt) values('" . $_POST["myEmail"] . "','" . password_hash($_POST["myPassword"], PASSWORD_DEFAULT) . "','" . $_POST["myType"] . "','1','" . $_POST["myCreateDate"] . "')";

    if ($con->query($q) == true) {
        echo "data inserted successfully";
        $destinationPath = "";
        if (isset($_FILES["flp"])) {
            $sourcePath = $_FILES["flp"]["tmp_name"];
            $destinationPath = "uplode/".$_FILES["flp"]["name"];

            // echo $_FILES["flp"]["name"]."<br>";
            // echo $_FILES["flp"]["type"]."<br>";
            // echo $_FILES["flp"]["size"]."<br>";
            // echo $_FILES["flp"]["tmp_name"]."<br>";
            // echo $_FILES["flp"]["error"]."<br>";

            move_uploaded_file($sourcePath, $destinationPath);
        } else {
            echo "file is not selected";
        }

        $q = "SELECT * FROM `tbl_user` WHERE  `Username`='" . $_POST["myEmail"] . "';";
        $rows = $con->query($q);

        if ($rows->num_rows > 0) {
            foreach ($rows as $row) {
                // echo "'".$_POST["myFname"]."',
                // '".$_POST["myMname"]."',
                // '".$_POST["myLname"]."',
                // '".$destinationPath."',
                // '".$_POST["myGender"]."',
                // '".$_POST["myDOB"]."',
                // '".$_POST["myLocalAdd"]."',
                // '".$_POST["myPerAdd"]."',
                // '".$_POST["myCast"]."',
                // '".$_POST["mySubCaste"]."',
                // '".$_POST["myBlood"]."',
                // '".$_POST["myEmail"]."',
                // '".$_POST["myContact"]."',
                // '".$_POST["myCity"]."',
                // '".$_POST["myState"]."',
                // '".$_POST["myMaritalStatus"]."',
                // '".$_POST["mySpouse"]."',
                // '".$_POST["myDisability"]."',
                // '".$_POST["myAadharCardNo"]."',
                // '".$_POST["myQualification"]."',
                // '".$_POST["myAcademicYear"]."',
                // '".$_POST["myCourse"]."',
                // '".$row["UserID"]."'";
                $q = "insert into tbl_faculty(FacultyFname,FacultyMname,FacultyLname, FacultyPhoto, FacultyGender, FacultyDOB,FacultylLocalAddress, FacultyPermenantAddress, FacultyCast, FacultySubCast, FacultyBloodGroup, FacultyEmail, FacultyContactNo, FacultyStateCityID, FacultyMaritalStatus, FacultySpouse, FacultyDisablity, FacultyAadharcardNo, FacultyHighestQulification, AcademicYearID, FacultyCourseID, UserID) 
                    values('" . $_POST["myFname"] . "','" . $_POST["myMname"] . "','" . $_POST["myLname"] . "','" . $destinationPath . "','" . $_POST["myGender"] . "','" . $_POST["myDOB"] . "','" . $_POST["myLocalAdd"] . "','" . $_POST["myPerAdd"] . "','" . $_POST["myCast"] . "','" . $_POST["mySubCaste"] . "','" . $_POST["myBlood"] . "','" . $_POST["myEmail"] . "','" . $_POST["myContact"] . "','" . $_POST["myCity"] . "','" . $_POST["myMaritalStatus"] . "','" . $_POST["mySpouse"] . "','" . $_POST["myDisability"] . "','" . $_POST["myAadharCardNo"] . "','" . $_POST["myQualification"] . "','" . $_POST["myAcademicYear"] . "','" . $_POST["myCourse"] . "','" . $row["UserID"] . "')";

                if ($con->query($q) == true) {
                    echo "data insertd successfully";
?>
                    <script>
                        // header("location:acadeemicyear.php");
                        location.replace("faculty.php");
                    </script>
<?php
                } else {
                    // echo "data not inserted" . $con->error;
                    ?>
                        <script>
                            window.alert("<?php echo "Error:".$con->error;?>");                       
                        </script>
                        
                    <?php
                }
            }
        } else {
            // echo "data not found" . $con->error;
            ?>
                <script>
                    window.alert("<?php echo "Error:".$con->error;?>");                       
                </script>
                
            <?php
        }
    } else {
        // echo "<br> Error:" . $con->error;
        ?>
                <script>
                    window.alert("<?php echo "Error:".$con->error;?>");                       
                </script>
                
        <?php
    }
}

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/Attendance/common/asset/dist/css/forms.css">
</head>

<body>
    <fieldset>
        <legend>Faculty</legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <table>

                <tr>
                    <td>
                        <label>User Type</label>
                        <input type="text" name="myType" readonly value="F" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>User Created At</label>
                        <input type="date" name="myCreateDate" value="<?php echo date("Y-m-d");?>" readonly />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>First Name:</label>
                        <input type="text" name="myFname" pattern="[A-Za-z]{2,30}" maxlength="30" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Middle Name</label>
                        <input type="text" name="myMname" pattern="[A-Za-z]{2,30}" maxlength="30" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Last Name</label>
                        <input type="text" name="myLname" pattern="[A-Za-z]{2,30}" maxlength="30" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Photo <p style="color:red; display:inline">*</p></label>
                        <input type="file" name="flp">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Gender</label>
                        <select name="myGender" style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Dob</label>
                        <input type="date" name="myDOB" max="<?php echo date("Y-m-d");?>" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Local Address <p style="color:red; display:inline">*</p></label>
                        <input type="text" name="myLocalAdd" pattern="[a-zA-Z0-9!#$%&'()*+,-./:;<=>?@[\]^_`{|}~].{2,255}" maxlength="255" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Permanant Address</label>
                        <input type="text" name="myPerAdd" pattern="[a-zA-Z0-9!#$%&'()*+,-./:;<=>?@[\]^_`{|}~].{2,255}" maxlength="255" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Caste</label>
                        <input type="text" name="myCast" pattern="[a-zA-Z]{2,15}" maxlength="15" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Sub Caste</label>
                        <input type="text" name="mySubCaste" pattern="[a-zA-Z]{2,20}" maxlength="20" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Blood group <p style="color:red; display:inline">*</p></label>
                        <input type="text" name="myBlood" pattern="[ABCDO]{1,2}[+-]{1}" maxlength="3" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                        <input type="text" name="myEmail" maxlength="320" pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})" title="should be: xyz@gmail.com" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label>
                        <input type="password" name="myPassword" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[ !#$%&'()*+,-./:;<=>?@[\]^_`{|}~]).{8,16}" title="Must contain at least one number and one uppercase one lowercase letter and spicial symbole, and at least 8 or more characters" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Contact no</label>
                        <input type="number" name="myContact" maxlength="10" pattern="[6-9]{1}-[0-9]{9} " required />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>State</label>
                        <select name="myState" id="mystate" onchange="myStateName()" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                        <option value="">Select Value</option>
                        <?php
                            $rows1 = $user->tbl_state();
                            
                            if ($rows1->num_rows > 0) {
                                foreach ($rows1 as $row1) {
                                    echo "<option value=\"" . $row1["StateID"] . "\">" . $row1["StateName"] . "</option>";
                                }
                            } else {
                                // header("location:course.php", false);
                                echo "no data found";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>City</label>
                        <select name="myCity" id="mycity" onchange="" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <option value="">Select Value</option>
                            
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Marital Status</label>
                        <select name="myMaritalStatus" id="mymaritalstatus" onchange="maritalStatus()" style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <option value="0">Unmarried</option>
                            <option value="1">Married</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Spouse Name <p style="color:red; display:inline">*</p></label>
                        <input type="text" name="mySpouse" id="myspouse" maxlength="70" pattern="[a-zA-Z]{2,70}" disabled required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Disability <p style="color:red; display:inline">*</p></label>
                        <input type="text" name="myDisability" maxlength="255" pattern="[a-zA-Z]{2,255}" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Aadhar Card Number</label>
                        <input type="text" name="myAadharCardNo" maxlength="12" pattern="[0-9]{12}" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Higest Qualification</label>
                        <input type="text" name="myQualification" maxlength="70" pattern="[A-Za-z0-9]{2,70}" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>AcademicYear</label>
                        <select name="myAcademicYear" style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <?php
                            $q = "select * from tbl_academicyear";

                            $rows = $con->query($q);

                            if ($rows->num_rows > 0) {
                                foreach ($rows as $row) {

                                    echo "<option value=";
                                    echo $row['AcademicYearID'];
                                    echo ">";
                                    echo $row["AcademicYear"];
                                    echo "</option>";
                                }
                            } else {
                                echo "Cource not found";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Course</label>
                        <select name="myCourse" style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <?php
                            $q = "select * from tbl_course";

                            $rows = $con->query($q);

                            if ($rows->num_rows > 0) {
                                foreach ($rows as $row) {

                                    echo "<option value=";
                                    echo $row['CourseID'];
                                    echo ">";
                                    echo $row["CourseName"];
                                    echo "</option>";
                                }
                            } else {
                                echo "Cource not found";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <br>
                        <input type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px;" />
                    </td>
                    <td>
                        <br>
                        <!-- <input type="submit" name="myCancel" formaction="academicyear.php" value="Cancel" class="button" style="background-color: #f44336;"/> -->
                        <a href="faculty.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                    </td>
                </tr>

            </table>
        </form>
    </fieldset>
    <script>
        function myStateName()
        {
            alert("fsfs");
            var v=new XMLHttpRequest();
            <?php
                // $abc = "<script>
                // var textBox=document.getElementById(\"myacademicyear\").value;
                // document.writeln(textBox);
                // </script>";  

                $q="SELECT
                tbl_city.CityID,
                tbl_city.CityName
            FROM
                tbl_city
            INNER JOIN tbl_state ON tbl_city.CityID = tbl_state.StateID where tbl_state.StateID=";
                
            ?>
            //alert(<?php //echo json_encode($q);?>);
            
            var l=<?php echo json_encode($q);?>;
            v.open("POST","data.php?v="+l+"'"+document.getElementById("mystate").value+"';",true);
            v.send();
            v.onreadystatechange=getData;

            function getData()
            {
                if(v.readyState==4)
                {
                    if(v.status==200)
                    {
                        document.getElementById("mycity").innerHTML=v.responseText;
                    }
                }
            }
            
        }
        //-------------------------------------------------------------------------------------------------------
        function maritalStatus() {
            var v = document.forms[0].mymaritalstatus.value;
            if(v==0)
            {
                document.forms[0].myspouse.disabled=true;
            }
            else if(v==1)
            {
                document.forms[0].myspouse.disabled=false;
            }
        }
    </script>
</body>

</html>