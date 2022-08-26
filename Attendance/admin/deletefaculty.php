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

 if($_REQUEST['v'])
 {
    $q="DELETE tbl_faculty.* FROM tbl_faculty INNER JOIN tbl_user ON tbl_faculty.UserID = tbl_user.UserID WHERE tbl_user.UserID='".$_REQUEST["v"]."'"; 
    if($user->query($q)==true)
    {
        $q="DELETE from tbl_user WHERE UserID='".$_REQUEST["v"]."';";

        if($user->query($q)==true)
        {   
            header("location:faculty.php",false);
            echo "data deleted successfully";
        }
        else
        {
            header("location:faculty.php",false);
            echo "data is not deleted successfully";
        }
         
         header("location:faculty.php",false);
         echo "data deleted successfully";
     }
     else
     {
         header("location:faculty.php",false);
         echo "data is not deleted successfully";
     }
     
 }
 else
     {
         header("location:faculty.php",false);
         echo "query string not set";
     }
?>