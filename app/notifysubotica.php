<?php
include_once('sudb.php');
include_once('notify.php');

@session_start();

if(!isset($_SESSION['isadminsubotica'])){
exit();
}

@$newstitle = stripslashes($_POST['newstitle']);
@$newstitle = mysqli_real_escape_string($con,$newstitle);

@$newsshort = stripslashes($_POST['newsshort']);
@$newsshort = mysqli_real_escape_string($con,$newsshort);

@$newsimage = stripslashes($_POST['newsimage']);
@$newsimage = mysqli_real_escape_string($con,$newsimage);


if(!empty($_POST['newstitle']) and !empty($_POST['newsshort'])) {
$sql = "INSERT INTO notifications(News_Title, News_Short, News_Image, View_Count)
VALUES ('$newstitle','$newsshort','$newsimage',0)";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$sql2 = "SELECT max(ID_Notification) as test FROM notifications LIMIT 1 ";
$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
if (mysqli_num_rows($result2) > 0) {
while ($record = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
$id=$record['test'];

}}
if($result2){

echo "Posted";
$oneSignalConfig = array(
'app_id' => '76989cdc-dba6-4b47-ae6e-5c036549d35f', // replace with your app_id
'app_rest_api_key' => 'OTVmODljNDctYjgzYS00N2E3LTk3ZTEtNmZhZjVhMDBiZTdi', // replace with your app_rest_api_key
'title' => $newstitle,
'brief' => $newsshort,
'url' => 'http://chocolatefor.me/transport/subotica/notification.php?id='.$id.'#notif', // URL of the page/post that you're pushing for
'image_url' => $newsimage,
'logo_url' => 'http://www.gradsubotica.co.rs/wp-content/uploads/2015/07/suboticatrans.jpg', // logo of the company/website
);



// now do the call
osAddPush($oneSignalConfig);
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notifications - Subotica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>

<div class="container">
    <h2>Make a notification</h2>
    <p>Subotica</p>
    <form class="form-horizontal" name="addnotif" action="" method="post">
        <div class="form-group">
            <label for="newstitle">Title:</label>
            <input type="text" class="form-control" id="newstitle" required="required" placeholder="Enter title" name="newstitle">
        </div>
        <div class="form-group">
            <label for="newsshort">Notification:</label>
            <input type="text" class="form-control" id="newsshort" placeholder="Enter notification" name="newsshort">
        </div>
        <div class="form-group">
            <label for="newsimage">Image:</label>
            <input type="text" class="form-control" id="newsimage" placeholder="Enter image url" name="newsimage">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button> &nbsp
        <a class="btn btn-primary" href="indexsubotica.php">Returnt</a>

    </form>
</div>
<?php include_once("footer.php") ?>
</body>
</html>

