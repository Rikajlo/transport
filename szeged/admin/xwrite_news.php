<?php
@session_start();
include_once('auth.php');
include_once ('../db_config.php');
include_once ('../include/notify.php');


@$newstitle = stripslashes($_POST['newstitle']);
@$newstitle = mysqli_real_escape_string($con,$newstitle);

@$newsshort = stripslashes($_POST['newsshort']);
@$newsshort = mysqli_real_escape_string($con,$newsshort);


@$newsfull = stripslashes($_POST['newsfull']);
@$newsfull = mysqli_real_escape_string($con,$newsfull);

@$time_expires = stripslashes($_POST['timeexpires']);
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

    if($result){
        $oneSignalConfig = array(
            'app_id' => '76989cdc-dba6-4b47-ae6e-5c036549d35f', // replace with your app_id
            'app_rest_api_key' => 'OTVmODljNDctYjgzYS00N2E3LTk3ZTEtNmZhZjVhMDBiZTdi', // replace with your app_rest_api_key
            'title' => $newstitle,
            'brief' => $newsfull,
            'url' => 'http://chocolatefor.me/transport/szeged/news.php', // URL of the page/post that you're pushing for
            'image_url' => '',
            'logo_url' => 'http://iho.hu/media/indomedia/cikkfoto/2011/02/110220_szeged/1950_7_070520.jpg', // logo of the company/website
        );

// now do the call
        osAddPush($oneSignalConfig);
    }

} else {
    $sql = "UPDATE busnews SET News_Title='$newstitle' ,News_Short='$newsshort' ,News_Full='$newsfull' ,Show_All=$showall
 ,Show_Lines='$showlines' ,Show_Stops='$showstops', Time_Expires='$time_expires'
        WHERE ID_News=$newsid";

    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

}

header("Location: list_news.php");
exit();

?>