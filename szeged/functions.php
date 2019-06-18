<?php
include_once('db_config.php');
@session_start();
//////////////////
///
///  list of bus lines
///
/// //////////////
///
//

function listofbuslines(){

    echo'
<div class="table-responsive">
  <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
    </tr>
  </thead>
  <tbody>

';
    global $con;
    $sql="SELECT route_short_name, route_long_name from routes order by route_short_name";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo     '<tr>
      <th scope="row"><a href="buslines.php?line='.$row["route_short_name"].'">'. $row["route_short_name"].'</a></th>
      <td>' . $row["route_long_name"].'</td>
    </tr>';
        }
    } else {
        echo "0 results";
    }

echo'
    </tbody>
  </table>
  </div>';
}


//////////////////
///
///  function for terminus schedules
///
/// //////////////
///
///

function terminusschedule($linesearch){

    global $con;
    $sql="SELECT route_id, route_short_name, route_long_name FROM `routes` WHERE route_short_name = \"$linesearch\" limit 1 ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo '<h3>'.$row["route_short_name"].' - '. $row["route_long_name"].'</h3>
<a href="addfaveline.php?addLine='. $row["route_short_name"].'">Add as favourite!</a>';
            $selected_line=$row["route_id"];
        }
    } else {
        echo "Line not selected!";
        listofbuslines();
    }

?>

        <?php


        $sql = "select stop_times.departure_time as depart, trips.trip_headsign as headsign from calendar, stop_times, trips where '2019-01-09' between calendar.start_date and calendar.end_date and trips.route_id=$selected_line and stop_times.stop_sequence=1 and trips.direction_id=0 and calendar.service_id=trips.service_id and stop_times.trip_id=trips.trip_id and ( (dayofweek('2019-01-09')=4 and calendar.wednesday=1) ) and not exists (select 1 from calendar_dates where calendar_dates.date='2019-01-09' and calendar_dates.date between calendar.start_date and calendar.end_date and calendar.service_id=calendar_dates.service_id and calendar_dates.exception_type=2) order by stop_times.departure_time asc  ";

        $result = mysqli_query($con, $sql);



        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $first[]=substr($row["depart"], 0,5);
            }
        } else {
            $first[]="---";
        }







        $sql = "select stop_times.departure_time as depart, trips.trip_headsign as headsign from calendar, stop_times, trips where '2019-01-12' between calendar.start_date and calendar.end_date and trips.route_id=$selected_line and stop_times.stop_sequence=1 and trips.direction_id=0 and calendar.service_id=trips.service_id and stop_times.trip_id=trips.trip_id and ( (dayofweek('2019-01-12')=7 and calendar.saturday=1) ) and not exists (select 1 from calendar_dates where calendar_dates.date='2019-01-12' and calendar_dates.date between calendar.start_date and calendar.end_date and calendar.service_id=calendar_dates.service_id and calendar_dates.exception_type=2) order by stop_times.departure_time asc ";


        $result = mysqli_query($con, $sql);

       

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {

$second[]=substr($row["depart"], 0,5);
            }
        } else {
            $second[]="---";
        }


    $sql = "select stop_times.departure_time as depart, trips.trip_headsign as headsign from calendar, stop_times, trips where '2019-01-12' between calendar.start_date and calendar.end_date and trips.route_id=$selected_line and stop_times.stop_sequence=1 and trips.direction_id=0 and calendar.service_id=trips.service_id and stop_times.trip_id=trips.trip_id and ( (dayofweek('2019-01-13')=1 and calendar.sunday=1) ) and not exists (select 1 from calendar_dates where calendar_dates.date='2019-01-12' and calendar_dates.date between calendar.start_date and calendar.end_date and calendar.service_id=calendar_dates.service_id and calendar_dates.exception_type=2) order by stop_times.departure_time asc  ";


    $result = mysqli_query($con, $sql);


    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {


            $third[]=substr($row["depart"], 0,5);
        }
    } else {
        $third[]="---";
    }


        $sql = "select stop_times.departure_time as depart, trips.trip_headsign as headsign from calendar, stop_times, trips where '2019-01-09' between calendar.start_date and calendar.end_date and trips.route_id=$selected_line and stop_times.stop_sequence=1 and trips.direction_id=1 and calendar.service_id=trips.service_id and stop_times.trip_id=trips.trip_id and ( (dayofweek('2019-01-09')=4 and calendar.wednesday=1) ) and not exists (select 1 from calendar_dates where calendar_dates.date='2019-01-09' and calendar_dates.date between calendar.start_date and calendar.end_date and calendar.service_id=calendar_dates.service_id and calendar_dates.exception_type=2) order by stop_times.departure_time asc;
";


        $result = mysqli_query($con, $sql);



        if (mysqli_num_rows($result) > 0) {
            // output data of each row

            while($row = mysqli_fetch_assoc($result)) {


                $fourth[]=substr($row["depart"], 0,5);
            }
        } else {
            $fourth[]="---";
        }


        $sql = "select stop_times.departure_time as depart, trips.trip_headsign as headsign from calendar, stop_times, trips where '2019-01-12' between calendar.start_date and calendar.end_date and trips.route_id=$selected_line and stop_times.stop_sequence=1 and trips.direction_id=1 and calendar.service_id=trips.service_id and stop_times.trip_id=trips.trip_id and ( (dayofweek('2019-01-12')=7 and calendar.saturday=1) ) and not exists (select 1 from calendar_dates where calendar_dates.date='2019-01-12' and calendar_dates.date between calendar.start_date and calendar.end_date and calendar.service_id=calendar_dates.service_id and calendar_dates.exception_type=2) order by stop_times.departure_time asc  ";


        $result = mysqli_query($con, $sql);


        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {


                $fifth[]=substr($row["depart"], 0,5);
            }
        } else {
            $fifth[]="---";
        }

    $sql = "select stop_times.departure_time as depart, trips.trip_headsign as headsign from calendar, stop_times, trips where '2019-01-12' between calendar.start_date and calendar.end_date and trips.route_id=$selected_line and stop_times.stop_sequence=1 and trips.direction_id=1 and calendar.service_id=trips.service_id and stop_times.trip_id=trips.trip_id and ( (dayofweek('2019-01-13')=1 and calendar.sunday=1) ) and not exists (select 1 from calendar_dates where calendar_dates.date='2019-01-12' and calendar_dates.date between calendar.start_date and calendar.end_date and calendar.service_id=calendar_dates.service_id and calendar_dates.exception_type=2) order by stop_times.departure_time asc  ";


    $result = mysqli_query($con, $sql);


    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {


            $sixth[]=substr($row["depart"], 0,5);
        }
    } else {
        $sixth[]="---";
    }

    echo '<div class="table-responsive"><table class="table table-sm">
  <thead>
    <tr bgcolor="#00bfff">
      <th scope="col" style="width:17%">Workday</th>
      <th scope="col" style="width:16%">Saturday</th>
      <th scope="col" style="width:17%">Sunday</th>
       <th scope="col" style="width:17%">Workday</th>
      <th scope="col" style="width:16%">Saturday</th>
      <th scope="col" style="width:17%">Sunday</th>
      
    </tr>
  </thead>
  <tbody>';
        $ar1=sizeof($first);
    $ar2=sizeof($second);
    $ar3=sizeof($third);
    $ar4=sizeof($fourth);
    $ar5=sizeof($fifth);
    $ar6=sizeof($sixth);

       $tablelength=$ar1;
       if($ar2>=$ar1){
           $tablelength=$ar2;
       }
       if($ar3>=$ar2){
           $tablelength=$ar3;}

       if($ar4>=$ar3) {
           $tablelength = $ar4;
       }

    if($ar5>=$ar4) {
        $tablelength = $ar5;
    }
    if($ar6>=$ar5) {
        $tablelength = $ar6;
    }



       for($i=0;$i<=$tablelength;$i++){
      echo '
    <tr>
      <td>';if(isset($first[$i])){echo $first[$i];}; echo '</td>';
      echo'<td>';if(isset($second[$i])){echo $second[$i];}; echo '</td>';
           echo'<td>';if(isset($third[$i])){echo $third[$i];}; echo '</td>';
           echo'<td>';if(isset($fourth[$i])){echo $fourth[$i];}; echo '</td>';
           echo'<td>';if(isset($fifth[$i])){echo $fifth[$i];}; echo '</td>';
           echo'<td>';if(isset($sixth[$i])){echo $sixth[$i];}; echo '</td>';
    echo'</tr>
 
    ';}
      echo'
  </tbody>
</table></div>';


}

function getTimeDiff($dtime,$atime)
{

    $nextDay=$dtime>$atime?1:0;
    $dep=explode(':',$dtime);
    $arr=explode(':',$atime);

    if (isset($dep[0])) {
        $dep[0]=intval($dep[0]);}
    if (isset($dep[1])) {
        $dep[1]=intval($dep[1]);
    }
    if (isset($arr[0])) {
        $arr[0]=intval($arr[0]);}
    if (isset($arr[1])) {
        $arr[1]=intval($arr[1]);
    }


    @$diff=abs(mktime($dep[0],$dep[1],0,date('n'),date('j'),date('y'))-mktime($arr[0],$arr[1],0,date('n'),date('j')+$nextDay,date('y')));

    //Hour

    $hours=floor($diff/(60*60));

    //Minute

    $mins=floor(($diff-($hours*60*60))/(60));

    //Second

    $secs=floor(($diff-(($hours*60*60)+($mins*60))));

    if(strlen($hours)<2)
    {
        $hours="0".$hours;
    }

    if(strlen($mins)<2)
    {
        $mins="0".$mins;
    }

    if(strlen($secs)<2)
    {
        $secs="0".$secs;
    }

    if($hours>0)
    {$hours=$hours*60;
        $mins=$mins+$hours;}

    return $mins;

}

///////////
///
///
///     GETS THE SCHEDULE DATE
///
///
/// /////////

function getScheduleDate() {

    // Used to differentiate between Workdays, Saturdays, and Sunday/Public Holiday schedules.

    global $con;

    $dayOfWeek=0;
    $dayOfWeek = date("l");
    if ( $dayOfWeek == 'Monday' or $dayOfWeek == 'Tuesday' or $dayOfWeek == 'Wednesday' or $dayOfWeek == 'Thursday' or $dayOfWeek == 'Friday' ){
        $schedDate="((`busschedule`.Day_Type)=1)";
    }else if ( $dayOfWeek == "Saturday" ) {
        $schedDate = "(((`busschedule`.Day_Type)=2) OR ((`busschedule`.Day_Type)=3))";
    }else if ( $dayOfWeek == 'Sunday' ) {
        $schedDate = "(((`busschedule`.Day_Type)=2) OR ((`busschedule`.Day_Type)=4))";
    }


    $sql="SELECT * FROM `busspecialdate` WHERE Sp_Date=CURDATE();";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        $schedDate = "(((`busschedule`.Day_Type)=2) OR ((`busschedule`.Day_Type)=4))";

    }

    return $schedDate;
}

///////////
///
///
///     GETS THE time AGO FORM TIMESPTAMP
///
///
/// /////////
function timeAgo($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

///////////
///
///
///     <option>S FOR SELECTING ALL LINE NUMBERS
///
///
/// /////////
function selectlines(){

    global $con;

    $sql = "SELECT DISTINCT Line_ShortName FROM `buslines`";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["Line_ShortName"] . "' name='" . $row["Line_ShortName"] . "'>" . $row["Line_ShortName"] . "</option>";
        }
    }
}
function addComment() {

    global $con;

    if(isset($_POST['newcomment'])){
        $newcommnet = $_POST['newcomment'];
        $newsid = $_POST['newsid'];
        @$ID_User=$_SESSION['ID_User'];
        $line='';
        foreach ($_POST['lines'] as $lines)
            $line .= " ".$lines;
        $query = "INSERT into `buscomments` (ID_News, ID_User, Comment_Content, Show_Lines)
              VALUES ($newsid,$ID_User,'$newcommnet','$line')";
        $result = mysqli_query($con,$query);
        header('Location: news.php?newsid='.$newsid.'');
    }
}

function getComment($newsid) {

    global $con;

    $sql = "SELECT *, u.Username as uname FROM buscomments b JOIN users u ON b.ID_User = u.ID_User 
              WHERE ID_News=$newsid ORDER BY Time_Posted DESC";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $showlines = explode(" ",$row["Show_Lines"]);
            echo "<div class=\"w3-panel w3-light-gray w3-card-4\">
                    <p><b>" . $row["uname"] . "</b> &nbsp; <small>" . timeAgo($row["Time_Posted"]) . "</small></p>
                    <p>" . $row["Comment_Content"] . "<br/></p>";
            foreach($showlines as $line){
                echo "<a href='buslines.php?line=$line'>$line</a> ";};
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "NO COMMENTS FOR THIS POST.</div>";
    }
}


?>