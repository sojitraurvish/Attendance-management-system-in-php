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
        echo "result 0";
        header("location:/Attendance/index.php");
    }

    if(isset($_POST["mySubmit"]))
    {
        $q="insert into tbl_course(CourseName,CourseDescription,CourseCreatedAt) values('".$_POST["myCourseName"]."','".$_POST["myCourseDescription"]."','".$_POST["myCourseCreatedAt"]."')";
        
        if($con->query($q)==true)
        {
            echo "data inserted successfully";
            ?>
            <script>
                location.replace("course.php");
            </script>
            <?php
        }
        else
        {
            ?>
                <script>
                    window.alert("<?php echo "Error:".$con->error;?>");                       
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
    </head>
    <body>
        <fieldset>
            <legend>Add Course</legend>
            <form method="post" name="course">
                <table>
                    
                    <tr>
                            <td>
                               <label>Course Name</label>
                               <input type="text" name="myCourseName" size="20"  maxlength="20" required/> 
                            </td>

                    </tr>
                    <tr>
                            <td colspan="2">
                               <label>Course Description</label>
                               <textarea style="resize: none" rows="2" cols="35" name="myCourseDescription" size="50"  maxlength="50" required></textarea> 
                            </td>

                    </tr>
                    <tr>
                            <td>
                               <label>Course Create date</label>
                              
                               <input type="date" id="date" name="myCourseCreatedAt" pattern="\d{1,2}/\d{1,2}/\d{4}" size="10"  maxlength="10" required/> 
                               
                            </td>

                    </tr>
                    
                    <tr>
                            <td>
                                <br>
                                <input  type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50; padding: 13px 80px;"/>
                            </td>
                            <td>
                                <br>
                                <!-- <input type="submit" name="myCancel" formaction="course.php" value="Cancel" class="button" style="background-color: #f44336;"/> -->
                                <a href="course.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                            </td>
                    </tr>
                    
                     
                </table>
            </form>
        </fieldset>
        
        
    </body>
</html>
