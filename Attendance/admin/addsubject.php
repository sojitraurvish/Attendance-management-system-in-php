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
        $q="insert into tbl_subject(SubjectName) values('".$_POST["mySubjectName"]."')";
        
        if($con->query($q)==true)
        {
            echo "data inserted successfully";
            ?>
            <script>
                location.replace("subject.php");
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
            <legend>Add Subject</legend>
            
            <form method="post" name="Subject">
                <table> 
                    <tr>
                            <td>
                               <label>Subject Name</label>
                               <input type="text" name="mySubjectName" pattern="[a-zA-Z]{3,50}" maxlength="50" required/> 
                            </td>
                    </tr>
                    
                     <tr>
                            <td>
                                <br>
                                <input  type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px;"/>
                            </td>
                            <td>
                                <br>
                                 <a href="subject.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                            </td>
                        </tr>
                    
                </table>
            </form>
        </fieldset>
        
    </body>
</html>
