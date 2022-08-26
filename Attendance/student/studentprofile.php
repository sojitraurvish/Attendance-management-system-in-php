
<?php
if (!session_start()) {
    session_start();
}

include __DIR__ . '/../database/user.php';
$user = new User();
$con=$user->connection();
$rows = $user->checkUserExistanceForAllPage($_SESSION["username"], $_SESSION["password"], $_SESSION["usertype"]);

if ($rows->num_rows > 0) {
    include 'header.php';
} else {
    echo "result 0";
    header("location:/Attendance/index.php");
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
        <style>
            input{
            padding :.5em;
            border:solid 1px #ccc;
            min-width: 100px;
            width: 200px;
        }
        fieldset{
            margin: 2em 0;
            padding: 2em 2em;
            border: solid 1px #ccc;
            border-radius: 6px;
            min-width: 500px;
           
            
        }
         legend{
            font-size: 1.25em;
            padding: 0.25;
            color: #999;
        }
        label{
            display: block;
            margin-top: 1em;
        }
        @media screen and (min-width: 430px)
        {
            legend{
                font-size: 1.75em;
            }
            
            fieldset{
                width: 30%;
                min-width: 800px;
                margin :auto;}
            
        }
        td{
            padding:0px  40px;
        }
        
        input{margin-bottom:20px;}
        </style>
        <?php
            $q="select * from tbl_student where UserID='".$_SESSION["userid"]."'";
            $rows=$con->query($q);
                    if($rows->num_rows>0)
                    {
                        foreach($rows as $data)
                        {
                       
        ?>
                     
                    
                            <fieldset style="align-items: right">
                                <legend>Student Profile</legend>
                                <img width="20%" height="20%" src="uplode/student.png" alt="Italian Trulli">
                             <table  style="float: right;">
                             
                                 
                            <tr>
                                <td>
                                <label> Name:</label>
                                <input type="text" name="fname" value="<?php echo $data['StudentFname']?> <?php echo $data['StudentMname']?> <?php echo $data['StudentLname']?>" disabled/>
                                </td>
                    
                                <td>
                                <label>Student Enrollment</label>
                                <input type="text" name="stud-enro" value="<?php echo $data['StudentEnrollmentNo']?>" disabled/> 
                            </td>
                            </tr>
                             
                                  <td>  
                                <label>Dob</label>
                                <input type="text" name="dob" value="<?php echo $data['StudentDOB']?>" disabled/>
                                </td>
                            
                                <?PHP 

                                if($data['StudentGender']  =="M")
                                {
                                    $gender="Male";

                                }
                                else{ $gender="Female";}
                                ?>
                        
                            <td>
                                <label>Gender</label>
                                <input type="text" name="gender" value="<?php echo $gender?>" disabled/>
                            </td>
                             <tr>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email" value="<?php echo $data['StudentEmail']?>" disabled/>
                            </td>
                        
                            <td>
                                <label>Contact no</label>
                                <input type="text" name="contact" value="<?php echo $data['StudentContactNo']?>" disabled/>
                            </td>
                             </tr>
                              <tr>
                                <td>  
                                <label>Enroll year</label>
                                <input type="text" name="year" value="<?php echo $data['EnrollYear']?>" disabled/>    
                           </td>
                        
                            <td>
                                <label>Local Address</label>
                                <input type="text" name="laddress" value="<?php echo $data['StudentLocalAddress']?>" disabled/>
                              </td>   
                            </tr>
                            
                            
                                <tr>
                            <td>
                                <label>Mothers's name</label>
                                <input type="text" name="motherrname" value="<?php echo $data['StudentMotherName']?>" disabled/>
                            </td>
                            
                            <td>
                                <label>Course name</label>
                                <input type="text" name="cname" value="MscIT" disabled/>
                            </td>
                            
                        </tr>
                        <tr>
                        <td>
                                <label>Academic year ID</label>
                                <input type="text" name="ayearid" value="<?php echo $data['AcademicYearID']?>" disabled/>
                            </td>
                            <td>
                                <label>Contact no</label>
                                <input type="text" name="contact" value="<?php echo $data['StudentContactNo']?>" disabled/>
                            </td>
                              
                               
                         </tr>      
                     </table>
                            </fieldset>     
        <?php               }
        }
        else
        {
            echo "data not display".$con->error;
        }
        ?>        

       
    </head>
    <body></body>
</html>
