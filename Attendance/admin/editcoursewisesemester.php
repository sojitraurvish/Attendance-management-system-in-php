<?php
	if(!session_start())
    {
        session_start();
    }
    include __DIR__.'/../database/user.php';
    $user=new User();
    $con=$user->connection();

    $rows=$user->checkUserExistanceForAllPage($_SESSION["username"],$_SESSION["password"],$_SESSION["usertype"]);
    
    if($rows->num_rows>0)
    {
        include 'header.php';
        
    }
    else
    {
        header("location:/Attendance/index.php");
        echo "result 0";
    }

	if(isset($_POST["mySubmit"]))
    {
		$rows=$user->query("SELECT * from tbl_academicyear WHERE AcademicYear='".$_POST["myYear"]."';");
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

        $semesterDivition=explode("-",$_POST["mySemesterDivision"]);
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


        $q="update tbl_course_semester set AcademicYearID='".$academicYearID."',CourseID='".$courseID."',SemesterDivitionID='".$semesterDivitionID."',SemesterCreatedDate='".$_POST['mySemesterCreatedAt']."',SemesterEndDate='".$_POST["mySemesterEndDate"]."' where CourseSemesterID='".$user->decrypt($_REQUEST["CourseSemesterID"])."'";
 
        if($con->query($q)==true)
        {
            // if (!headers_sent()) {
            //     foreach (headers_list() as $header)
            //       header_remove($header);
            //   }
            // 	header("location:academicyear.php",false);
             ?>
             <script>
                 location.replace("coursewisesemester.php");
             </script>
             <?php
            echo "data inserted successfully";
        }
        else
        {
            echo "<br> Error:".$con->error;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="/Attendance/common/asset/dist/css/forms.css">
    </head>
    <body>
        <fieldset>
            <legend>Update Course wise Semester</legend>
            <form method="POST">
                <table>
                <?php
                        
                            /*$name=$_POST["myName"];
                            $email=$_POST["myEmail"];
                            $gender=$_POST["myGender"];*/
                            // $q="select * from tbl_course_semester where CourseSemesterID='".$_REQUEST['CourseSemesterID']."'";
                       
                            $rows=$user->tbl_course_semester("where CourseSemesterID='".$user->decrypt($_REQUEST['CourseSemesterID'])."'");

                            if($rows->num_rows>0)
                            {
                                foreach($rows as $row)
                                {
                ?>
                   <tr>
                            <td>
                               <label>Academic Year</label>
                               
                               <select name="myYear" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                   <?php echo "<option value=\"".$row["AcademicYear"]."\">".$row["AcademicYear"]."</option>"?>
                                   <?php
								 		$academicYears=$user->tbl_academicyear("and AcademicYear!='".$row["AcademicYear"]."'"); 
										 if($academicYears->num_rows>0)
										{
											foreach($academicYears as $academicYear)
											{ 
												echo "<option value=\"".$academicYear["AcademicYear"]."\">".$academicYear["AcademicYear"]."</option>";
											}
										}
										else
										{
											header("location:course.php",false);
											echo "no data found";
										}
								   ?>
                               </select>
                            </td>

                   </tr>
                   <tr>
                            <td>
                               <label>Course</label>
                               
                               <select  name="myCourse" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
							   		<?php echo "<option value=\"".$row["CourseName"]."\">".$row["CourseName"]."</option>"?>
									<?php
										$courses=$user->tbl_course("where CourseName!='".$row["CourseName"]."';");
										if($courses->num_rows>0)
										{
											foreach($courses as $course)
											{ 
												echo "<option value=\"".$course["CourseName"]."\">".$course["CourseName"]."</option>";
											}
										}
										else
										{
											header("location:course.php",false);
											echo "no data found";
										}
									?>
                               </select>
                            </td>

                   </tr>
                   <tr>
                            <td>
                               <label>Semester Division</label>
                               
                               <select  name="mySemesterDivision" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
							   		<?php echo "<option value=\"".$row["SemesterName"]."-".$row["DivitionName"]."\">".$row["SemesterName"]."-".$row["DivitionName"]."</option>"?>
									<?php
										$semesterDivition=explode("-",$_POST["mySemesterDivition"]);
										echo $semesterDivition[0];
										echo $semesterDivition[1];
										$semesterDivitions=$user->tbl_semester_devition("where SemesterName!='".$row["SemesterName"]."' and DivitionName!='".$row["CourseName"]."' ;");
										if($semesterDivitions->num_rows>0)
										{
											foreach($semesterDivitions as $semesterDivition)
											{ 
												echo "<option value=\"".$semesterDivition["SemesterName"]."-".$semesterDivition["DivitionName"]."\">".$semesterDivition["SemesterName"]."-".$semesterDivition["DivitionName"]."</option>";
											}
										}
										else
										{
											header("location:course.php",false);
											echo "no data found";
										}
									?>
                               </select>
                            </td>

                   </tr>
                   <tr>
                            <td>
                               <label>Semester Created Date</label>
                               <?php echo "<input type=\"date\" name=\"mySemesterCreatedAt\" required value=\"".$row["SemesterCreatedDate"]."\""; ?>
                            </td>

                   </tr>
                   <tr>
                            <td>
                               <label>Semester End Date</label>
                               <?php echo "<input type=\"date\" name=\"mySemesterEndDate\" required value=\"".$row["SemesterEndDate"]."\"/>";?>
                            </td>

                   </tr>
                   <tr>
                            <td>
                                <br>
                                <input  type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px;"/>
                            </td>
                            <td>
                                <br>
                                 <a href="coursewisesemester.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                            </td>
                        </tr>
                   
						<?php
                            }
                            }
                            else
                            {
                                header("location:course.php",false);
                                echo "no data found";
                            }
                            
                        
                ?>
                </table>
            </form>
        </fieldset>
        <?php
        // put your code here
        ?>
    </body>
</html>
