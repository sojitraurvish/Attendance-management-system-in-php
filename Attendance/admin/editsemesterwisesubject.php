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

// $c=$user->encrypt("urvish");
//                 echo $c;
// $p=$user->decrypt($c);
//                 echo $p;

if (isset($_POST["mySubmit"])) {

    $q="where tbl_course_semester.AcademicYearID='".$_POST["myAcademicYearID"]."' and tbl_course_semester.CourseID='".$_POST["myCourseID"]."' and tbl_course_semester.SemesterDivitionID='".$_POST["mySemesterDivitionID"]."';";
    $rows=$user->tbl_course_semester($q);
    $courseSemesterID="";

    if ($rows->num_rows>0) 
    {
        foreach($rows as $row)
        {
            $courseSemesterID=$row["CourseSemesterID"];
        }
    } 
    else 
    {
        ?>
        <script>
            window.alert("<?php echo "Error:" . $con->error; ?>");
        </script>

        <?php
    }



    $q = "update tbl_semester_subject set CourseSemesterID='".$courseSemesterID."',SubjectID='".$_POST["mySubjectID"]."',SubjectCode='".$_POST["mySubjectCode"]."',
    SubjectDescription='".$_POST["mySubjectDescription"]."',
    SubjectType='".$_POST["mySubjectType"]."',
    SubjectCreatedDate='".$_POST["mySemesterSubjectCreatedAt"]."',
    SubjectEndDate='".$_POST["mySemesterSubjectEndAt"]."' where tbl_semester_subject.SemesterSubjectID='".$user->decrypt($_REQUEST["SemesterSubjectID"])."'";

    if ($con->query($q) == true) 
    {
        echo "data inserted successfully";
        ?>
        <script>
            location.replace("semesterwisesubject.php");
        </script>
        <?php
    } 
    else 
    {
        ?>
        <script>
            window.alert("<?php echo "Error:" . $con->error; ?>");
        </script>

        <?php
    }
}

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/Attendance/common/asset/dist/css/forms.css">

    <style>

    </style>
</head>

<body>
    <fieldset>
        <legend>Semester Subject</legend>
        <form method="POST" name="semsub">
            <table>
            <?php
                        
                        /*$name=$_POST["myName"];
                        $email=$_POST["myEmail"];
                        $gender=$_POST["myGender"];*/
                        // $q="select * from tbl_course_semester where CourseSemesterID='".$_REQUEST['CourseSemesterID']."'";
                        $q="WHERE tbl_academicyear.AcademicYearEndAt is null and tbl_course_semester.SemesterEndDate is null and tbl_semester_subject.SemesterSubjectID='".$user->decrypt($_REQUEST["SemesterSubjectID"])."'";
                        $rows=$user->tbl_semester_subject($q);

                        if($rows->num_rows>0)
                        {
                            foreach($rows as $row)
                            {
            ?>
                <tr>
                    <td>
                        <label>Academic Year</label>

                        <select name="myAcademicYearID" id="myacademicyear" onchange="myAcademicYear()" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <!-- <option value="">Select Value</option>-->
                            <?php echo "<option value=\"".$row["AcademicYearID"]."\">".$row["AcademicYear"]."</option>"?> 
                                    <?php
                                    $rows1 = $user->query("SELECT distinct(tbl_academicyear.AcademicYearID),(tbl_academicyear.AcademicYear)
                                    FROM
                                        `tbl_course_semester`
                                        INNER JOIN tbl_academicyear ON tbl_course_semester.AcademicYearID = tbl_academicyear.AcademicYearID
                                        INNER JOIN tbl_course ON tbl_course_semester.CourseID = tbl_course.CourseID
                                        INNER JOIN tbl_semester_divition ON tbl_course_semester.SemesterDivitionID=tbl_semester_divition.SemesterDivitionID 
                                        WHERE tbl_academicyear.AcademicYearEndAt IS null and tbl_course_semester.SemesterEndDate is null and tbl_academicyear.AcademicYear!='".$row["AcademicYear"]."';");

                                    if ($rows1->num_rows > 0) {
                                        foreach ($rows1 as $row1) {
                                            echo "<option value=\"" . $row1["AcademicYearID"] . "\">" . $row1["AcademicYear"] . "</option>";
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
                        <label>Course</label>

                        <select name="myCourseID" id="mycourse" onchange="myCourse()" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <?php echo "<option value=\"".$row["CourseID"]."\">".$row["CourseName"]."</option>"?> 
                        </select>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label>Semester Division</label>

                        <select name="mySemesterDivitionID" id="mysemesterdivition" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <?php echo "<option value=\"".$row["SemesterDivitionID"]."\">".$row["SemesterName"]."-".$row["DivitionName"]."</option>"?> 
                        </select>
                    </td>

                </tr>

                <tr>
                    <td>
                        <label>Subject</label>

                        <select name="mySubjectID" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <?php echo "<option value=\"" . $row["SubjectID"] . "\">" . $row["SubjectName"] . "</option>";?>
                            <?php
                            $q="where SubjectID!='".$row["SubjectID"]."'";
                            $rows2 =$user->tbl_subject($q);

                            if ($rows2->num_rows > 0) {
                                foreach ($rows2 as $row2) {
                                    echo "<option value=\"" . $row2["SubjectID"] . "\">" . $row2["SubjectName"] . "</option>";
                                }
                            } else 
                            {
                                // header("location:course.php", false);
                                echo "no data found";
                            }
                            ?>
                        </select>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label>Subject Code</label>
                        <input type="text" name="mySubjectCode" value="<?php echo $row["SubjectCode"] ?>" pattern="[A-Za-z0-9]{2,10}" maxlength="10" required />
                    </td>

                </tr>

                <tr>
                    <td>
                        <label>Subject Description</label>
                        <input type="text" name="mySubjectDescription" value="<?php echo $row["SubjectDescription"] ?>"   maxlength="50" required />
                    </td>

                </tr>

                <tr>
                        <td>
                           <label>Semester Subject Create Date</label>
                            <input type="date" min="<?php echo date("Y-m-d");?>" value="<?php echo $row["SubjectCreatedDate"] ?>" name="mySemesterSubjectCreatedAt" pattern="\d{1,2}/\d{1,2}/\d{4}" size="10"  maxlength="10" required/> 
                        </td>

                </tr>

                <tr>

                    <td>
                        <label>Subject type:</label>
                        <select name="mySubjectType" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                            <?php
                                $flag=0;
                                if($row["SubjectType"]==="Pr")
                                {
                                    echo "<option value=\"Pr\">Practical</option>";
                                    $flag=1;
                                }
                                else
                                {
                                    echo "<option value=\"Th\">Theory</option>";
                                    $flag=2;
                                }

                                if($flag==1)
                                {
                                    echo "<option value=\"Th\">Theory</option>";
                                }
                                elseif($flag==2)
                                {
                                    echo "<option value=\"Pr\">Practical</option>";
                                }
                            ?>
                            
                            
                        </select>
                    </td>
                </tr>
                <tr>
                        <td>
                           <label>Semester Subject End Date</label>
                            <input type="date" min="<?php echo date("Y-m-d");?>" name="mySemesterSubjectEndAt" pattern="\d{1,2}/\d{1,2}/\d{4}" size="10"  maxlength="10" required/> 
                        </td>

                </tr>
                <tr>
                    <td>
                        <br>
                        <input type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px;" />
                    </td>
                    <td>
                        <br>
                        <a href="semesterwisesubject.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                    </td>
                </tr>
                <?php
                            }
                            }
                            else
                            {
                                header("location:semesterwisesubject.php",false);
                                echo "no data found";
                            }
                            
                        
                ?>
            </table>
        </form>
    </fieldset>
            
            
    <script>
        function myAcademicYear()
        {
            
            var v=new XMLHttpRequest();
            <?php
                // $abc = "<script>
                // var textBox=document.getElementById(\"myacademicyear\").value;
                // document.writeln(textBox);
                // </script>";  

                $q="SELECT
                    distinct(tbl_course.CourseID),
                    (tbl_course.CourseName)
                FROM
                    `tbl_course_semester`
                INNER JOIN tbl_academicyear ON tbl_course_semester.AcademicYearID = tbl_academicyear.AcademicYearID
                INNER JOIN tbl_course ON tbl_course_semester.CourseID = tbl_course.CourseID
                INNER JOIN tbl_semester_divition ON tbl_course_semester.SemesterDivitionID = tbl_semester_divition.SemesterDivitionID
                WHERE tbl_academicyear.AcademicYearEndAt is null and tbl_course_semester.SemesterEndDate is null
                and tbl_course_semester.AcademicYearID=";
                
            ?>
            //alert(<?php //echo json_encode($q);?>);
            
            var l=<?php echo json_encode($q);?>;
            v.open("POST","data.php?v="+l+"'"+document.getElementById("myacademicyear").value+"';",true);
            v.send();
            v.onreadystatechange=getData;

            function getData()
            {
                if(v.readyState==4)
                {
                    if(v.status==200)
                    {
                        document.getElementById("mycourse").innerHTML=v.responseText;
                    }
                }
            }
            
        }

        //-----------------------------------------------------------------------------------------------

        function myCourse()
        {
            
            var v=new XMLHttpRequest();
            <?php
                // $abc = "<script>
                // var textBox=document.getElementById(\"myacademicyear\").value;
                // document.writeln(textBox);
                // </script>";  
                
                $q="SELECT distinct
                    tbl_semester_divition.SemesterDivitionID,
                    tbl_semester_divition.SemesterName,
                    tbl_semester_divition.DivitionName
                FROM
                    `tbl_course_semester`
                INNER JOIN tbl_academicyear ON tbl_course_semester.AcademicYearID = tbl_academicyear.AcademicYearID
                INNER JOIN tbl_course ON tbl_course_semester.CourseID = tbl_course.CourseID
                INNER JOIN tbl_semester_divition ON tbl_course_semester.SemesterDivitionID = tbl_semester_divition.SemesterDivitionID
                WHERE tbl_academicyear.AcademicYearEndAt is null and tbl_course_semester.SemesterEndDate is null
                and tbl_course_semester.CourseID=";
                
                ?>
            //alert(<?php //echo json_encode($q);?>);
            
            // alert(document.getElementById("mycourse").value);

            var l=<?php echo json_encode($q);?>;
            v.open("POST","datasemesterdivition.php?v="+l+"'"+document.getElementById("mycourse").value+"';",true);
            v.send();
            v.onreadystatechange=getData;

            function getData()
            {
                if(v.readyState==4)
                {
                    if(v.status==200)
                    {
                        document.getElementById("mysemesterdivition").innerHTML=v.responseText;
                    }
                }
            }
            
        }
    </script>
</body>

</html>