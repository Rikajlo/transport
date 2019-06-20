<?php

include_once('szedb.php');
include_once('notify.php');

@session_start();

if(!isset($_SESSION['isadminszeged'])){
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notifications - szeged</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
    <?php
    if(!isset($_GET["notifid"])){
    ?>
    <table class="table table-responsive">
        <tr>
            <th>Notification title</th>
            <th>Views</th>
        </tr>
        <?php
        $sql = "SELECT * from notifications";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>
                    <td><a href="shownotifyszeged.php?notifid=' . $record['ID_Notification'] . '">' . $record['News_Title'] . '</a></td>
                    <td><p class="text-center">' . $record['View_Count'] . '</p></td>
                    </tr>';
            }
        }
        echo '</table>
        <a class="btn btn-primary" href="indexszeged.php">Returnt</a>';
        } else {
        ?>
        <div class="row">
            <?php
            $notifyid = $_GET["notifid"];
            $sql = "SELECT * FROM notifications WHERE ID_Notification=$notifyid";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '
                      <div class="col-12"><h5 class="font-weight-bold">Title:</h5><p>' . $record['News_Title'] . '</p></div>
                      <div class="col-12"><h5 class="font-weight-bold">Message:</h5><p>' . $record['News_Short'] . '</p></div>
                      <div class="col-12"><h5 class="font-weight-bold">Image:</h5><img class="img-fluid" src="' . $record['News_Image'] . '" alt="/"/></div>
                      <div class="col-12"><h5 class="font-weight-bold">Date:</h5><p>' . $record['Date_Published'] . '</p></div>
                    ';

                    $sqla = "SELECT UA_String FROM notifview WHERE ID_Notification=$notifyid";
                    $resulta = mysqli_query($con, $sqla) or die(mysqli_error($con));

                    if (mysqli_num_rows($resulta) > 0) {
                        echo '<div class="col-12"><h5>User-Agent string:</h5><table class="table table-responsive">';
                        while ($recorda = mysqli_fetch_array($resulta, MYSQLI_ASSOC)) {
                            echo '<tr><td>' . $recorda['UA_String'] . '</td></tr>';
                        }
                        echo '</table></div>';
                    }

                }
            }
            echo '</div>
        <a class="btn btn-primary" href="shownotifyszeged.php">Returnt</a>';
            }
            ?>
        </div>
        <?php include_once("footer.php") ?>
</body>
</html>

