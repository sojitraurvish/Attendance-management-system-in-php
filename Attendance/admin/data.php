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
                

            
                if(isset($_REQUEST["v"]))
                {
                    $rows=$user->query($_REQUEST["v"]);

                    if($rows->num_rows>0)
                    {
                        echo "<option value=\"\">Select Value</option>";
                        while($row = $rows -> fetch_array(MYSQLI_NUM))
                        {
                            echo "<option value=\"".$row[0]."\">".$row[1]."</option>";
                        }
                        // foreach($rows as $row)
                        // {
                        //     $t=$arr1[1];
                        //     echo $t;
                        //     echo $row[trim(strval($t)," ")]."<br>";
                        //     $l="AcademicYear";
                        //     echo $row[$l];
                        // }
                    }
                    else
                    {
                        echo "result 0";
                    }

                }

                

                
            ?>