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
        $q="update tbl_academicyear set AcademicYear='".$_POST["myAcademicYear"]."',AcademicYearCreatedAt='".$_POST["myAcademicYearCreatedAt"]."',AcademicYearEndAt='".$_POST["myAcademicYearEndAt"]."' where AcademicYearID='".$user->decrypt($_REQUEST['AcademicYearID'])."' ";
        // echo $_POST["myAcademicYearCreatedAt"];
        if($con->query($q)==true)
        {
            // if (!headers_sent()) {
            //     foreach (headers_list() as $header)
            //       header_remove($header);
            //   }
            // header("location:academicyear.php",false);
            ?>
            <script>
                // location.replace("academicyear.php");
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
            <legend>Update Academic Year</legend>
            <form action="" method="POST" >
                <table>
                <?php
                        if($_REQUEST['AcademicYearID'])
                        {
                            /*$name=$_POST["myName"];
                            $email=$_POST["myEmail"];
                            $gender=$_POST["myGender"];*/
                            // $c=$user->encrypt("urvish");
                            //                 echo $c;
                            // $p=$user->decrypt($c);
                            //                 echo $p;  
                            $q="select * from tbl_academicyear where AcademicYearID='".$user->decrypt($_REQUEST['AcademicYearID'])."'";
                            $rows=$con->query($q);

                            if($rows->num_rows>0)
                            {
                                foreach($rows as $row)
                                {
                    ?>
                    
                    <tr>
                            <td>
                               <label>Academic Year</label>
                               
                                <?php echo "<input type=\"text\" name=\"myAcademicYear\" value=\"".$row["AcademicYear"]."\" pattern=\"[0-9]{4}-[0-9]{2}\" maxlength=\"7\" title=\"should be:2019-20\" required/> ";?>
                            </td>

                    </tr>

                    <tr>
                            <td>
                               <label>Academic Year Start Date</label>
                                <?php echo "<input type=\"date\" name=\"myAcademicYearCreatedAt\" value=\"".$row["AcademicYearCreatedAt"]."\"  size=\"10\"  maxlength=\"10\" required/>";?> 
                            </td>

                    </tr>

                    <tr>
                            <td>
                               <label>Academic Year End Date</label>
                                <?php echo "<input type=\"date\" name=\"myAcademicYearEndAt\" value=\"".$row["AcademicYearEndAt"]."\" pattern=\"\d{1,2}/\d{1,2}/\d{4}\" size=\"10\"  maxlength=\"10\" />";?> 
                            </td>

                    </tr>
                    
                        <tr>
                            <td>
                                <br>
                                <input  type="submit" name="mySubmit"  value="submit" class="button" style="background-color: #4CAF50; padding: 13px 80px;"/>
                            </td>
                            <td>
                                <br>
                                <!-- <input type="submit" name="myCancel" formaction="academicyear.php" value="Cancel" class="button" style="background-color: #f44336;"/> -->
                                <a href="academicyear.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                            </td>
                        </tr>
                    
                    <?php
                    }
                            }
                            else
                            {
                                header("location:academicyear.php",false);
                                echo "no data found";
                            }
                            
                        }
                        else
                        {
                            header("location:academicyear.php",false);
                            echo "query string not set";
                        }
                    ?>    
                </table>
            </form>
        </fieldset>
        
    </body>
</html>
