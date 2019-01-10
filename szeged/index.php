<?php
//include auth.php file on all secure pages
include_once("db_config.php");
include_once("menu.php");
include_once("functions.php");

$date=date("H:i:s");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Stanični red vožnje gradskog prevoza u Subotici</title>
    <META NAME="author" CONTENT="Martin Kiš, Daniel Ištvan">
    <META NAME="Description" CONTENT="Stajališni red vožnje na teritoriji grada Subotica, unesite naziv željene stanice i saznajte za koliko minuta stiže sledeći autobus.">
    <META NAME="Keywords" CONTENT="javni prevoz, gradski saobracaj, subotica, linija, autobus, stajaliste, stanica, javni prevoz u subotici">
    <META NAME="Geography" CONTENT="Subotica, Serbia">
    <META NAME="Language" CONTENT="Serbian">
    <META NAME="distribution" CONTENT="Global">
    <META NAME="Robots" CONTENT="INDEX,FOLLOW">
    <META NAME="zipcode" CONTENT="24000">
    <META NAME="city" CONTENT="Subotica">
    <META NAME="country" CONTENT="Serbia">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/linesched.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/newest.css" />


</head>
<body>
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
                        <option value="">Izaberite stanicu</option>
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
   and (   (dayofweek('2019-01-09')=4 and calendar.wednesday=1)
          ) and stop_times.departure_time > '$date'
   and not exists (select 1
                     from calendar_dates
                    where calendar_dates.date='2019-01-09'
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
        echo "Niste uneli pretragu / ili postoji 0 rezultata.";
    }
    echo " </tbody>
</table>";
}?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

