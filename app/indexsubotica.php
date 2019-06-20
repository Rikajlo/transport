<?php

include_once('sudb.php');
include_once('notify.php');

@session_start();

if(!isset($_SESSION['isadminsubotica'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notifications - Subotica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>

<div class="container-fluid">
    <h4>Chose option:</h4>
    <br />
    <div class="row">
        <a href="notifysubotica.php" class="col-6"><i class="far fa-plus-square fa-5x"></i></a>
        <a href="shownotifysubotica.php" class="col-6"><i class="fas fa-list fa-5x"></i></a>
        <p class="col-6"><i>Post news</i></p>
        <p class="col-6"><i>See news</i></p>
    </div>
    <br />
    <a class="btn btn-primary" href="index.php">Returnt to index</a>
</div>
<?php include_once("footer.php") ?>
</body>
</html>