<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
            $conn=mysqli_connect("localhost","root","","admintest");
            if(!$conn)
            {die();
            
            }
            else{
                echo"Connection success";
            }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="forms.css">
    </head>
    
    <body>
            <fieldset>
                <legend>Admin</legend>   
                
                <form class="entry" method=post name="admin">
                    <table>                       
                        <tr>
                            <td>
                                <label>Photo:</label>
                                <input type="file" name="photo"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>First Name:</label>
                                <input type="text" name="fname"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Middle Name</label>
                                <input type="text" name="mname"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Last Name</label>
                                <input type="text" name="lname"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Course</label>
                                <input type="text" name="course"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Gender</label>
                                <input type="text" name="gender"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Dob</label>
                                <input type="date" name="dob"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Caste</label>
                                <input type="text" name="caste"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Sub Caste</label>
                                <input type="text" name="subcaste"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Local Address</label>
                                <input type="text" name="laddress"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Permanant Address</label>
                                <input type="text" name="paddress"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Blood group</label>
                                <input type="text" name="blood"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Contact no</label>
                                <input type="text" name="contact"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>City</label>
                                <input type="text" name="city"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>State</label>
                                <input type="text" name="state"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Marital Status</label>
                                <input type="text" name="marital"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Spouse Name</label>
                                <input type="text" name="spouse"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Disability</label>
                                <input type="text" name="disability"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Aadhar Card Number</label>
                                <input type="text" name="acardno"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Higest Qualification</label>
                                <input type="text" name="highqual"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User ID</label>
                                <input type="text" name="userid"/>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Submit data</label>
                                <input type="submit" name="submit" value="submit"/>
                            </td>
                        </tr>


                    </table>

                </form>
         </fieldset>
        
        <?php
             
             if(isset($_POST['submit']))
             {  
                $photo=$_POST['photo'];
                $fname=$_POST['fname'];
                $mname=$_POST['mname'];
                $lname=$_POST['lname'];
                $course=$_POST['course'];
                $gender=$_POST['gender'];
                $dob=$_POST['dob'];
                $caste=$_POST['caste'];
                $scaste=$_POST['subcaste'];
                $ladd=$_POST['laddress'];
                $padd=$_POST['paddress'];
                $blood=$_POST['blood'];
                $email=$_POST['email'];                
                $cont=$_POST['contact'];
                $city=$_POST['city'];           
                $state=$_POST['state'];                
                $marital=$_POST['marital'];
                $spouse=$_POST['spouse'];
                $disable=$_POST['disability'];
                $acardno=$_POST['acardno'];
                $hqual=$_POST['highqual'];
                

                $insert="insert into tbl_admin(AdminFname,AdminMname,AdminLname,AdminPhoto,AdminGender,AdminDOB,AdminlLocalAddress,AdminPermenantAddress,AdminCast,AdminSubCast,AdminBloodGroup,AdminEmail,AdminContactNo,AdminCity,AdminState,AdminMaritalStatus,AdminSpouse,AdminDisablity,AdminAadharcardNo,AdminHighestQulification)values('$fname','$mname','$lname','$photo','$gender','$dob','$ladd','$padd','$caste','$scaste','$blood','$email','$cont','$city','$state','$marital','$spouse','$disable','$acardno','$hqual')";
                    
                $query=mysqli_query($conn,$insert);
                 if($query)
                {
                    echo"insert successful";
                }
                else
                {
                    echo"Insert FAIL";
                }
             }
        ?>
        
    </body>
</html>