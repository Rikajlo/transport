<?php
//include auth.php file on all secure pages
include_once("db_config.php");
include_once("menu.php");
include_once("adminfunctions.php");

if ($_SESSION['isadmin']!=true){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/newest.css" />


</head>
<body>
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-3 content1-left">
            <?php
            include("sidebar.php")
            ?>
        </div>
        <div class="col-sm-9 content1-right" style="min-height: 100%;">
            <h3>Dodaj novu liniju:</h3>
            <div>
                <form class="w3-container" name="addline" action="addline.php" method="post">
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label class="w3-text-teal"><b>ID Linije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="lineid" placeholder="ID_Line"/>
                            <label class="w3-text-teal"><b>Kod Linije:</b></label>

                            <input class="w3-input w3-border w3-light-grey" type="text" name="lineshort" placeholder="Line_ShortName"/>
                            <label class="w3-text-teal"><b>Naziv Linije:</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="linename" placeholder="Line_Name"/><br/>
                            <label class="w3-text-teal"><b>Smer Linije:</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="linedir" placeholder="Line_Direction"/>
                            <label class="w3-text-teal"><b>Tekst u redu vožnje:</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="linetext" placeholder="Line_Text"/>
                            <label class="w3-text-teal"><b>Strana 0 ili 1</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="lineside" placeholder="Line_Side"/><br/><br/>
                    <button type="submit" class="btn btn-primary" name="submit"> Dodaj novu liniju </button>
                </form>
            </div>
            <?php
            addLine();
            ?>
        </div>
    </div>
</div>
</body>
</html>