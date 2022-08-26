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
	</style>
</head>

<body>
	<div class="container">
		<header>
			<p>
			<h1>Student</h1>
			<a href="addstudent.php"> + Add New</a>
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
		
        $result=$user->tbl_student();

        if($result->num_rows > 0)
        {
			echo "<thead>
					<tr>

                    	<th>"."Username"."</th>
                    	<th>"."Usertype"."</th>
                    	<th>"."UserStatus"."</th>
                    	<th>"."UserCreatedAt"."</th>
                    	<th>"."StudentEnrollmentNo"."</th>
                    	<th>"."StudentName"."</th>                                                
                    	<th>"."StudentPhoto"."</th>                        
                    	<th>"."StudentGender"."</th>                        
                    	<th>"."StudentDOB"."</th>
						<th>"."StudentLocalAddress"."</th>
						<th>"."StudentPermanentAddress"."</th>
						<th>"."StudentFatherName"."</th>
						<th>"."StudentFatherContactNo "."</th>
						<th>"."StudentMotherName "."</th>
						<th>"."StudentMotherContactNo  "."</th>
						<th>"."StudentCast  "."</th>
						<th>"."StudentSubCast  "."</th>
						<th>"."StudentBloodGroup  "."</th>
						<th>"."StudentEmail   "."</th>
						<th>"."StudentContactNo  "."</th>
						<th>"."StudentStateCityID "."</th>
						<th>"."StudentAadharcardNo  "."</th>
						<th>"."StudentHighestQulification "."</th>
						<th>"."EnrollYear "."</th>
						<th>"."AcademicYearID "."</th>
						<th>"."CourseSemesterID  "."</th>
						<th>"."Action"."</th>  

						                        

                    </tr>
					</thead>"
            	;
			
			echo "<tbody>";
            foreach($result as $row)
            {
                
				echo "<tr>".                             
                        "<td>".$row['Username']."</td>".                                                            
                        "<td>".$row['Usertype']."</td>".                              
                        "<td>".$row['UserStatus']."</td>".                              
                        "<td>".$row['UserCreatedAt']."</td>".                                                        
                        "<td>".$row['StudentEnrollmentNo']."</td>".                              
						"<td>".$row["StudentLname"]." ".$row["StudentFname"]." ".$row["StudentMname"]."</td>".
                        "<td><img width=\"100%\" height=\"100%\" src=\"".$row["StudentPhoto"]."\" alt=\"Italian Trulli\"></td>".                              
                        "<td>".$row['StudentGender']."</td>".                              
                        "<td>".$row['StudentDOB']."</td>".                              
                        "<td>".$row['StudentLocalAddress']."</td>".                              
                        "<td>".$row['StudentPermanentAddress']."</td>".                              
                        "<td>".$row['StudentFatherName']."</td>".                              
                        "<td>".$row['StudentFatherContactNo']."</td>".                              
                        "<td>".$row['StudentMotherName']."</td>".                              
                        "<td>".$row['StudentMotherContactNo']."</td>".                              
                        "<td>".$row['StudentCast']."</td>".                              
                        "<td>".$row['StudentSubCast']."</td>".                              
                        "<td>".$row['StudentBloodGroup']."</td>".                              
                        "<td>".$row['StudentEmail']."</td>".                              
                        "<td>".$row['StudentContactNo']."</td>".                              
                        "<td>".$row['StudentStateCityID']."</td>".                              
                        "<td>".$row['StudentAadharcardNo']."</td>".                              
                        "<td>".$row['StudentHighestQulification']."</td>".                              
                        "<td>".$row['EnrollYear']."</td>".                              
                        "<td>".$row['AcademicYearID']."</td>".                              
                        "<td>".$row['CourseSemesterID']."</td>".                              
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