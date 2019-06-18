<?php
//include auth.php file on all secure pages
include_once("db_config.php");
@session_start();
include_once("functions.php");
@$ID_User=$_SESSION['ID_User'];
if(!isset($_SESSION['username'])){
    echo 'Prijavite se da biste omogućili prikaz omiljenih stajališta i omiljenih linija';
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

        <p>Dobrodošli <?php echo $_SESSION['username']; ?>!</p>
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
                if ($stanicaidsearch>1000) {

                    $sql = "SELECT busstops.Stop_Name AS Stanica,
                        Date_Add(`busschedule`.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) AS Now_Minutes,
                        `buslines`.Line_ShortName AS Linija, `buslines`.Line_Name AS LineName,
                        `buslines`.Line_Direction AS Smer
                        FROM `buslines` INNER JOIN (busstops INNER JOIN (busroutes INNER JOIN `busschedule` ON busroutes.ID_Line = `busschedule`.ID_Line)
                        ON busstops.ID_Stop = busroutes.ID_Stop) ON (`buslines`.ID_Line = `busschedule`.ID_Line) AND (`buslines`.ID_Line = busroutes.ID_Line)
                        WHERE (((busstops.ID_Stop)=\"$stanicaidsearch\") AND $scheduleday AND (Date_Add(`busschedule`.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) > '$date') /* AND ((`buslines`.Line_Direction)=\"$linedirection\") */)
                        ORDER BY Date_Add(`busschedule`.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) LIMIT 5 ;";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            @$stanicaNameFav = $row["Stanica"];
                        }
                    } else {
                        $sqlstanica = "SELECT `busstops`.`Stop_Name` AS Stanaziv FROM `busstops` WHERE `busstops`.`ID_Stop`=$stanicaidsearch;";
                        $result3 = $con->query($sqlstanica);
                        if ($result3->num_rows > 0) {
                            // output data of each row
                            while ($row = $result3->fetch_assoc()) {
                                @$stanicaNameFav = $row["Stanaziv"];
                            }
                        }
                    }
                    echo '<div class="favouritedepartures"><b>Polasci sa stajališta ' . @$stanicaNameFav . '</b> <a href="addfavestop.php?delstop=1&stopID=' . $stanicaidsearch . '">x</a></div>';
                    $result = $con->query($sql);
                    echo '<table class="table table-sm">
                        <tbody>';
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '
    <tr>
      <th scope="row" class="index-linenumber">' . $row["Linija"] . '</th>
      <td>' . $row["Smer"] . '</td>
      <td class="index-minutesleft">' . getTimeDiff($date, $row["Now_Minutes"]) . 'm</td>
    </tr>
';
                        }
                    } else {
                        echo '
        <tr>
      <th scope="row" class="index-linenumber">---</th>
      <td>Nema polazaka</td>
      <td class="index-minutesleft">---</td>
    </tr>';
                    }
                    echo '
    </tbody>
    </table>
    ';
                }
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
                    @$selected_line = $linijaidsearch;
                    $selected_line2 = $selected_line;
                    if ($selected_line == 1) {
                        $selected_line2 = "1A";
                    }
                    if ($selected_line == 6) {
                        $selected_line2 = "6A";
                    }
                    if ($selected_line == 8) {
                        $selected_line2 = "8A";
                    }
                    $date = date("H:i:s");
                    $sql = "SELECT `buslines`.Line_ShortName, `buslines`.Line_Text AS Shorten, `busschedule`.Departure AS Polazak, `busschedule`.Day_Type FROM `buslines` INNER JOIN `busschedule` ON `buslines`.ID_Line = `busschedule`.ID_Line
WHERE ( (((`buslines`.Line_ShortName)=\"$selected_line\")) OR ((`buslines`.Line_ShortName)=\"$selected_line2\"))  AND ((`buslines`.Line_Side)=1) AND $scheduleday AND `busschedule`.Departure > '$date'
ORDER BY `busschedule`.`Departure` ASC limit 5";

                    $result = $con->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $first[] = substr($row["Polazak"], 0, 5) . ' ' . $row["Shorten"];
                        }
                    } else {
                        $first[] = "---";
                    }
                    $sqla = "SELECT `buslines`.Line_ShortName, `buslines`.Line_Text AS Shorten, `busschedule`.Departure AS Polazak, `busschedule`.Day_Type FROM `buslines` INNER JOIN `busschedule` ON `buslines`.ID_Line = `busschedule`.ID_Line
WHERE ( (((`buslines`.Line_ShortName)=\"$selected_line\")) OR ((`buslines`.Line_ShortName)=\"$selected_line2\"))  AND ((`buslines`.Line_Side)=0) AND $scheduleday AND `busschedule`.Departure > '$date'
ORDER BY `busschedule`.`Departure` ASC limit 5";
                    $result = $con->query($sqla);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $second[] = substr($row["Polazak"], 0, 5) . ' ' . $row["Shorten"];
                        }
                    } else {
                        $second[] = "---";
                    }
                    echo '<table class="table table-sm">
    <thead>
    <tr>
        <th><h5>Linija ' . $linijaidsearch . '</h5></th>
        <th style="vertical-align: top; text-align: end"><a href="addfaveline.php?delline=1&LineID=' . $linijaidsearch . '">x</a></th>
    </tr>
    <tr bgcolor="#00bfff">
        <th scope="col" style="width:25%">Vreme u odlasku</th>
        <th scope="col" style="width:25%">Vreme u povratku</th>
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