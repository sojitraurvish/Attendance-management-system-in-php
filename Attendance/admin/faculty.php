<!-- https://www.jqueryscript.net/blog/best-table-pagination.html -->
<?php
	session_start();
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

</head>

<body>
	<div class="container">
		<header>
			<p>
			<h1>Faculty</h1>
			<a href="addfaculty.php"> + Add New</a>
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
			$q="SELECT
					tbl_user.*,
					tbl_faculty.FacultyFname,
					tbl_faculty.FacultyMname,
					tbl_faculty.FacultyLname,
					tbl_faculty.FacultyPhoto,
					tbl_faculty.FacultyGender,
					tbl_faculty.FacultyDOB,
					tbl_faculty.FacultylLocalAddress,
					tbl_faculty.FacultyPermenantAddress,
					tbl_faculty.FacultyCast,
					tbl_faculty.FacultySubCast,
					tbl_faculty.FacultyBloodGroup,
					tbl_faculty.FacultyEmail,
					tbl_faculty.FacultyContactNo,
					tbl_state.*,
					tbl_city.*,
					tbl_faculty.FacultyMaritalStatus,
					tbl_faculty.FacultySpouse,
					tbl_faculty.FacultyDisablity,
					tbl_faculty.FacultyAadharcardNo,
					tbl_faculty.FacultyHighestQulification,
					tbl_academicyear.*,
					tbl_course.*
				FROM
					tbl_faculty
				INNER JOIN tbl_user ON tbl_faculty.UserID = tbl_user.UserID
				INNER JOIN tbl_city ON tbl_faculty.FacultyStateCityID = tbl_city.CityID
				INNER JOIN tbl_state ON tbl_city.CityID = tbl_state.StateID
				INNER join tbl_academicyear on tbl_academicyear.AcademicYearID=tbl_faculty.AcademicYearID
				INNER JOIN tbl_course on tbl_course.CourseID=tbl_faculty.FacultyCourseID
				WHERE
					tbl_user.UserDeletedAt IS NULL;";
        $result=$con->query($q);

        if($result->num_rows > 0)
        {
			echo "<thead>
					<tr>
                    	<th>"."Username"."</th>
                    	<th>"."UserStatus"."</th>
                    	<th>"."Userjoin"."</th>
                    	<th>"."FacultyName"."</th>
                    	<th>"."FacultyPhoto"."</th>
                    	<th>"."FacultyGender"."</th>
                    	<th>"."FacultyDOB"."</th>                        
                    	<th>"."FacultylLocalAddress"."</th>                        
                    	<th>"."FacultyPermenantAddress"."</th>                        
                    	<th>"."FacultyCast"."</th>                        
                    	<th>"."FacultySubCast"."</th>                        
                    	<th>"."FacultyBloodGroup"."</th>                        
                    	<th>"."FacultyEmail"."</th>                        
                    	<th>"."FacultyContactNo"."</th>                        
                    	<th>"."FacultyState"."</th>                        
                    	<th>"."FacultyCity"."</th>                        
                    	<th>"."FacultyMaritalStatus"."</th>                        
                    	<th>"."FacultySpouse"."</th>                        
                    	<th>"."FacultyDisablity"."</th>                                               
                    	<th>"."FacultyAadharcardNo"."</th>                        
                    	<th>"."FacultyHighestQulification"."</th>                        
                    	<th>"."AcademicYearID"."</th>                        
                    	<th>"."FacultyCourseID"."</th>                        
                    	<th>"."Action"."</th>                        

                    </tr>
					</thead>"
            	;
			
			echo "<tbody>";
            foreach($result as $row)
            {
                

				echo "<tr>".
						"<td>".$row["Username"]."</td>";

				if($row["UserStatus"]==1)
				{
					$q="update tbl_user set UserStatus='0' where UserID='".$row["UserID"]."'";
					echo "<td><button href=\"#\" class=\"button\" style=\"background-color: #a6ffa9;padding:5px;margin:0px;\" disabled>Active</button>"
							."<a href=\"activedeactive.php?v=".$q."\" class=\"button\" style=\"background-color: #f44336; padding:5px; margin:0px;\">Deactive</a></td>";
				}		
				else
				{
					$q="update tbl_user set UserStatus='1' where UserID='".$row["UserID"]."'";
					echo "<td><a href=\"activedeactive.php?v=".$q."\" class=\"button\" style=\"background-color: #4CAF50;padding:5px;margin:0px;\">Active</a>"
							."<button href=\"#\" class=\"button\" style=\"background-color: #ffaea8; padding:5px; margin:0px;\" disabled>Deactive</button></td>";
				}

				echo	"<td>".$row["UserCreatedAt"]."</td>".
						"<td>".$row["FacultyLname"]." ".$row["FacultyFname"]." ".$row["FacultyMname"]."</td>".
						"<td><img width=\"100%\" height=\"100%\" src=\"".$row["FacultyPhoto"]."\" alt=\"Italian Trulli\"></td>".
						"<td>".$row["FacultyGender"]."</td>".
						"<td>".$row["FacultyDOB"]."</td>".                        
						"<td>".$row["FacultylLocalAddress"]."</td>".                        
						"<td>".$row["FacultyPermenantAddress"]."</td>".                        
						"<td>".$row["FacultyCast"]."</td>".                        
						"<td>".$row["FacultySubCast"]."</td>".                        
						"<td>".$row["FacultyBloodGroup"]."</td>".                        
						"<td>".$row["FacultyEmail"]."</td>".                        
						"<td>".$row["FacultyContactNo"]."</td>".                        
						"<td>".$row["StateName"]."</td>".                        
						"<td>".$row["CityName"]."</td>".                        
						"<td>".$row["FacultyMaritalStatus"]."</td>".                        
						"<td>".$row["FacultySpouse"]."</td>".                        
						"<td>".$row["FacultyDisablity"]."</td>".                                               
						"<td>".$row["FacultyAadharcardNo"]."</td>".                        
						"<td>".$row["FacultyHighestQulification"]."</td>".                        
						"<td>".$row["AcademicYear"]."</td>".                        
						"<td>".$row["CourseName"]."</td>".
                        "<td>"."<a href=\"editfaculty.php?v=".$row["UserID"]."\" class=\"button\" style=\"background-color: #4CAF50;padding:10px;margin:0px;\">Edit</a> <a href=\"deletefaculty.php?v=".$row["UserID"]."\" class=\"button\" style=\"background-color: #f44336; padding:10px; margin:0px; \">Delete</a> "."</td>".                
                     "</tr>";
					
            }
			echo "</tbody>";
        }
        else
        {
            echo "<br> result 0";
        }?>
		</table>

	</div>
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
<!-- https://www.jqueryscript.net/blog/best-table-pagination.html -->
