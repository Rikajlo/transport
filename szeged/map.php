
<?php
//include auth.php file on all secure pages
include_once("db_config.php");
include_once("functions.php");

?>
<!DOCTYPE html>
<html>
<head>
  <?php include_once("include/meta.php"); ?>

  <title>Szeged Map</title>

  <link rel="stylesheet" href="../css/newest.css">
  <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">

</head>
<body onload="initialize_map(); <?php include_once ("mapvalues.php")?>">
<?php include_once("menu.php"); ?>


<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-3 content1-left">
      <?php
      include("sidemenu.php")
      ?>
    </div>
    <div class="col-sm-9 content1-right" style="min-height: 100%;">
      <div id="map" style="width: 100vw; height: 100vh;"></div>
    </div>
<script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
<script src="../js/map.js" type="text/javascript"></script>
</body>
</html>
