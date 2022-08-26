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
    // $q = "insert into tbl_user(Username,UserType,UserStatus,UserCreatedAt) values('" . $_POST["myEmail"] . "','" . $_POST["myType"] . "','1','" . $_POST["myCreateDate"] . "')";
    $q = "update tbl_user set Username='" . $_POST["myEmail"] . "',UserType='" . $_POST["myType"] . "',UserStatus='1',UserCreatedAt='" . $_POST["myCreateDate"] . "' where UserID='" . $_REQUEST["v"] . "'";

    if ($con->query($q) == true) {
        echo "data inserted successfully";
        $destinationPath = "";



        if (isset($_FILES["flp"])) {
            $sourcePath = $_FILES["flp"]["tmp_name"];
            $destinationPath = "uplode/" . $_FILES["flp"]["name"];

            // echo $_FILES["flp"]["name"]."<br>";
            // echo $_FILES["flp"]["type"]."<br>";
            // echo $_FILES["flp"]["size"]."<br>";
            // echo $_FILES["flp"]["tmp_name"]."<br>";
            // echo $_FILES["flp"]["error"]."<br>";

            move_uploaded_file($sourcePath, $destinationPath);
        } else {
            $q = "SELECT
            tbl_user.*,
            tbl_faculty.*,
            tbl_state.*,
            tbl_city.*,
            tbl_academicyear.*,
            tbl_course.*
        FROM
            tbl_faculty
        INNER JOIN tbl_user ON tbl_faculty.UserID = tbl_user.UserID
        INNER JOIN tbl_city ON tbl_faculty.FacultyStateCityID = tbl_city.CityID
        INNER JOIN tbl_state ON tbl_city.CityID = tbl_state.StateID
        INNER join tbl_academicyear on tbl_academicyear.AcademicYearID=tbl_faculty.AcademicYearID
        INNER JOIN tbl_course on tbl_course.CourseID=tbl_faculty.FacultyCourseID
        WHERE
            tbl_user.UserDeletedAt IS NULL and tbl_user.UserID='" . $_REQUEST["v"] . "';";

            $rows1 = $user->query($q);

            if ($rows1->num_rows > 0) {
                foreach ($rows1 as $row1) {
                    $destinationPath = $row1["FacultyPhoto"];
                }
            } else {
                header("location:course.php", false);
                echo "no data found";
            }
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
                $q = "update tbl_faculty set
                    FacultyFname='" . $_POST["myFname"] . "',
                    FacultyMname='" . $_POST["myMname"] . "',
                    FacultyLname='" . $_POST["myLname"] . "',
                    FacultyPhoto='" . $destinationPath . "',
                    FacultyGender='" . $_POST["myGender"] . "',
                    FacultyDOB='" . $_POST["myDOB"] . "',
                    FacultylLocalAddress='" . $_POST["myLocalAdd"] . "',
                    FacultyPermenantAddress='" . $_POST["myPerAdd"] . "',
                    FacultyCast='" . $_POST["myCast"] . "',
                    FacultySubCast='" . $_POST["mySubCaste"] . "',
                    FacultyBloodGroup='" . $_POST["myBlood"] . "',
                    FacultyEmail='" . $_POST["myEmail"] . "',
                    FacultyContactNo='" . $_POST["myContact"] . "',
                    FacultyStateCityID='" . $_POST["myCity"] . "',
                    FacultyMaritalStatus='" . $_POST["myMaritalStatus"] . "',
                    FacultySpouse='" . $_POST["mySpouse"] . "',
                    FacultyDisablity='" . $_POST["myDisability"] . "',
                    FacultyAadharcardNo='" . $_POST["myAadharCardNo"] . "',
                    FacultyHighestQulification='" . $_POST["myQualification"] . "',
                    AcademicYearID='" . $_POST["myAcademicYear"] . "',
                    FacultyCourseID='" . $_POST["myCourse"] . "' 
                    where UserID='" . $row["UserID"] . "'";

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
                        window.alert("<?php echo "Error:" . $con->error; ?>");
                    </script>

            <?php
                }
            }
        } else {
            // echo "data not found" . $con->error;
            ?>
            <script>
                window.alert("<?php echo "Error:" . $con->error; ?>");
            </script>

        <?php
        }
    } else {
        // echo "<br> Error:" . $con->error;
        ?>
        <script>
            window.alert("<?php echo "Error:" . $con->error; ?>");
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
                <?php

                $q = "SELECT
                                tbl_user.*,
                                tbl_faculty.*,
                                tbl_state.*,
                                tbl_city.*,
                                tbl_academicyear.*,
                                tbl_course.*
                            FROM
                                tbl_faculty
                            INNER JOIN tbl_user ON tbl_faculty.UserID = tbl_user.UserID
                            INNER JOIN tbl_city ON tbl_faculty.FacultyStateCityID = tbl_city.CityID
                            INNER JOIN tbl_state ON tbl_city.CityID = tbl_state.StateID
                            INNER join tbl_academicyear on tbl_academicyear.AcademicYearID=tbl_faculty.AcademicYearID
                            INNER JOIN tbl_course on tbl_course.CourseID=tbl_faculty.FacultyCourseID
                            WHERE
                                tbl_user.UserDeletedAt IS NULL and tbl_user.UserID='" . $_REQUEST["v"] . "';";

                $rows = $user->query($q);

                if ($rows->num_rows > 0) {
                    foreach ($rows as $row) {
                ?>
                        <tr>
                            <td>
                                <label>User Type</label>
                                <?php echo "<input type=\"text\" name=\"myType\" readonly value=\"" . $row["Usertype"] . "\" />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Created At</label>
                                <?php echo "<input type=\"date\" name=\"myCreateDate\" value=\"" . $row["UserCreatedAt"] . "\" required />"; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>First Name:</label>
                                <?php echo "<input type=\"text\" name=\"myFname\"  value=\"" . $row["FacultyFname"] . "\" pattern=\"[A-Za-z]{2,30}\" maxlength=\"30\" required />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Middle Name</label>
                                <?php echo "<input type=\"text\" name=\"myMname\" value=\"" . $row["FacultyMname"] . "\" pattern=\"[A-Za-z]{2,30}\" maxlength=\"30\" required />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Last Name</label>
                                <?php echo "<input type=\"text\" name=\"myLname\" value=\"" . $row["FacultyLname"] . "\" pattern=\"[A-Za-z]{2,30}\" maxlength=\"30\" required />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Photo <p style="color:red; display:inline">*</p></label>
                                <?php echo "<img width=\"100%\" height=\"100%\" src=\"" . $row["FacultyPhoto"] . "\" alt=\"Italian Trulli\">"; ?>
                                <?php echo "<input type=\"file\" name=\"flp\" value=\"" . $row["FacultyPhoto"] . "\">"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Gender</label>
                                <select name="myGender" style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                    <?php
                                    if ($row["FacultyGender"] == "M") {
                                        echo "<option value=\"" . $row["FacultyGender"] . "\">Male</option>
                                    <option value=\"F\">Female</option>
                                    <option value=\"O\">Other</option>";
                                    } elseif ($row["FacultyGender"] == "F") {
                                        echo "<option value=\"" . $row["FacultyGender"] . "\">Female</option>
                                    <option value=\"M\">Male</option>
                                    <option value=\"O\">Other</option>";
                                    } elseif ($row["FacultyGender"] == "O") {
                                        echo "<option value=\"" . $row["FacultyGender"] . "\">Other</option>
                                    <option value=\"M\">Male</option>
                                    <option value=\"F\">Female</option>";
                                    }

                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Dob</label>
                                <?php echo "<input type=\"date\" name=\"myDOB\" value=\"" . $row["FacultyDOB"] . "\" required />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Local Address <p style="color:red; display:inline">*</p></label>
                                <?php echo "<input type=\"text\" name=\"myLocalAdd\" value=\"" . $row["FacultylLocalAddress"] . "\" pattern=\"[a-zA-Z0-9!#$%&'()*+,-./:;<=>?@[\]^_`{|}~].{2,255}\" maxlength=\"255\" />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Permanant Address</label>
                                <?php echo "<input type=\"text\" name=\"myPerAdd\" value=\"" . $row["FacultyPermenantAddress"] . "\" pattern=\"[a-zA-Z0-9!#$%&'()*+,-./:;<=>?@[\]^_`{|}~].{2,255}\" maxlength=\"255\" />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Caste</label>
                                <?php echo "<input type=\"text\" name=\"myCast\" pattern=\"[a-zA-Z]{2,15}\" value=\"" . $row["FacultyCast"] . "\" maxlength=\"15\" required />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Sub Caste</label>
                                <?php echo "<input type=\"text\" name=\"mySubCaste\" value=\"" . $row["FacultySubCast"] . "\" pattern=\"[a-zA-Z]{2,20}\" maxlength=\"20\" required />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Blood group <p style="color:red; display:inline">*</p></label>
                                <?php echo "<input type=\"text\" name=\"myBlood\" value=\"" . $row["FacultyBloodGroup"] . "\" pattern=\"[ABCDO]{1,2}[+-]{1}\" maxlength=\"3\" />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                                <?php echo "<input type=\"text\" name=\"myEmail\" maxlength=\"320\" value=\"" . $row["FacultyEmail"] . "\" pattern=\"[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})\" title=\"should be: xyz@gmail.com\" required />"; ?>
                            </td>
                        </tr>
                        <!-- <tr>
                    <td>
                        <label>Password</label>
                        <input type=\"password\" name=\"myPassword\" value=\"".$row["Password"]."\" maxlength=\"16\" pattern=\"(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[ !#$%&'()*+,-./:;<=>?@[\]^_`{|}~]).{8,16}\" title=\"Must contain at least one number and one uppercase one lowercase letter and spicial symbole, and at least 8 or more characters\" required />
                    </td>
                </tr> -->
                        <tr>
                            <td>
                                <label>Contact no</label>
                                <?php echo "<input type=\"number\" name=\"myContact\" value=\"" . $row["FacultyContactNo"] . "\" maxlength=\"10\" pattern=\"[6-9]{1}-[0-9]{9} \" required />"; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>State</label>
                                <select name="myState" id="mystate" onchange="myStateName()" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                    <?php

                                    $rows1 = $user->query("SELECT tbl_state.*,tbl_city.* from tbl_city INNER JOIN tbl_state on tbl_city.StateID=tbl_state.StateID where tbl_city.CityID='" . $row["FacultyStateCityID"] . "'");
                                    $stateID = "";
                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {
                                            echo "<option value=\"" . $row1["StateID"] . "\">" . $row1["StateName"] . "</option>";
                                            $stateID = $row1["StateID"];
                                        }
                                    } else {
                                        // header("location:course.php", false);
                                        echo "no data found";
                                    }

                                    $rows1 = $user->query("SELECT tbl_state.*,tbl_city.* from tbl_city INNER JOIN tbl_state on tbl_city.StateID=tbl_state.StateID where tbl_city.CityID!='" . $row["FacultyStateCityID"] . "' and tbl_state.StateID!='" . $stateID . "'");

                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {
                                            echo "<option value=\"" . $row1["StateID"] . "\">" . $row1["StateName"] . "</option>";
                                        }
                                    } else {
                                        // header("location:course.php", false);
                                        echo "no data found";
                                    }
                                    ?>
                                    <option value="">Select Value</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>City</label>
                                <select name="myCity" id="mycity" onchange="" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                    <?php
                                    $rows1 = $user->query("SELECT tbl_state.*,tbl_city.* from tbl_city INNER JOIN tbl_state on tbl_city.StateID=tbl_state.StateID where tbl_city.CityID='" . $row["FacultyStateCityID"] . "'");
                                    $stateID = "";
                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {
                                            echo "<option value=\"" . $row1["CityID"] . "\">" . $row1["CityName"] . "</option>";
                                            $stateID = $row1["StateID"];
                                        }
                                    } else {
                                        // header("location:course.php", false);
                                        echo "no data found";
                                    }

                                    $rows1 = $user->query("SELECT tbl_state.*,tbl_city.* from tbl_city INNER JOIN tbl_state on tbl_city.StateID=tbl_state.StateID where tbl_city.CityID!='" . $row["FacultyStateCityID"] . "' and tbl_state.StateID!='" . $stateID . "'");
                                    $stateID = "";
                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {
                                            echo "<option value=\"" . $row1["CityID"] . "\">" . $row1["CityName"] . "</option>";
                                            $stateID = $row1["StateID"];
                                        }
                                    } else {
                                        // header("location:course.php", false);
                                        echo "no data found";
                                    }
                                    ?>
                                    <!-- <option value="">Select Value</option> -->

                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Marital Status</label>
                                <select name="myMaritalStatus" id="mymaritalstatus" onchange="maritalStatus()" style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                    <?php
                                    if ($row["FacultyMaritalStatus"] == "0") {
                                        echo "<option value=\"0\">Unmarried</option>";
                                        echo "<option value=\"1\">Married</option>";
                                    } elseif ($row["FacultyMaritalStatus"] == "1") {
                                        echo "<option value=\"1\">Married</option>";
                                        echo "<option value=\"0\">Unmarried</option>";
                                    }
                                    ?>


                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Spouse Name <p style="color:red; display:inline">*</p></label>
                                <?php echo "<input type=\"text\" name=\"mySpouse\" id=\"myspouse\" value=\"" . $row["FacultySpouse"] . "\" maxlength=\"70\" pattern=\"[a-zA-Z]{2,70}\" disabled required/>"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Disability <p style="color:red; display:inline">*</p></label>
                                <?php echo "<input type=\"text\" name=\"myDisability\" value=\"" . $row["FacultyDisablity"] . "\" maxlength=\"255\" pattern=\"[a-zA-Z]{2,255}\" />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Aadhar Card Number</label>
                                <?php echo "<input type=\"text\" name=\"myAadharCardNo\" value=\"" . $row["FacultyAadharcardNo"] . "\" maxlength=\"12\" pattern=\"[0-9]{12}\" required />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Higest Qualification</label>
                                <?php echo "<input type=\"text\" name=\"myQualification\" value=\"" . $row["FacultyHighestQulification"] . "\" maxlength=\"70\" pattern=\"[A-Za-z0-9]{2,70}\" required />"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>AcademicYear</label>
                                <select name="myAcademicYear" style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                    <?php
                                    $q = "SELECT tbl_academicyear.*,tbl_faculty.* from tbl_faculty INNER JOIN tbl_academicyear on tbl_faculty.AcademicYearID=tbl_academicyear.AcademicYearID where tbl_faculty.AcademicYearID='" . $row["AcademicYearID"] . "';";
                                    $academicYearID = "";
                                    $rows1 = $user->query($q);

                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {
                                            $academicYearID = $row1["AcademicYearID"];
                                            echo "<option value=";
                                            echo $row1['AcademicYearID'];
                                            echo ">";
                                            echo $row1["AcademicYear"];
                                            echo "</option>";
                                        }
                                    } else {
                                        echo "Cource not found";
                                    }

                                    $q = "SELECT tbl_academicyear.* from tbl_academicyear where tbl_academicyear.AcademicYearID!='" . $academicYearID . "' and tbl_academicyear.AcademicYearEndAt IS null";

                                    $rows1 = $con->query($q);

                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {

                                            echo "<option value=";
                                            echo $row1['AcademicYearID'];
                                            echo ">";
                                            echo $row1["AcademicYear"];
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
                                    $q = "select tbl_course.*,tbl_faculty.* from tbl_faculty inner join tbl_course on tbl_faculty.FacultyCourseID=tbl_course.CourseID where tbl_faculty.FacultyCourseID='" . $row["FacultyCourseID"] . "';";
                                    $courseID = "";
                                    $rows1 = $con->query($q);

                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {
                                            $courseID = $row1["CourseID"];
                                            echo "<option value=";
                                            echo $row1['CourseID'];
                                            echo ">";
                                            echo $row1["CourseName"];
                                            echo "</option>";
                                        }
                                    } else {
                                        echo "Cource not found";
                                    }

                                    $q = "select tbl_course.* from tbl_course where tbl_course.CourseID!='" . $courseID . "';";

                                    $rows1 = $con->query($q);

                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {

                                            echo "<option value=";
                                            echo $row1['CourseID'];
                                            echo ">";
                                            echo $row1["CourseName"];
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
                <?php
                    }
                } else {
                    header("location:course.php", false);
                    echo "no data found";
                }


                ?>
            </table>
        </form>
    </fieldset>
    <script>
        function myStateName() {
            alert("fsfs");
            var v = new XMLHttpRequest();
            <?php
            // $abc = "<script>
            // var textBox=document.getElementById(\"myacademicyear\").value;
            // document.writeln(textBox);
            // </script>";  

            $q = "SELECT
                tbl_city.CityID,
                tbl_city.CityName
            FROM
                tbl_city
            INNER JOIN tbl_state ON tbl_city.CityID = tbl_state.StateID where tbl_state.StateID=";

            ?>
            //alert(<?php //echo json_encode($q);
                    ?>);

            var l = <?php echo json_encode($q); ?>;
            v.open("POST", "data.php?v=" + l + "'" + document.getElementById("mystate").value + "';", true);
            v.send();
            v.onreadystatechange = getData;

            function getData() {
                if (v.readyState == 4) {
                    if (v.status == 200) {
                        document.getElementById("mycity").innerHTML = v.responseText;
                    }
                }
            }

        }
        //-------------------------------------------------------------------------------------------------------
        function maritalStatus() {
            var v = document.forms[0].mymaritalstatus.value;
            if (v == 0) {
                document.forms[0].myspouse.disabled = true;
            } else if (v == 1) {
                document.forms[0].myspouse.disabled = false;
            }
        }
    </script>
</body>

</html>