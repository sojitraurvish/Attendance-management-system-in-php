<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementsByClassName("main")[0].style.marginLeft = "250px";
  document.getElementsByClassName("main2")[0].style.marginLeft = "250px";
  
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementsByClassName("main")[0].style.marginLeft= "0";
  document.getElementsByClassName("main2")[0].style.marginLeft= "0";
}

function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>



<link rel="stylesheet" type="text/css" href="/Attendance/common/asset/dist/css/header.css"><!--css file-->
<link rel="stylesheet" type="text/css" href="/Attendance/common/asset/plugins/fontawesome-free-5.15.4-web/css/all.css">

</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="dashboard.php" class="sidenav-first-element-margin"><i class="fas fa-chart-line"> Dashboard</i> </a>
  
  
  <button class="dropdown-btn"><i class="far fa-plus-square"> Manage Acedemic Details</i> 
    <i class="fa fa-caret-down"></i>
  </button>
  
  <div class="dropdown-container">
    <a href="academicyear.php"><i class="far fa-calendar-alt"> Manage Acedemic Year</i> </a>
    <a href="course.php"><i class="fas fa-graduation-cap"> Manage Cource</i> </a>
    <!-- <a href="#"><i class="fas fa-list-ol"> Add  Division</i> </a> -->
    <a href="semesterdivition.php"><i class="fas fa-person-booth"> Manage Semstor Division</i> </a>
    <a href="subject.php"><i class="fas fa-book"> Manage Subject</i> </a>
    <a href="coursewisesemester.php"><i class="fas fa-list-ol"> Manage Cource Wise Semester</i> </a>
    <a href="semesterwisesubject.php"><i class="fas fa-book"> Manage Semester Wise Subject</i> </a>
  </div>

  

  <button class="dropdown-btn"><i class="fas fa-users"> Manage Users</i> 
    <i class="fa fa-caret-down"></i>
  </button>
  
  <div class="dropdown-container">
    <a href="faculty.php"><i class="fas fa-chalkboard-teacher"> Manage Faculty</i> </a>
    <a href="student.php"><i class="fas fa-user-graduate"> Manage Students</i> </a>
    <!-- <a href="#"><i class="fas fa-people-arrows"> Assign counsellor to student</i> </a> -->
    
        <!-- <button class="dropdown-btn"><i class="fas fa-chalkboard-teacher"> Add Faculty</i> 
        <i class="fa fa-caret-down"></i>
        </button>
      
        <div class="dropdown-container">
          <a href="#"><i class="fas fa-chalkboard-teacher"> Add Faculty</i> </a>
          <a href="#"><i class="fas fa-user-graduate"> Add Students</i> </a>
          <a href="#"><i class="fas fa-people-arrows"> Assign counsellor to student</i> </a>
        </div> -->
  </div>

  <button class="dropdown-btn"><i class="fas fa-users"> Manage Allocation</i> 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="studentallocation.php"><i class="fas fa-user-graduate"> Students Allocation</i> </a>
    <a href="facultyallocation.php"><i class="fas fa-chalkboard-teacher"> Faculty Allocation</i> </a>
    <a href="counsellorallocation.php"><i class="fas fa-people-arrows"> Assign counsellor to student</i> </a>
    
        <!-- <button class="dropdown-btn"><i class="fas fa-chalkboard-teacher"> Add Faculty</i> 
        <i class="fa fa-caret-down"></i>
        </button>
      
        <div class="dropdown-container">
          <a href="#"><i class="fas fa-chalkboard-teacher"> Add Faculty</i> </a>
          <a href="#"><i class="fas fa-user-graduate"> Add Students</i> </a>
          <a href="#"><i class="fas fa-people-arrows"> Assign counsellor to student</i> </a>
        </div> -->
  </div>
  
  <a href="#" ><i class="fas fa-calendar-day"> Schedule Timetable</i> </a>

  <button class="dropdown-btn"><i class="far fa-calendar-alt"> View Report</i> 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="studentallocation.php"><i class="fas fa-user-graduate"> report 1</i> </a>
    <a href="facultyallocation.php"><i class="fas fa-chalkboard-teacher"> report 2</i> </a>
    <a href="counsellorallocation.php"><i class="fas fa-people-arrows"> report 3</i> </a>
    
  </div>
</div>

<div class="main2">
	<div class="topnav" id="myTopnav">
        <a style="font-size:15px;cursor:pointer" onclick="openNav()">&#9776; </a>
        <a href="dashboard.php" class="active"><i class="fas fa-clipboard-check"> Attendance Management System</i> </a>
        <a href="#"> 
          Cource:
            <select name="myselection" size=1 style="padding :-0.5em ​!important; border:solid 1px #ccc !important; min-width: 191px !important; width: 191px !important;">
                <option value="MSC(It)">MSC(It)</option>>
            </select> 
        </a>

        <a href="#"> 
          Academic Year:
            <select name="myselection"  size=1 style="padding :-0.5em ​!important; border:solid 1px #ccc !important; min-width: 191px !important; width: 191px !important;">
                <option value="2021-22">2020-21</option>>
            </select> 
        </a>
        
    
        
        <div class="topnav-right">
            <div class="dropdown">
                <button class="dropbtn"><i class="fas fa-users-cog"> Admin</i>
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="adminprofile.php"><i class="far fa-id-badge"> Profile</i> </a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"> Logout</i> </a>
                </div>
            </div> 
            
        </div>
          <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</div>


<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 || document.body.scrollLeft > 20 || document.documentElement.scrollLeft > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    document.body.scrollLeft = 0;
    document.documentElement.scrollLeft = 0;
    }
</script>



<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
    } else {
    dropdownContent.style.display = "block";
    }
    }); 
    }
</script>
   
</body>
</html> 
