<?php
include("db_config.php");

// Inserts values into favouritestops table if not exists and redirects to the previous page.
// THIS FILE IS FINISHED AND NEEDS NO FURTHER EDITING.

$postUserID = stripslashes($_POST['UserID']);
$postUserID = mysqli_real_escape_string($con,$postUserID);
$postStopID = stripslashes($_POST['StopID']);
$postStopID = mysqli_real_escape_string($con,$postStopID);

$sql= "SELECT FROM favouritestops WHERE ID_User=$postUserID AND ID_Stop=$postUserID";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo 'NO.';
} else {

    $sql= "INSERT INTO favouritestops (ID_User, ID_Line) VALUES (\"$postUserID\", \"$postLineID\");";

    $result = mysqli_query($con, $sql);
}


header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
