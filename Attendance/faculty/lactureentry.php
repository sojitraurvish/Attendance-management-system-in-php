<?php
  if(!session_start())
  {
      session_start();
  }
  include __DIR__.'/../database/user.php';
  $user=new User();

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
            fieldset{
            margin: 2em 2em;
            padding: 1em 2em;
            border: solid 1px #ccc;
            border-radius: 6px;
            min-width: 1200px;
   
        }
         label{
             font-size: 20px;
            display: block;
            margin-top: 5px;
        
        legend{
            font-size: 2em;
            padding: 0.25;
            color: #999;
        }
        input{
            padding :.5em;
            border:solid 1px #ccc;
            min-width: 100px;
            width: 300px;
        }
        
        td{
            padding-left:100px;
                        
        }
        
        input[type=checkbox] {
            vertical-align: middle;
            position: relative;
            bottom: 1px;
        }
        
        .button { /* Green */
            border: none;
            color: white;
            padding: 15px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 0px;
            cursor: pointer;
            font-family: "Times New Roman", Times, serif;
          }
        
        </style>
    </head>
    <body>
        <fieldset>
            <legend>Attendance</legend>
            <table>
                
                <tr>   
                    <td style=" padding-left:50px">
                        <label>Academic Year</label>
                        <select name="year" required style="margin-top:0px;padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 300px !important;">
                            <option>2021</option>
                        </select>
                    </td>
                    
                    <td style="padding-left:100px">
                        
                        <label>Subject</label>
                        <select name="subject" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 300px !important; ">
                            <option>subject</option>
                        </select>
                    
                    </td>
                    
                    <td style="padding-left:100px">
                        <label>Date</label>
                        <input name="date" type="date" required/>
                    </td>
                    
                    
                 </tr>
                <tr>
                    
                    <td style=" padding-left:50px">
                        
                        <label>CourseSemster</label>
                        <select name="coursesem" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 300px !important;">
                            <option> course</option>
                        </select>

                   </td>
                   
                   
                   
                    <td style="padding-left:100px"> 
                        
                        <label>Subject Type</label>
                        
                        <select name="type" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 300px !important;">
                            <option selected disabled>Subject Type</option>
                            <option>Theroy</option>
                            <option>Practical</option>
                        </select>
                        
                    </td>
                    
                    <td style="padding-left:100px">
                        <label>FromTime</label>
                        <input name="start_time" type="time" required/>     
                   </td>
                   
                </tr>
                   
                   <tr>
                       <td style=" padding-left:50px">
                           <label>SemesterDivision</label>
                           <select name="semdiv" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 300px !important;">
                                <option> course</option>
                           </select>
                           
                       </td>
                       
                       <td style="padding-left:100px">
                        
                        <label style="margin-bottom:0px">Topic</label>
                         <textarea id="id" name="topic" rows="1" cols="34" required ></textarea>
                        
                    </td>
                    
                    <td style="padding-left:100px">
                        
                         <label>ToTime</label>
                         <input name="end_time" type="time"  required/>
                    </td>

                   </tr>
                   
                   
                   <tr >
                       <td style="padding-left:0px"  colspan="3">
                           <fieldset style="min-width: 100px">
                               
                               <legend>Students</legend>
                               
                               
                                <table >
                                    
                                    <tr>
                                        <td style="padding-left: 150px">
                                            
                                            <input type="checkbox"/> 201906100110015
                                        </td>
                                    <td style="padding-left: 150px"><input type="checkbox"/> 201906100110016</td>
                                    <td style="padding-left: 150px;padding-right: 150px"><input type="checkbox"/> 201906100110017</td>
                                    
                                    <tr> <td style="padding-left: 150px">
                                            
                                            <input type="checkbox"/> 201906100110015
                                        </td>
                                    <td style="padding-left: 150px"><input type="checkbox"/> 201906100110016</td>
                                    <td style="padding-left: 150px;padding-right: 150px"><input type="checkbox"/> 201906100110017</td>
                                    </tr>
       
                                </table>
     
                            </fieldset>
                           
                           
                       </td>
                   </tr>
            </table>
            
            <table>
        <tr>
                       <td style="padding-left: 50px">
                                <br>
                                <input  type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px; border: none;color: white;padding: 15px 15px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 0px;width:200px;cursor: pointer;font-family: Times New Roman, Times, serif;"/>
                        </td>
                        <!-- <td style="padding-left: 50px">
                            <a href="" class="button" style="background-color: #f44336; padding:10px; margin:0px;">Delete</a>
                        </td> -->
                    </tr>
        </table>
        </fieldset>
        
        <?php
        // put your code here
        ?>
    </body>
</html>
