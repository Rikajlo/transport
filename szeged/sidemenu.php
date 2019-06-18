<?php
//include auth.php file on all secure pages
include_once("db_config.php");
@session_start();
include_once("functions.php");
@$ID_User=$_SESSION['ID_User'];
if(!isset($_SESSION['username'])){
    echo 'Sign in to have the option of choosing favourite bus stops and lines.';
}else { ?>

    <?php
    $stops=0;
    @$Stop_Name = $_POST["Stop_Name"];
    @$linedirection = $_POST["linedirection"];
    $date = date("H:i:s");
    $scheduleday = getScheduleDate();
    $sql = "SELECT `favouritestops`.`ID_Stop` AS Stanicaa
FROM favouritestops
WHERE ((( `favouritestops`.`ID_User`)=\"$ID_User\"));
";
    $result = $con->query($sql);
    if (!isset($row["Stanicaa"])) {
        ?>

        <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
        <br/>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $stanicaidsearch = $row["Stanicaa"];
                /* $now = new DateTime();
                 $future = $row["Now_Minutes"];
                 $interval = $future_date->diff($now);
                 echo $interval->format("%a days, %h hours, %i Dist_Minutes, %s seconds"); */
                //echo $row["Stanica"]. "  Vreme:  ". $row["Now_Minutes"]."  Linija:  ". $row["Linija"]. getTimeDiff($date,$row["Now_Minutes"])."</br>";
            }
        } else {
            echo " - ";
        } ?>


        <?php
        $sql = "SELECT `favouritestops`.`ID_Stop` AS Stanicaa
FROM favouritestops
WHERE ((( `favouritestops`.`ID_User`)=\"$ID_User\"));
";
        $result = $con->query($sql);
        ?>

        <?php
        $i = 0;
        $j = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            $stops = array();
            while ($row = $result->fetch_assoc()) {
                $stanicaidsearch = $row["Stanicaa"];
                @$stops[$i] = $row["Stanicaa"];
                $i++;
            }
        } else {
            echo "No favourite stops.";
        } ?>

        <?php
        if (is_array($stops)) {
            foreach ($stops as $value) {
                $stanicaidsearch = $value;
                if ($stanicaidsearch) { $querystops="";
                    @$stopname = $stanicaidsearch;

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
calendar.".strtolower(date('l'))." = 1
)
) AND stop_times.departure_time > '$date' AND NOT EXISTS(
SELECT
1
FROM
calendar_dates
WHERE
calendar_dates.date ='".date('Y-m-d')."'
                      and calendar_dates.date between
calendar.start_date and calendar.end_date
                      and
calendar.service_id=calendar_dates.service_id
                      and calendar_dates.exception_type=2)
                      order by stop_times.departure_time asc limit 5";

                    echo ' Departures from '.$stopname.' <a href="addfavestop.php?delstop=1&delstopid=' . $stanicaidsearch . '">x</a>';

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
</table>";}
            }
        }
    }
    $sqlaa = "SELECT `favouritelines`.ID_Line AS Linjija
FROM favouritelines
WHERE ((( `favouritelines`.ID_User)=$ID_User));
";
    $result5 = $con->query($sqlaa);


    if ($result5->num_rows > 0) {
        // output data of each row
        while ($row5 = $result5->fetch_assoc()) {
            $linijaidsearch = $row5["Linjija"];
            if (isset($linijaidsearch)){
                $headsign = "Side A";
                $headsign2 = "Side B";
                @$selected_line = $linijaidsearch;

                $date = date("H:i:s");

                $sql = "select stop_times.departure_time as depart, trips.trip_headsign as headsign from calendar, stop_times, trips where '".date('Y-m-d')."' between calendar.start_date and calendar.end_date and trips.route_id=$selected_line and stop_times.stop_sequence=1 and trips.direction_id=0 and calendar.service_id=trips.service_id and stop_times.trip_id=trips.trip_id and ( calendar.".strtolower(date('l'))."=1 ) and not exists (select 1 from calendar_dates where calendar_dates.date='".date('Y-m-d')."' and calendar_dates.date between calendar.start_date and calendar.end_date and calendar.service_id=calendar_dates.service_id and calendar_dates.exception_type=2) and stop_times.departure_time>'$date' order by stop_times.departure_time asc limit 5";

                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        $headsign=$row["headsign"];
                        $first[]=substr($row["depart"], 0,5);
                    }
                } else {
                    $first[]="---";
                }
                $sql = "select stop_times.departure_time as depart, trips.trip_headsign as headsign from calendar, stop_times, trips where '".date('Y-m-d')."' between calendar.start_date and calendar.end_date and trips.route_id=$selected_line and stop_times.stop_sequence=1 and trips.direction_id=1 and calendar.service_id=trips.service_id and stop_times.trip_id=trips.trip_id and ( calendar.".strtolower(date('l'))."=1 ) and not exists (select 1 from calendar_dates where calendar_dates.date='".date('Y-m-d')."' and calendar_dates.date between calendar.start_date and calendar.end_date and calendar.service_id=calendar_dates.service_id and calendar_dates.exception_type=2) and stop_times.departure_time>'$date' order by stop_times.departure_time asc limit 5";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row2 = mysqli_fetch_assoc($result)) {
                        $headsign2=$row2["headsign"];
                        $second[]=substr($row2["depart"], 0,5);
                    }
                } else {
                    $second[]="---";
                }
                echo '<table class="table table-sm">
    <thead>
    <tr>
        <th><h5>Line ' . $linijaidsearch . '</h5></th>
        <th style="vertical-align: top; text-align: end"><a href="addfaveline.php?delline=1&LineID=' . $linijaidsearch . '">x</a></th>
    </tr>
    <tr bgcolor="#00bfff">
        <th scope="col" style="width:25%">'.$headsign.'</th>
        <th scope="col" style="width:25%">'.$headsign2.'</th>
    </tr>
    </thead>
    <tbody>';
                $ar1 = sizeof($first);
                $ar2 = sizeof($second);
                $tablelength = $ar1;
                if ($ar2 >= $ar1) {
                    $tablelength = $ar2;
                }
                for ($i = 0; $i <= $tablelength; $i++) {
                    echo '
    <tr>
        <td>';
                    if (isset($first[$i])) {
                        echo $first[$i];
                    };
                    echo '</td>';
                    echo '<td>';
                    if (isset($second[$i])) {
                        echo $second[$i];
                    };
                    echo '</td>';
                    echo '</tr>
    ';
                } unset($first); unset($second);
                echo '
    </tbody>
</table>
';
            }

        }
    } else {
        echo " - ";
    }

}