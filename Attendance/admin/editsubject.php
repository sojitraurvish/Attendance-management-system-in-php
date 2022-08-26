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

    $q = "update tbl_subject set SubjectName='" . $_POST["mySubjectName"] . "' where SubjectID='".$user->decrypt($_REQUEST['SubjectID'])."'";

    if ($con->query($q) == true) {
        echo "data inserted successfully";
?>
        <script>
            location.replace("subject.php");
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
        <legend>Update Subject</legend>

        <form method="post" name="Subject">
            <table>
                <?php
                if ($_REQUEST['SubjectID']) {
                    /*$name=$_POST["myName"];
                            $email=$_POST["myEmail"];
                            $gender=$_POST["myGender"];*/
                    $q = "select * from tbl_subject where SubjectID='" . $user->decrypt($_REQUEST['SubjectID']) . "'";

                    $rows = $con->query($q);

                    if ($rows->num_rows > 0) {
                        foreach ($rows as $row) {
                ?>
                            <tr>
                                <td>
                                    <label>Subject Name</label>
                                    <?php echo "<input type=\"text\" name=\"mySubjectName\" value=\"".$row["SubjectName"]."\" pattern=\"[a-zA-Z]{3,50}\" maxlength=\"50\" required />";?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <br>
                                    <input type="submit" name="mySubmit" value="Submit" class="button" style="background-color: #4CAF50;padding: 13px 80px;" />
                                </td>
                                <td>
                                    <br>
                                    <a href="subject.php" class="button" style="background-color: #f44336; padding: 13px 80px;">Cancel</a>
                                </td>
                            </tr>
                <?php
                        }
                    } else {
                        header("location:subject.php");
                        echo "no data found";
                    }
                } else {
                    header("location:subject.php");
                    echo "query string not set";
                }
                ?>
            </table>
        </form>
    </fieldset>

</body>

</html>