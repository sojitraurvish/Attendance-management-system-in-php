<!-- https://www.jqueryscript.net/blog/best-table-pagination.html -->
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
	  	include 'header.php';
	}
	else
	{
	  echo "result 0";
	  header("location:/Attendance/index.php");
	}

    // require 'header.php';
	// require __DIR__.'/../database/user.php';
	// 

    // require '../config.php';
    // $database=new Database();
    // $con=$database->connection();
	$data="select * from tbl_faculty_subject_allocation";

	if (isset($_POST["mySubmit"])) 
	{
	
		$data="SELECT
		CONCAT(tbl_semester_divition.SemesterName,'-',tbl_semester_divition.DivitionName) as 'Sem/Div',
		CONCAT(tbl_semester_subject.SubjectCode,'(',tbl_semester_subject.SubjectType,')',' ',tbl_subject.SubjectName,' ',tbl_semester_subject.SubjectDescription) as Subject
	FROM
		tbl_faculty_subject_allocation
	INNER JOIN tbl_semester_subject ON tbl_faculty_subject_allocation.SemesterSubjectID = tbl_semester_subject.SemesterSubjectID
	INNER JOIN tbl_course_semester on tbl_semester_subject.CourseSemesterID=tbl_course_semester.CourseSemesterID
	inner join tbl_semester_divition on tbl_course_semester.SemesterDivitionID=tbl_semester_divition.SemesterDivitionID 
	INNER join tbl_subject on tbl_semester_subject.SubjectID=tbl_subject.SubjectID
INNER JOIN tbl_academicyear on tbl_course_semester.AcademicYearID=tbl_academicyear.AcademicYearID
INNER JOIN tbl_course on tbl_course_semester.CourseID=tbl_course.CourseID
INNER JOIN tbl_faculty on tbl_faculty_subject_allocation.FacultyID=tbl_faculty.FacultyID
	WHERE tbl_semester_subject.SubjectEndDate is null 
	and tbl_course_semester.SemesterEndDate is null
    and tbl_academicyear.AcademicYearID='".$_REQUEST["myAcademicYear"]."'
    and tbl_course.CourseID='".$_REQUEST['myCourse']."'
    and tbl_faculty.FacultyID='".$_REQUEST["myFaculty"]."';";
	
	}
	

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Table Manager Plugin Example</title>
	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<!-- Include Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Style -->

	<!-- <link rel="stylesheet" href="/Attendance/common/asset/dist/css/forms.css"> -->
	<style type="text/css">
		body {
			font-family: "Roboto Condensed", Helvetica, sans-serif;
			background-color: #f7f7f7;
		}
        
		.container {
            margin: 150px auto;
			max-width: 960px;
		}
        
		a {

            text-decoration: none;
		}
        
		table {
            width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
			margin-bottom: 20px;
		}
        
		table,
		th,
		td {
            border: 1px solid #bbb;
			text-align: left;
		}
        
		tr:nth-child(even) {
            background-color: #f2f2f2;
		}
        
		th {
            background-color: #ddd;
		}
        
		th,
		td {
            padding: 5px;
		}
        
		button {
            cursor: pointer;
		}
        
		/*Initial style sort*/
		.tablemanager th.sorterHeader {
            cursor: pointer;
		}
        
		.tablemanager th.sorterHeader:after {
            content: " \f0dc";
			font-family: "FontAwesome";
		}
        
		/*Style sort desc*/
		.tablemanager th.sortingDesc:after {
            content: " \f0dd";
			font-family: "FontAwesome";
		}
        
		/*Style sort asc*/
		.tablemanager th.sortingAsc:after {
            content: " \f0de";
			font-family: "FontAwesome";
		}
        
		/*Style disabled*/
		.tablemanager th.disableSort {}
        
		#for_numrows {
            padding: 10px;
			float: left;
		}
        
		#for_filter_by {
            padding: 10px;
			float: right;
		}
        
		#pagesControllers {
            display: block;
			text-align: center;
		}
        
		header a:link,header a:visited {
            background-color: #008CBA;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-left: 830px;
		}
        
		header a:hover,header a:active {
            background-color: red;
		}

		.button { /* Green */
            border: none;
            color: white;
            /* padding: 15px 32px; */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 32px;
            cursor: pointer;
        }
        </style>
        <link rel="stylesheet" href="/Attendance/common/asset/dist/css/forms.css">

</head>

<body>
<fieldset>
            <legend>Assign Subject to Staff(Faculty)</legend>
            <form method="POST">
                <table style="border: none;">
                    <tr>
                            <td style="border: none;">
                               <label>Academic Year</label>
                               
                               <select name="myAcademicYear" id="myacademicyear" onchange="myC()" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
							   <option value="">Select Value</option>
							   <?php
                                //     $q="SELECT
								// 	tbl_semester_subject.*,
								// 	tbl_subject.*,
								// 	tbl_course_semester.*,
								// 	tbl_academicyear.*,
								// 	tbl_course.*,
								// 	tbl_semester_divition.*
								// FROM
								// 	tbl_semester_subject
								// INNER JOIN tbl_course_semester ON tbl_semester_subject.CourseSemesterID = tbl_course_semester.CourseSemesterID
								// INNER JOIN tbl_subject ON tbl_semester_subject.SubjectID = tbl_subject.SubjectID
								// INNER JOIN tbl_academicyear ON tbl_course_semester.AcademicYearID = tbl_academicyear.AcademicYearID
								// INNER JOIN tbl_course ON tbl_course_semester.CourseID = tbl_course.CourseID
								// INNER JOIN tbl_semester_divition ON tbl_course_semester.SemesterDivitionID = tbl_semester_divition.SemesterDivitionID
								// WHERE
								// 	tbl_academicyear.AcademicYearEndAt IS NULL AND tbl_course_semester.SemesterEndDate IS NULL AND tbl_semester_subject.SubjectEndDate IS NULL;";
                                    $q="SELECT
											tbl_academicyear.*
										FROM
											tbl_academicyear where tbl_academicyear.AcademicYearEndAt IS NULL;";

									$rows = $user->query($q);
                    
                                    if ($rows->num_rows > 0) {
                                        foreach ($rows as $row) 
										{
											echo "<option value=".$row["AcademicYearID"].">".$row["AcademicYear"]."</option>";
                                        }
                                    } else {
                                        echo "<option value=\"\">no data found</option>";
                                    }
                               ?>    
                                    
                                    
                               </select>
                            </td>

                   </tr>
                   <tr>
                            <td style="border: none;">
                               <label>Course</label>
                               
                               <select  name="myCourse" id="mycourse" onchange="myF()" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
							   <option value="">Select Value</option>
                                   
                               </select>
                            </td>

                   </tr>
                   <tr>
                            <td style="border: none;">
                               <label>Employee Name</label>
                               
                               <select  name="myFaculty" id="myfaculty" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
                                   <option value="">Select Value</option>
                                   
                               </select>
                            	
                            </td>
                            
                            <!-- <td style="border: none;">
							<label> &nbsp;</label>
                               <select  name="myFacultyCourse" id="myfacultycourse" required style="padding :.5em !important; border:solid 1px #ccc !important; min-width: 100px !important; width: 215px !important;">
							   		<option value="">Select Value</option>
                               </select>
                            </td> -->

                   </tr>
                    
                     <tr>
                            <td style="border: none;">
                                <br>
                                <input  type="submit" name="mySubmit" value="Refresh" class="button" style="background-color: #4CAF50;padding: 13px 80px;"/>
                            </td>
                            <td style="border: none;">
                                <br>
                                 <a href="dashbord.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                            </td>
                        </tr>
                    
                </table>
            
        </fieldset>

	<div class="container">
		<header>
			<p>
			<h1>Allocated Subject</h1>
			<a href="addcourse.php"> + Add New</a>
			</p>
			<hr>
		</header>

		<!-- Table start -->
		<table class="tablemanager">
			<!--<thead>
				<tr>
					<th class="disableSort">Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date</th>
					<th>Points</th>
					<th class="disableFilterBy">Controls</th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
					<td>4</td>
					<td>Jill</td>
					<td>Smith</td>
					<td>11-11-1972</td>
					<td>50</td>
					<td><a href="">Edit</a></td>
				</tr>
                <th class=\"disableSort\">"."Rank"."</th>
                <th class=\"disableFilterBy\"> "."Score"."</th>
			</tbody> -->

		<?php
		
        $result=$con->query($data);

        if($result->num_rows > 0)
        {
			echo "<thead>
					<tr>
                    	<th>"."Sem/Div"."</th>
                    	<th>"."Subject"."</th>
                    	<th>"."Action"."</th>
                    </tr>
					</thead>"
            	;
			
			echo "<tbody>";
            foreach($result as $row)
            {
                
				echo "<tr>".
                        "<td>".$row['Sem/Div']."</td>".                              
                        "<td>".$row['Subject']."</td>".                              
                             
                        "<td>"."<a href=\"#.php\" class=\"button\" style=\"background-color: #4CAF50;padding:10px;margin:0px;\">Edit</a> <a href=\"#\" class=\"button\" style=\"background-color: #f44336; padding:10px; margin:0px;\">Delete</a> "."</td>".                                                           
                     "</tr>";
					
            }
			echo "</tbody>";
        }
        else
        {
            echo "<br> result 0";
        }?>
		</table>
		</form>
	</div>
	<script>
		function myC()
		{
			var x=new XMLHttpRequest();

			var academicYear=document.getElementById("myacademicyear").value;
			

			// var q="SELECT DISTINCT tbl_course.CourseID,tbl_course.CourseName FROM tbl_semester_subject INNER JOIN tbl_course_semester ON tbl_semester_subject.CourseSemesterID = tbl_course_semester.CourseSemesterID INNER JOIN tbl_subject ON tbl_semester_subject.SubjectID = tbl_subject.SubjectID INNER JOIN tbl_academicyear ON tbl_course_semester.AcademicYearID = tbl_academicyear.AcademicYearID INNER JOIN tbl_course ON tbl_course_semester.CourseID = tbl_course.CourseID INNER JOIN tbl_semester_divition ON tbl_course_semester.SemesterDivitionID = tbl_semester_divition.SemesterDivitionID WHERE tbl_academicyear.AcademicYearEndAt IS NULL AND tbl_course_semester.SemesterEndDate IS NULL AND tbl_semester_subject.SubjectEndDate IS NULL and tbl_academicyear.AcademicYearID='"+academicYear+"';";

			var q="SELECT DISTINCT tbl_course.CourseID,tbl_course.CourseName FROM tbl_course_semester inner join tbl_course on tbl_course_semester.CourseID = tbl_course.CourseID inner join tbl_academicyear on tbl_course_semester.AcademicYearID=tbl_academicyear.AcademicYearID where tbl_course_semester.SemesterEndDate IS NULL and tbl_academicyear.AcademicYearID='"+academicYear+"';"
			
			
			x.open("POST","data.php?v="+q,true);
			x.send();

			x.onreadystatechange=function()
			{
				if(x.readyState==4)
				{
					if(x.status==200)
					{
						document.getElementById("mycourse").innerHTML=x.responseText;
					}
				}
			}
		}

		function myF()
		{
			var x=new XMLHttpRequest();
			var academicYear=document.getElementById("myacademicyear").value;
			var course=document.getElementById("mycourse").value;
			
			var q="SELECT tbl_faculty.FacultyID,CONCAT(tbl_faculty.FacultyLname,' ',tbl_faculty.FacultyFname,' ',tbl_faculty.FacultyMname) FROM tbl_faculty INNER JOIN tbl_user ON tbl_faculty.UserID = tbl_user.UserID WHERE tbl_user.UserStatus = 1 AND tbl_user.UserDeletedAt IS NULL AND tbl_faculty.FacultyCourseID = ANY(SELECT tbl_course.CourseID FROM tbl_course_semester INNER JOIN tbl_course on tbl_course_semester.CourseID=tbl_course.CourseID INNER JOIN tbl_academicyear ON tbl_course_semester.AcademicYearID=tbl_academicyear.AcademicYearID WHERE tbl_course.CourseID='"+course+"' and tbl_academicyear.AcademicYearID='"+academicYear+"');";

			x.open("POST","data.php?v="+q,true);
			x.send();

			x.onreadystatechange=function()
			{
				if(x.readyState==4)
				{
					if(x.status==200)
					{
						document.getElementById("myfaculty").innerHTML=x.responseText;
					}
				}
			}
		}

		// function myFc()
		// {
		// 	var academicYear=document.getElementById("myacademicyear").value;
		// 	var course=document.getElementById("mycourse").value;
		// 	var facluty=document.getElementById("myfaculty").value;
		// 	alert(academicYear+" "+course+" "+facluty);
		// }

		// function myFc()
		// {
		// 	var x=new XMLHttpRequest();

		// 	var faculty=document.getElementById("myfaculty").value;

		// 	var q="SELECT tbl_course.CourseID,tbl_course.CourseName FROM tbl_faculty_subject_allocation INNER JOIN tbl_faculty ON tbl_faculty_subject_allocation.FacultyID=tbl_faculty.FacultyID INNER JOIN tbl_user on tbl_faculty.UserID=tbl_user.UserID INNER JOIN tbl_semester_subject on tbl_faculty_subject_allocation.SemesterSubjectID=tbl_semester_subject.SemesterSubjectID INNER join tbl_course_semester on tbl_semester_subject.CourseSemesterID=tbl_course_semester.CourseSemesterID INNER JOIN tbl_course on tbl_course_semester.CourseID=tbl_course.CourseID WHERE  tbl_faculty_subject_allocation.SemesterEndDate is null and tbl_user.UserStatus=1 and tbl_user.UserDeletedAt is null and tbl_semester_subject.SubjectEndDate is null and tbl_course_semester.SemesterEndDate is null and tbl_faculty.FacultyID='"+faculty+"';";

		// 	x.open("POST","data.php?v="+q,true);
		// 	x.send();

		// 	x.onreadystatechange=function()
		// 	{
		// 		if(x.readyState==4)
		// 		{
		// 			if(x.status==200)
		// 			{
		// 				document.getElementById("myfacultycourse").innerHTML=x.responseText;
		// 			}
		// 		}
		// 	}
		// }
	</script>
	<!-- External jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="./js/jquery-1.12.3.min.js"></script> -->
	<script type="text/javascript" src="/Attendance/common/asset/dist/js/tableManager.js"></script>
	
	<script type="text/javascript">
		// basic usage
		$('.tablemanager').tablemanager({

			firstSort: [[1, 'asc'], [2, 'asc'],[3, 0]],
			disable: ["last"],
			appendFilterby: true,
			dateFormat: [[4, "mm-dd-yyyy"]],
			debug: true,
			vocabulary: {
				voc_filter_by: 'Filter By',
				voc_type_here_filter: 'Filter...',
				voc_show_rows: 'Rows Per Page'
			},
			pagination: true,
			showrows: [5, 10, 20, 50, 100],
			disableFilterBy: []
		});
		// $('.tablemanager').tablemanager();
	</script>
	<script>
		try {
			fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function (response) {
				return true;
			}).catch(function (e) {
				var carbonScript = document.createElement("script");
				carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
				carbonScript.id = "_carbonads_js";
				document.getElementById("carbon-block").appendChild(carbonScript);
			});
		} catch (error) {
			console.log(error);
		}
	</script>
	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-36251023-1']);
		_gaq.push(['_setDomainName', 'jqueryscript.net']);
		_gaq.push(['_trackPageview']);

		(function () {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>
</body>

</html>