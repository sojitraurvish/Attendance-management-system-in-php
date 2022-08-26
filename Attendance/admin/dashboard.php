<?php
if (!session_start()) {
  session_start();
}
include __DIR__ . '/../database/user.php';
$user = new User();

$rows = $user->checkUserExistanceForAllPage($_SESSION["username"], $_SESSION["password"], $_SESSION["usertype"]);

if ($rows->num_rows > 0) {
  include 'header.php';
} else {
  echo "result 0";
  header("location:/Attendance/index.php");
}




?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    /* Float four columns side by side */
    .column {
      float: left;
      width: 25%;
      padding: 0 5px;
    }

    .row {
      margin: 11px 24px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive columns */
    @media screen and (max-width: 600px) {
      .column {
        width: 100%;
        display: block;
        margin-bottom: 10px;
      }
    }

    /* Style the counter cards */
    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      padding: 16px;
      text-align: center;
      background-color: #444;
      color: white;
      border-radius: 5px;
    }

    .fa {
      font-size: 17px;
    }
  </style>
</head>

<body>


  <br>

  <div class="row">
    <div class="column">
      <a href="faculty.php">
        <div class="card">
          <p><i class="fas fa-chalkboard-teacher"></i></p>
          <h1>
            <?php
            $q = "SELECT count(*) as count FROM tbl_user WHERE UserDeletedAt IS NULL AND UserStatus = '1' AND UserType='F'";
            $rows = $user->query($q);
            if ($rows->num_rows > 0) {
              foreach ($rows as $row) {
                echo $row["count"];
              }
            } else {
              echo "data not found";
            }
            ?>
          </h1>
          <p>Facultys</p>
        </div>
      </a>
    </div>

    <div class="column">
      <a href="student.php">
        <div class="card">
          <p><i class="fas fa-user-graduate"></i></p>
          <h1>
            <?php
            $q = "SELECT count(*) as count FROM tbl_user WHERE UserDeletedAt IS NULL AND UserStatus = '1' AND UserType='S'";
            $rows = $user->query($q);
            if ($rows->num_rows > 0) {
              foreach ($rows as $row) {
                echo $row["count"];
              }
            } else {
              echo "data not found";
            }
            ?>
          </h1>
          <p>Students</p>
        </div>
      </a>
    </div>

    <div class="column">
      <a href="#">
        <div class="card">
          <p><i class="fas fa-user-secret"></i></p>
          <h1>0</h1>
          <p>Counselor</p>
        </div>
      </a>
    </div>

    <div class="column">
      <a href="#">
        <div class="card">
          <p><i class="fas fa-users"></i></p>
          <h1>
            <?php
            $q = "SELECT count(*) as count FROM tbl_user WHERE UserDeletedAt IS NULL AND UserStatus = '1' AND UserType='S' or UserType='F'";
            $rows = $user->query($q);
            if ($rows->num_rows > 0) {
              foreach ($rows as $row) {
                echo $row["count"];
              }
            } else {
              echo "data not found";
            }
            ?>
          </h1>
          <p>Total Users</p>
        </div>
      </a>
    </div>
  </div>

  <div class="row">
    <div class="column">
      <a href="course.php">
        <div class="card">
          <p><i class="fas fa-graduation-cap"></i></p>
          <h1>
            <?php
            $q = "SELECT count(*) as count FROM tbl_course";
            $rows = $user->query($q);
            if ($rows->num_rows > 0) {
              foreach ($rows as $row) {
                echo $row["count"];
              }
            } else {
              echo "data not found";
            }
            ?>
          </h1>
          <p>Total Course</p>
        </div>
      </a>
    </div>


    <div class="column">
      <a href="subject.php">
        <div class="card">
          <p><i class="fas fa-book"></i></p>
          <h1>
            <?php
            $q = "SELECT count(*) as count FROM tbl_subject";
            $rows = $user->query($q);
            if ($rows->num_rows > 0) {
              foreach ($rows as $row) {
                echo $row["count"];
              }
            } else {
              echo "data not found";
            }
            ?>
          </h1>
          <p>Total Subject</p>
        </div>
      </a>
    </div>
  </div>

</body>

</html>