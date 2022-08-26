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
        $q="insert into tbl_semester_divition(SemesterName,DivitionName) values('".$_POST["mySemesterName"]."','".$_POST["myDivisionName"]."')";
        
        if($con->query($q)==true)
        {
            echo "data inserted successfully";
            ?>
            <script>
                location.replace("semesterdivition.php");
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
        // $conn=mysqli_connect("localhost","root","","admintest");
        //     if(!$conn)
        //     {die();
            
        //     }
        //     else{
                
            
        //     if(isset($_POST['mySubmit']))
        //      {  
        //         $name=$_POST['semname'];
        //         $divname=$_POST['division'];
                
        //         $insert="insert into tbl_semesterdivsion(SemesterName,DivisionName)values('$name','$divname')";
                
        //         $query=mysqli_query($conn,$insert);
        //          if($query)
        //         {
        //             echo"insert successful";
        //         }
        //         else
        //         {
        //             echo"Insert FAIL";
        //         }
        //      }
        //     }
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
            <legend>Add SemesterDivition</legend>
            
            <form method="post" name="SemDiv">
                <table>
                    
                     <tr>
                            <td>
                               <label>Semester Name</label>
                               <input type="text" name="mySemesterName" pattern="[0-9]{1}[0-2]{0,1}" size="2" maxlength="2" title="Enter Integer only And It must be <= 12" required/> 
                            </td>
                     </tr>
                     <tr>
                            <td>
                               <label>Division Name</label>
                               <input type="text" name="myDivisionName" pattern="[A-Z0-9]{1,2}" size="2" maxlength="2" title="Letter-Number like A1 or A and Letter should be upper case" required/> 
                            </td>
                     </tr>
                     <tr>
                            <td>
                                <br>
                                <input  type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px;"/>
                            </td>
                            <td>
                                <br>
                                 <a href="semesterdivition.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                            </td>
                        </tr>
                     
                </table>
            </form>
        </fieldset>

    </body>
</html>
