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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/linesched.css" />
    <script src="js/bootstrap.js"></script>

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

