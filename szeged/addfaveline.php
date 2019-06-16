<?php
include("db_config.php");

// Inserts values into favouritelines table if not exists, and redirects to the previous page.
// THIS FILE IS FINISHED AND NEEDS NO FURTHER EDITING.


$postUserID = stripslashes($_SESSION['UserID']);
$postUserID = mysqli_real_escape_string($con,$postUserID);
$postLineID = stripslashes($_POST['LineID']);
$postLineID = mysqli_real_escape_string($con,$postLineID);

$delLineID = stripslashes($_GET['LineID']);
if(isset($_POST["delline"])){
    $sql= "DELETE FROM favouritelines WHERE ID_User=$postUserID AND ID_Line=$postUserID";
    $result = mysqli_query($con, $sql);
}
$sql= "SELECT FROM favouritelines WHERE ID_User=$postUserID AND ID_Line=$postUserID";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo 'NO.';
    } else {

$sql= "INSERT INTO `favouritelines` (ID_User, ID_Line) VALUES (\"$postUserID\", \"$postLineID\");";

$result = mysqli_query($con, $sql);
}


header('Location: ' . $_SERVER['HTTP_REFERER']);

?>