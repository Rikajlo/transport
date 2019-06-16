<?php
include_once("db_config.php");
include_once("functions.php");


// News page, all news can be also seen in the newsfeed.php page, without any surrounding menus.
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once("include/meta.php");?>

    <title>Vesti</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
    <link rel="stylesheet" href="../css/bootstrap.css" />

</head>
<body>

<?php include_once("menu.php");?>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-3 content1-left">
            <?php
            include("sidemenu.php");
            getScheduleDate();
            ?>
        </div>
        <div class="col-sm-9 content1-right" style="min-height: 100%; text-align: left">
            <?php
            if (isset($_GET['newsid']))
                include("shownews.php");
            else
                include("newsfeed.php");
            ?>
        </div>
    </div>
</div>

<?php include_once 'include/footer.php'; ?>





