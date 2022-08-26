<?php
if (!session_start()) {
    session_start();
}
include __DIR__ . '/../database/user.php';
$user = new User();
$con = $user->connection();

$rows = $user->checkUserExistanceForAllPage($_SESSION["username"], $_SESSION["password"], $_SESSION["usertype"]);

if ($rows->num_rows > 0) {
    include 'header.php';
} else {
    echo "result 0";
    header("location:/Attendance/index.php");
}

if (isset($_POST["mySubmit"])) {

    $q = "update tbl_semester_divition set SemesterName='" . $_POST["mySemesterName"] . "',DivitionName='" . $_POST["myDivisionName"] . "' where SemesterDivitionID='".$user->decrypt($_REQUEST['SemesterDivitionID'])."' ";

    if ($con->query($q) == true) {
        echo "data inserted successfully";

?>
        <script>
            location.replace("semesterdivition.php");
        </script>
<?php
    } else {
        echo "<br> Error:" . $con->error;
    }
}

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/Attendance/common/asset/dist/css/forms.css">
</head>

<body>
    <fieldset>
        <legend>Update SemesterDivition</legend>

        <form method="post" name="SemDiv">
            <table>
                <?php
                if ($_REQUEST['SemesterDivitionID']) {
                    /*$name=$_POST["myName"];
                            $email=$_POST["myEmail"];
                            $gender=$_POST["myGender"];*/
                    $q = "select * from tbl_semester_divition where SemesterDivitionID='" . $user->decrypt($_REQUEST['SemesterDivitionID']) . "'";

                    $rows = $con->query($q);

                    if ($rows->num_rows > 0) {
                        foreach ($rows as $row) {
                ?>
                            <tr>
                                <td>
                                    <label>Semester Name</label>
                                    <?php echo "<input type=\"text\" name=\"mySemesterName\" value=\"" . $row["SemesterName"] . "\" pattern=\"[0-9]{1}[0-2]{0,1}\" size=\"2\" maxlength=\"2\" title=\"Enter Integer only And It must be <= 12\" required />"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Division Name</label>
                                    <?php echo "<input type=\"text\" name=\"myDivisionName\" value=\"" . $row["DivitionName"] . "\" pattern=\"[A-Z0-9]{1,2}\" size=\"2\" maxlength=\"2\" title=\"Letter-Number like A1 or A and Letter should be upper case\" required />"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <input type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px;" />
                                </td>
                                <td>
                                    <br>
                                    <a href="semesterdivition.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                                </td>
                            </tr>

                <?php
                        }
                    } else {
                        header("location:course.php");
                        echo "no data found";
                    }
                } else {
                    header("location:course.php");
                    echo "query string not set";
                }
                ?>

            </table>
        </form>
    </fieldset>

</body>

</html>