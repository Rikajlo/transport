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
    $sql="SELECT `Line_ShortName`, Line_Name FROM buslines group by `Line_ShortName` order by ID_Line";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo     '<tr>
      <th scope="row"><a href="buslines.php?line='.$row["Line_ShortName"].'">'. $row["Line_ShortName"].'</a></th>
      <td>' . $row["Line_Name"].'</td>
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
    $sql="SELECT Line_ShortName, Line_Name FROM `buslines` WHERE Line_ShortName = \"$linesearch\" and Line_Side = 1 limit 1 ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo '<h3>'.$row["Line_ShortName"].' - '. $row["Line_Name"].'</h3>';
        }
    } else {
        echo "Line not selected!";
        listofbuslines();
    }

?>

        <?php

        $selected_line=$linesearch;

        $selected_line2=$selected_line;

        $scheduleday=getScheduleDate();

        if($selected_line==1){
            $selected_line2="1A";
        }

        if($selected_line==6){
            $selected_line2="6A";
        }

        if($selected_line==8){
            $selected_line2="8A";
        }

        $sql = "SELECT `buslines`.Line_ShortName, `buslines`.Line_Text AS Shorten, 
                `busschedule`.Departure AS Polazak, `busschedule`.Day_Type 
                FROM `buslines` INNER JOIN `busschedule` ON `buslines`.ID_Line = `busschedule`.ID_Line
                WHERE ( (((`buslines`.Line_ShortName)=\"$selected_line\")) OR ((`buslines`.Line_ShortName)=\"$selected_line2\")) 
                    AND ((`buslines`.Line_Side)=1) AND ((`busschedule`.Day_Type)=1)
                ORDER BY `busschedule`.`Departure` ASC";

        $result = mysqli_query($con, $sql);



        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $first[]=substr($row["Polazak"], 0,5).' '.$row["Shorten"];
            }
        } else {
            $first[]="---";
        }







        $sql = "SELECT `buslines`.Line_ShortName, `buslines`.Line_Text AS Shorten, `busschedule`.Departure AS Polazak, 
                `busschedule`.Day_Type FROM `buslines` INNER JOIN `busschedule` ON `buslines`.ID_Line = `busschedule`.ID_Line
                WHERE ( (((`buslines`.Line_ShortName)=\"$selected_line\")) OR ((`buslines`.Line_ShortName)=\"$selected_line2\"))  
                    AND ((`buslines`.Line_Side)=1) AND ((((`busschedule`.Day_Type)=2)) 
                    OR ((`busschedule`.Day_Type)=3) OR ((`busschedule`.Day_Type)=4))
                ORDER BY `busschedule`.Departure ASC";


        $result = mysqli_query($con, $sql);

       

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {

$second[]=substr($row["Polazak"], 0,5).' '.$row["Shorten"];
            }
        } else {
            $second[]="---";
        }



        $sql = "SELECT `buslines`.Line_ShortName, `buslines`.Line_Text AS Shorten, `busschedule`.Departure AS Polazak, `busschedule`.Day_Type FROM `buslines` INNER JOIN `busschedule` ON `buslines`.ID_Line = `busschedule`.ID_Line
WHERE ( (((`buslines`.Line_ShortName)=\"$selected_line\")) OR ((`buslines`.Line_ShortName)=\"$selected_line2\"))  AND ((`buslines`.Line_Side)=0) AND ((`busschedule`.Day_Type)=1)
ORDER BY `busschedule`.Departure ASC";


        $result = mysqli_query($con, $sql);



        if (mysqli_num_rows($result) > 0) {
            // output data of each row

            while($row = mysqli_fetch_assoc($result)) {


                $third[]=substr($row["Polazak"], 0,5).' '.$row["Shorten"];
            }
        } else {
            $third[]="---";
        }


        $sql = "SELECT `buslines`.Line_ShortName, `buslines`.Line_Text AS Shorten, `busschedule`.Departure AS Polazak, `busschedule`.Day_Type FROM `buslines` INNER JOIN `busschedule` ON `buslines`.ID_Line = `busschedule`.ID_Line
WHERE ( (((`buslines`.Line_ShortName)=\"$selected_line\")) OR ((`buslines`.Line_ShortName)=\"$selected_line2\"))  
AND ((`buslines`.Line_Side)=0) 
AND ((((`busschedule`.Day_Type)=2))  OR ((`busschedule`.Day_Type)=3)  OR ((`busschedule`.Day_Type)=4))
ORDER BY `busschedule`.Departure ASC";


        $result = mysqli_query($con, $sql);


        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {


                $fourth[]=substr($row["Polazak"], 0,5).' '.$row["Shorten"];
            }
        } else {
            $fourth[]="---";
        }


    echo '<table class="table table-sm">
  <thead>
    <tr bgcolor="#00bfff">
      <th scope="col" style="width:25%">Radni Dan</th>
      <th scope="col" style="width:25%">Vikend i drž. praznici</th>
      <th scope="col" style="width:25%">Vikend i drž. praznici</th>
      <th scope="col" style="width:25%">Radni Dan</th>
    </tr>
  </thead>
  <tbody>';
        $ar1=sizeof($first);
    $ar2=sizeof($second);
    $ar3=sizeof($third);
    $ar4=sizeof($fourth);

       $tablelength=$ar1;
       if($ar2>=$ar1){
           $tablelength=$ar2;
       }
       if($ar3>=$ar2){
           $tablelength=$ar3;}

       if($ar4>=$ar3) {
           $tablelength = $ar4;
       }



       for($i=0;$i<=$tablelength;$i++){
      echo '
    <tr>
      <td>';if(isset($first[$i])){echo $first[$i];}; echo '</td>';
      echo'<td>';if(isset($second[$i])){echo $second[$i];}; echo '</td>';
           echo'<td>';if(isset($third[$i])){echo $third[$i];}; echo '</td>';
           echo'<td>';if(isset($fourth[$i])){echo $fourth[$i];}; echo '</td>';
    echo'</tr>
 
    ';}
      echo'
  </tbody>
</table>';


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