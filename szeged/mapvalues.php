<?php
require_once("db_config.php");

// Select all the rows in the markers table
$sql = "SELECT * FROM stops WHERE 1";
$result = $con->query($sql);
while ($row = @mysqli_fetch_assoc($result)){
  echo 'add_map_point('. $row['stop_lat'] .', '. $row['stop_lon'] . ');';
}
?>
add_map_point(46.2530, 20.1414);