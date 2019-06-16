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
    <?php include_once("include/meta.php"); ?>

    <link rel="stylesheet" href="../css/bootstrap.css">

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

<?php include_once 'include/footer.php'; ?>
