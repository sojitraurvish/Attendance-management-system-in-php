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
        $q="insert into tbl_academicyear(AcademicYear,AcademicYearCreatedAt) values('".$_POST["myAcademicYear"]."','".$_POST["myAcademicYearCreatedAt"]."')";
        
        if($con->query($q)==true)
        {
            echo "data inserted successfully";
            ?>
                <script>
                    location.replace("academicyear.php");
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
            <legend>Add Academic Year</legend>
            <form action="" method="POST" >
                <table>
                    <tr>
                            <td>
                               <label>Academic Year</label>
                                <input type="text" name="myAcademicYear" pattern="[0-9]{4}-[0-9]{2}" maxlength="7" title="should be:2019-20" required/> 
                            </td>

                    </tr>

                    <tr>
                            <td>
                               <label>Academic Year Start Date</label>
                                <input type="date" min="<?php echo date("Y-m-d");?>" name="myAcademicYearCreatedAt" pattern="\d{1,2}/\d{1,2}/\d{4}" size="10"  maxlength="10" required/> 
                            </td>

                    </tr>
                    
                        <tr>
                            <td>
                                <br>
                                <input  type="submit" name="mySubmit" value="submit" class="button" style="background-color: #4CAF50; padding: 13px 80px;"/>
                            </td>
                            <td>
                                <br>
                                <!-- <input type="submit" name="myCancel" formaction="academicyear.php" value="Cancel" class="button" style="background-color: #f44336;"/> -->
                                <a href="academicyear.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                                
                            </td>
                        </tr>
                    
                    
                </table>
            </form>
        </fieldset>
    
    </body>
</html>
