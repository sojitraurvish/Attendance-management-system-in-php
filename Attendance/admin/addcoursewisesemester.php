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


    if(isset($_POST["mySubmit"]))
    {
        $academicYearID=$courseID=$semesterDivitionID="";

        $rows=$user->tbl_academicyear("and AcademicYear='".$_POST["myYear"]."';");
        if($rows->num_rows>0)
        {
            foreach($rows as $row)
            {
                $academicYearID=$row["AcademicYearID"];
            }
        }
        else
        {
            echo "data not found";
        }        
     
        $rows=$user->tbl_course("where CourseName='".$_POST["myCourse"]."';");
        if($rows->num_rows>0)
        {
            foreach($rows as $row)
            {
                $courseID=$row["CourseID"];
            }
        }
        else
        {
            echo "data not found";
        }  

        $semesterDivition=explode("-",$_POST["mySemesterDivition"]);
        echo $semesterDivition[0];
        echo $semesterDivition[1];

        $rows=$user->tbl_semester_devition("where SemesterName='".$semesterDivition[0]."' and DivitionName='".$semesterDivition[1]."';");
        if($rows->num_rows>0)
        {
            foreach($rows as $row)
            {
                $semesterDivitionID=$row["SemesterDivitionID"];
            }
        }
        else
        {
            echo "data not found";
        } 

                    $q="insert into tbl_course_semester(AcademicYearID,CourseID,SemesterDivitionID,SemesterCreatedDate) values('".$academicYearID."','".$courseID."','".$semesterDivitionID."','".$_POST["mySemesterCreatedDate"]."')";
        
                    if($con->query($q)==true)
                    {
                        echo "data inserted successfully";
                        ?>
                        <script>
                            location.replace("coursewisesemester.php");
                        </script>
                        <?php
                    }
                    else
                    {
                        // echo "<br> Error:".$con->error;
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
        <legend>Add Course Wise Semester</legend>
        <form method="post" name="courcesem">
            <table>

                        <tr>
                            <td>
                                <label>Academic Year</label>

                                <select name="myYear" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                    <?php
                                        
                                        $rows = $user->tbl_academicyear();
                        
                                        if ($rows->num_rows > 0) 
                                        {
                                            foreach ($rows as $row) 
                                            {
                                
                                                echo "<option value=\"".$row["AcademicYear"]."\">".$row["AcademicYear"]."</option>";
                                    
                                            }
                                        } 
                                        else 
                                        {
                                            header("location:coursewisesemester.php");
                                            echo "no data found";
                                        }
                                    ?>
                                    </select>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <label>Course</label>

                                <select name="myCourse" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                <?php
                                        
                                        $rows = $user->tbl_course();
                        
                                        if ($rows->num_rows > 0) 
                                        {
                                            foreach ($rows as $row) 
                                            {
                                
                                                // echo "<option value=\"".$row["AcademicYear"]."\">".$row["AcademicYear"]."</option>";
                                                echo "<option value=\"".$row["CourseName"]."\">".$row["CourseName"]."</option>";
                                    
                                            }
                                        } 
                                        else 
                                        {
                                            header("location:coursewisesemester.php");
                                            echo "no data found";
                                        }
                                    ?>
                                   
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <label>Semester Division</label>

                                <select name="mySemesterDivition" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                <?php
                                        
                                        $rows = $user->tbl_semester_devition();
                        
                                        if ($rows->num_rows > 0) 
                                        {
                                            foreach ($rows as $row) 
                                            {
                                
                                                // echo "<option value=\"".$row["AcademicYear"]."\">".$row["AcademicYear"]."</option>";
                                                // echo "<option value=\"".$row["CourseName"]."\">".$row["CourseName"]."</option>";
                                                echo "<option value=\"".$row["SemesterName"]."-".$row["DivitionName"]."\">".$row["SemesterName"]."-".$row["DivitionName"]."</option>";
                                    
                                            }
                                        } 
                                        else 
                                        {
                                            header("location:coursewisesemester.php");
                                            echo "no data found";
                                        }
                                    ?>
                                    
                                    
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <label>Semester Created Date</label>
                                <input type="date" name="mySemesterCreatedDate" min="<?php echo date('Y-m-d');?>" pattern="\d{1,2}/\d{1,2}/\d{4}" size="10"  maxlength="10" required/>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <br>
                                <input type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px;" />
                            </td>
                            <td>
                                <br>
                                <a href="coursewisesemester.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                            </td>
                        </tr>
                <?php
                    
                ?>

            </table>
        </form>
    </fieldset>
    
</body>

</html>