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

  <script src="../js/map.js" type="text/javascript"></script>
</head>
<body onload="initialize_map(46.2530, 20.1414); <?php include_once ("mapvalues.php")?>">
<?php include_once("menu.php"); ?>


<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-3 content1-left">
      <?php
      include("sidemenu.php")
      ?>
    </div>
    <div class="col-sm-9 content1-right" style="min-height: 100%;">
      <?php
      $test = "SELECT route_long_name, route_id from routes order by route_short_name"; $result = $con->query($test);
      ?>
      <form name="test" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select name="routes">
          <option value="">Select stop</option>
          <?php
          while ($row = mysqli_fetch_array($result))
          {
            echo "<option value='".$row['route_id']."'>".$row['route_long_name']."</option>";
          }
          ?>
        </select>
        <input  type="submit" name="submit" value="Search!">
      </form>
      <div id="map" style="width: 100%; height: 100%;"></div>
    </div>
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
</body>
</html>
