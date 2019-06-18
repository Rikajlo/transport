<?php
include_once ('../db_config.php');


@$newstitle = stripslashes($_POST['newstitle']);
@$newstitle = mysqli_real_escape_string($con,$newstitle);

@$newsshort = stripslashes($_POST['newsshort']);
@$newsshort = mysqli_real_escape_string($con,$newsshort);


@$newsfull = stripslashes($_POST['newsfull']);
@$newsfull = mysqli_real_escape_string($con,$newsfull);

@$time_expires = stripslashes($_POST['time_expires']);
@$time_expires = mysqli_real_escape_string($con,$time_expires);

@$showlines = stripslashes($_POST['showlines']);
@$showlines = mysqli_real_escape_string($con,$showlines);

@$showstops = stripslashes($_POST['showstops']);
@$showstops = mysqli_real_escape_string($con,$showstops);

@$showall = stripslashes($_POST['showall']);
@$showall = mysqli_real_escape_string($con,$showall);

@$newsid = stripslashes($_POST['newsid']);
@$newsid = mysqli_real_escape_string($con,$newsid);



if(empty($_POST['edit'])) {
    $sql = "INSERT INTO busnews(News_Title, News_Short, News_Full, Time_Expires, Show_Lines, Show_Stops, Show_All) 
VALUES ('$newstitle','$newsshort','$newsfull','$time_expires','$showlines','$showstops',$showall)";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

} else {
    $sql = "UPDATE busnews SET News_Title='$newstitle' ,News_Short='$newsshort' ,News_Full='$newsfull' ,Show_All=$showall
 ,Show_Lines='$showlines' ,Show_Stops='$showstops', Time_Expires='$time_expires'
        WHERE ID_News=$newsid";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

}

header("Location: list_news.php");
exit();

?>