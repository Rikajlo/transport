<?php
include_once("db_config.php");
include_once("menu.php");

// News page, all news can be also seen in the newsfeed.php page, without any surrounding menus.
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <META NAME="author" CONTENT="Martin Kiš, Daniel Ištvan">
    <META NAME="Description" CONTENT="Stajališni red vožnje na teritoriji grada Subotica, unesite naziv željene stanice i saznajte za koliko minuta stiže sledeći autobus.">
    <META NAME="Keywords" CONTENT="javni prevoz, gradski saobracaj, subotica, linija, autobus, stajaliste, stanica, javni prevoz u subotici">
    <META NAME="Geography" CONTENT="Subotica, Serbia">
    <META NAME="Language" CONTENT="Serbian">
    <META NAME="distribution" CONTENT="Global">
    <META NAME="Robots" CONTENT="INDEX,FOLLOW">
    <META NAME="zipcode" CONTENT="24000">
    <META NAME="city" CONTENT="Subotica">
    <META NAME="country" CONTENT="Serbia">

    <title>Vesti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

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


</body>
</html>






