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
        if($user->query($_REQUEST["v"])==true)
        {
            header("location:faculty.php");
            echo "data updated successfully";
        }
        else
        {
            header("location:faculty.php");
            echo "data is not updated successfully";
        }
        
    }
    else
        {
            header("location:faculty.php");
            echo "query string not set";
        }    

                
            ?>