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
    //   include 'header.php';
      
  }
  else
  {
      echo "result 0";
      header("location:/Attendance/index.php");
  }

 if($_REQUEST['SubjectID'])
 {
     /*$name=$_POST["myName"];
     $email=$_POST["myEmail"];
     $gender=$_POST["myGender"];*/
     $q="delete from tbl_subject where SubjectID='".$_REQUEST['SubjectID']."'";

     if($con->query($q)==true)
     {
         header("location:subject.php");
         echo "data deleted successfully";
     }
     else
     {
         header("location:subject.php");
         echo "data is not deleted successfully";
     }
     
 }
 else
     {
         header("location:subject.php");
         echo "query string not set";
     }
?>