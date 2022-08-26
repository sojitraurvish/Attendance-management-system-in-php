<?php
    session_start();
    session_destroy();
    header("Location:/Attendance/index.php");
?>