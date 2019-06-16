<?php
include('db_config.php');
include('functions.php');

if(isset($_REQUEST['line'])){
    $line=$_REQUEST['line'];
}
?>
<!DOCTYPE html>
<html>
<head>

    <?php
    include_once("meta/meta.php");
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</head>
<body>
<?php
include('menu.php');
 ?>


<div class="row">
    <div class="col-lg-3 col-md-3 col-12"><?php include('sidemenu.php'); ?></div>
        <div class="col-lg-9 col-md-9 col-12 h4">
            <?php
            if(@$line){
                terminusschedule($line);
            } else {
           listofbuslines();
            }
           ?>
        </div>
</div>
</body>
</html>

