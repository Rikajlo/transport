<?php
include_once ('../db_config.php');


@$lineid = stripslashes($_POST['lineid']);
@$lineid = mysqli_real_escape_string($con,$lineid);

@$lineshort = stripslashes($_POST['lineshort']);
@$lineshort = mysqli_real_escape_string($con,$lineshort);


@$linename = stripslashes($_POST['linename']);
@$linename = mysqli_real_escape_string($con,$linename);

@$linedir = stripslashes($_POST['linedir']);
@$linedir = mysqli_real_escape_string($con,$linedir);

@$linetext = stripslashes($_POST['linetext']);
@$linetext = mysqli_real_escape_string($con,$linetext);

@$lineside = stripslashes($_POST['lineside']);
@$lineside = mysqli_real_escape_string($con,$lineside);





if(empty($_POST['edit'])) {

    $lineexists=0;
    $sql = "SELECT * FROM buslines WHERE ID_Line=$lineid LIMIT 1;";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $lineexists=1;
        }
    }
    if(!$lineexists) {
        $sql = "INSERT INTO `buslines`(`ID_Line`, `Line_ShortName`, `Line_Name`, `Line_Direction`, `Line_Text`, `Line_Side`)
VALUES  ('$lineid','$lineshort','$linename','$linedir','$linetext','$lineside')";

        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    }
} else {
    $sql = "UPDATE buslines SET Line_ShortName='$lineshort' ,Line_Name='$linename' ,Line_Direction='$linedir'
 ,Line_Text='$linetext' ,Line_Side='$lineside'
        WHERE ID_Line=$lineid";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

}

header("Location: list_buslines.php");
exit();

?>