<?php
//include auth.php file on all secure pages
include_once("db_config.php");
include_once("functions.php");

?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once("include/meta.php"); ?>

    <title>Stanični red vožnje gradskog prevoza u Subotici</title>

    <link rel="stylesheet" href="../css/newest.css">

</head>
<body>
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
            //include("popupnews.php");
            ?>
            <h2>EZ SZEGED!"</h2>

            <div class="busdeparture">

                <?php
                $test = "SELECT distinct(stop_name) FROM stops ORDER BY stop_name ASC "; $result = $con->query($test);
                ?>

                <form name="test" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <select name="stopname">
                        <option value="">Select stop</option>
                        <?php
                        while ($row = mysqli_fetch_array($result))
                        {
                            echo "<option value='".$row['stop_name']."'>".$row['stop_name']."</option>";
                        }
                        ?>
                    </select>
                    <input  type="submit" name="submit" value="Search!">
                </form>



                <?php
                if(isset($_POST["stopname"])) {
                    $querystops="";
                    @$stopname = $_POST["stopname"];

                    $test2 = "SELECT stop_id FROM stops WHERE stop_name='$stopname' "; $result = $con->query($test2);

                    ?>

                    <?php
                    $count=0;
                    while ($row = mysqli_fetch_array($result))
                    {
                        if($count>0){
                            $querystops.=" OR ";
                        }
                        $querystops.="stop_times.stop_id=".$row['stop_id'];

                        $count++;

                    }

                    $sql = "select routes.route_color as color, routes.route_text_color as textcolor, routes.route_short_name as lineno, stop_times.departure_time as depart, trips.trip_headsign as headsign
  from calendar, stop_times, trips inner join routes on routes.route_id=trips.route_id
 where '2019-01-09' between calendar.start_date and calendar.end_date
   and ($querystops)
   and calendar.service_id=trips.service_id
   and stop_times.trip_id=trips.trip_id
 AND(
(
DAYOFWEEK('2019-01-13') = 1 AND calendar.sunday = 1
)
) AND stop_times.departure_time > '$date' AND NOT EXISTS(
SELECT
1
FROM
calendar_dates
WHERE
calendar_dates.date ='2019-01-13'
                      and calendar_dates.date between
calendar.start_date and calendar.end_date
                      and
calendar.service_id=calendar_dates.service_id
                      and calendar_dates.exception_type=2)
                      order by stop_times.departure_time asc limit 20";
                    echo $sql;

                    echo '<h3> Departures from '.$stopname.'</h3>';

                    echo '    <table class="table">
  <tbody>';
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            echo '    
    <tr>
      <th scope="row" class="index-linenumber" style="background-color: ' . $row["color"] . '; color: ' . $row["textcolor"] . '">' . $row["lineno"] . '</th>
      <td>' . substr($row["depart"], 0, 5) . '</td>
      <td>' . $row["headsign"] . '</td>
      <td class="index-minutesleft">' . getTimeDiff($date, $row["depart"]) . 'm</td>
    </tr>';


                        }
                    } else {
                        echo "No result.
       ";
                    }
                    echo " </tbody>
</table>";
                }?>
            </div>
        </div>
    </div>
</div>

<?php include_once 'include/footer.php'; ?>
