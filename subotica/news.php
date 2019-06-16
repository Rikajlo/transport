<?php
include_once("db_config.php");
include_once("functions.php");


// News page, all news can be also seen in the newsfeed.php page, without any surrounding menus.
?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("meta/meta.php");?>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
    <title>Vesti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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


</body>
</html>






