<?php
require_once("db_config.php");

if(isset($_POST["routes"])) {
  $route = $_POST["routes"];

  $sql = "SELECT stop_lat, stop_lon, stop_name FROM stops 
            INNER JOIN stop_times ON stops.stop_id=stop_times.stop_id
            INNER JOIN trips ON stop_times.trip_id=trips.trip_ID
            INNER JOIN routes ON routes.route_id=trips.route_id
            WHERE routes.route_id='$route' LIMIT 30";
  $result = $con->query($sql);
  while ($row = mysqli_fetch_assoc($result)) {
    echo ' add_map_point('.$row['stop_lat'].', '.$row['stop_lon'].', \''.$row['stop_name'].'\');';
  }
}
else {
  $sql = "SELECT * FROM stops WHERE 1";
  $result = $con->query($sql);
  while ($row = @mysqli_fetch_assoc($result)){
    echo ' add_map_point('.$row['stop_lat'].', '.$row['stop_lon'].', \''.$row['stop_name'].'\');';
  }
}