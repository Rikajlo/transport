
<?php
include("db_config.php");
@session_start();

// Inserts values into favouritestops table if not exists, and redirects to the previous page.
// THIS FILE IS FINISHED AND NEEDS NO FURTHER EDITING.


@$postUserID = stripslashes(@$_SESSION['ID_User']);
@$postUserID = mysqli_real_escape_string($con,@$postUserID);
@$postStopID = stripslashes(@$_REQUEST['StopID']);
@$postStopID = mysqli_real_escape_string($con,@$postStopID);

@$delStopID = stripslashes(@$_GET['stopID']);
if(isset($_GET["delstop"])){

    $sql= "DELETE FROM favouritestops WHERE ID_User=$postUserID AND ID_Stop=$delStopID";

    $result = mysqli_query($con, $sql);
}

if(isset($postStopID) AND isset($postUserID)) {
    $sql = "SELECT * FROM favouritestops WHERE ID_User=$postUserID AND ID_Stop=$postStopID";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo 'NO.';
    } else {

        $sql = "INSERT INTO `favouritestops` (ID_User, ID_Stop) VALUES (\"$postUserID\", \"$postStopID\");";
        $result = mysqli_query($con, $sql);
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
