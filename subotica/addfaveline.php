<?php
include("db_config.php");
@session_start();

// Inserts values into favouritelines table if not exists, and redirects to the previous page.
// THIS FILE IS FINISHED AND NEEDS NO FURTHER EDITING.


@$postUserID = stripslashes(@$_SESSION['ID_User']);
@$postUserID = mysqli_real_escape_string($con,@$postUserID);
@$postLineID = stripslashes(@$_REQUEST['addLine']);
@$postLineID = mysqli_real_escape_string($con,@$postLineID);

@$delLineID = stripslashes(@$_GET['LineID']);
if(isset($_GET["delline"])){
    $sql= "DELETE FROM favouritelines WHERE ID_User=$postUserID AND ID_Line=$delLineID";
    $result = mysqli_query($con, $sql);
}

if(isset($postLineID) AND isset($postUserID)) {
    $sql = "SELECT * FROM favouritelines WHERE ID_User=$postUserID AND ID_Line=$postLineID";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo 'NO.';
    } else {

        $sql = "INSERT INTO `favouritelines` (ID_User, ID_Line) VALUES (\"$postUserID\", \"$postLineID\");";

        $result = mysqli_query($con, $sql);
    }
}


header('Location: ' . $_SERVER['HTTP_REFERER']);

?>