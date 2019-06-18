<?php
//include auth.php file on all secure pages
include_once("db_config.php");
include_once("functions.php");

?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
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
            include("popupnews.php");
            ?>
            <h2>Dobrodošli na sajt projekta "Stanični red vožnje javnog prevoza na teritoriji grada Subotica!"</h2>
            <h3 style="font-face:'Arial';"> Red vožnje linija: &nbsp; &nbsp;
                <a href="buslines.php?line=1A">1a</a>
                <a href="buslines.php?line=2">2</a>
                <a href="buslines.php?line=3">3</a>
                <a href="buslines.php?line=4">4</a>
                <a href="buslines.php?line=6">6</a>
                <a href="buslines.php?line=7">7</a>
                <a href="buslines.php?line=8">8 8a</a>
                <a href="buslines.php?line=9">9</a>
                <a href="buslines.php?line=10">10</a>
                <a href="buslines.php?line=16">16</a>
                <a href="buslines.php?line=22">22</a>
            </h3>
            <div class="busdeparture">
                <?php
                $test = "SELECT Stop_Name FROM busstops ORDER BY Stop_Name ASC "; $result = $con->query($test);
                ?>

                <form name="test" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <select name="stopname">
                        <option value="">Izaberite stanicu</option>
                        <?php
                        while ($row = mysqli_fetch_array($result))
                        {
                            echo "<option value='".$row['Stop_Name']."'>".$row['Stop_Name']."</option>";
                        }
                        ?>
                    </select>
                    <input  type="text" name="linedirection" placeholder="Smer putovanja">
                    <input  type="submit" name="submit" value="Pretraži!">
                </form>

                <?php

                @$stopname=$_POST["stopname"];
                @$linedirection=$_POST["linedirection"];
                $date=date("H:i:s");

                echo $date."  ".$stopname."<br/>";
                $scheduleday=getScheduleDate();
                mysqli_query($con,"SET NAMES utf8") or die (mysqli_error($con));
                mysqli_query($con,"SET CHARACTER SET utf8") or die (mysqli_error($con));
                mysqli_query($con,"SET COLLATION_CONNECTION = 'utf8_unicode_ci'");


                if(strlen(@$_POST["linedirection"])>1){

                    $sql = "SELECT busstops.Stop_Name AS Stanica, busstops.ID_Stop AS StopIDNo,
 Date_Add(busschedule.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) AS NowMinutes,
  buslines.Line_ShortName AS Linija, buslines.Line_Name AS LineName,
   buslines.Line_Direction AS Smer
   FROM `buslines` INNER JOIN (busstops INNER JOIN (busroutes INNER JOIN busschedule ON busroutes.ID_Line = busschedule.ID_Line) 
   ON busstops.ID_Stop = busroutes.ID_Stop) ON (buslines.ID_Line = busschedule.ID_Line) AND (buslines.ID_Line = busroutes.ID_Line) 
   WHERE (((busstops.Stop_Name)=\"$stopname\") AND $scheduleday AND ((buslines.Line_Direction)=\"$linedirection\") AND (Date_Add(busschedule.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) > '$date') /* AND ((buslines.Line_Direction)=\"$linedirection\") */) 
   ORDER BY Date_Add(busschedule.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) LIMIT 20 ;";} else {

                    $sql = "SELECT busstops.Stop_Name AS Stanica, busstops.ID_Stop AS StopIDNo,
 Date_Add(busschedule.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) AS NowMinutes,
  buslines.Line_ShortName AS Linija, buslines.Line_Name AS LineName,
   buslines.Line_Direction AS Smer
   FROM `buslines` INNER JOIN (busstops INNER JOIN (busroutes INNER JOIN busschedule ON busroutes.ID_Line = busschedule.ID_Line) 
   ON busstops.ID_Stop = busroutes.ID_Stop) ON (buslines.ID_Line = busschedule.ID_Line) AND (buslines.ID_Line = busroutes.ID_Line) 
   WHERE (((busstops.Stop_Name)=\"$stopname\") AND $scheduleday AND (Date_Add(busschedule.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) > '$date') /* AND ((buslines.Line_Direction)=\"$linedirection\") */) 
   ORDER BY Date_Add(busschedule.Departure, INTERVAL busroutes.Dist_Minutes MINUTE) LIMIT 20 ;";}

                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $curStopID=$row['StopIDNo'];
                    }

                    ?>
                    <?php if(isset($_SESSION['username'])){?>
                        <form name="addfav" method="post" action="addfavestop.php" method="post">
                            <input  type="hidden" name="UserID" value="<?php echo @$_SESSION['ID_User'] ?>">
                            <input  type="hidden" name="StopID" value="<?php echo @$curStopID; ?>">
                            <input  type="submit" name="submit" value="Dodaj ovu stanicu kao omiljenu">
                        </form>
                    <?php }; ?>
                    <?php
                    echo '    <table class="table">
  <tbody>';
                    $result = $con->query($sql);
                    while($row = $result->fetch_assoc()) {
                        $curStopID=$row['StopIDNo'];
                        echo '    
    <tr>
      <th scope="row" class="index-linenumber">'.$row["Linija"].'</th>
      <td>'.substr($row["NowMinutes"], 0,5).'</td>
      <td>'.$row["Smer"].'</td>
      <td class="index-minutesleft">'.getTimeDiff($date,$row["NowMinutes"]).'m</td>
    </tr>';



                    }
                    echo " </tbody>
</table>";

                } else {
                    echo "Niste uneli pretragu / ili postoji 0 rezultata.<p> </p>
                     <a href='/taxi.php'>Kliknite ovde za pretragu taxi vozila.</a>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include_once 'include/footer.php'; ?>
