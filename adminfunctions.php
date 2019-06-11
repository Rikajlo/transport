<?php
include_once('db_config.php');
@session_start();



function addLine() {

global $con;

if(isset($_POST['lineid'])) {
$query = "INSERT INTO `buslines`(`ID_Line`, `Line_ShortName`, `Line_Name`, `Line_Direction`, `Line_Text`, `Line_Side`)
VALUES (" . $_POST['lineid'] . ",'" . $_POST['lineshort'] . "','" . $_POST['linename'] . "',
'" . $_POST['linedir'] . "','" . $_POST['linetext'] . "'," . $_POST['lineside'] . ")";
$result = mysqli_query($con, $query);
}

if(isset($_POST['lineshort']) or isset($_GET['lineshort'])) {
@$linshort = $_GET['lineshort'];
if(isset($_POST['lineshort']))$linshort = $_POST['lineshort'];
$sql = "SELECT * FROM `buslines` WHERE `Line_ShortName`='".$linshort."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
// output data of each row
echo "<table class='table table-bordered'><tr><td>ID_Line</td><td>Line_ShortName</td><td>Line_Name</td><td>Line_Direction</td><td>Line_Text</td><td>Line_Side</td></tr>";
    while ($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row['ID_Line']."</td><td>".$row['Line_ShortName']."</td><td>".$row['Line_Name']."</td>
        <td>".$row['Line_Direction']."</td><td>".$row['Line_Text']."</td><td>".$row['Line_Side']."</td></tr>";
    }
    echo "</table>";
}
}

}
function changesched($line)
{

global $con;
$sql = "SELECT * FROM `buslines` WHERE Line_ShortName = \"$line\" and Line_Side = 1 limit 1 ";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
while ($row = mysqli_fetch_assoc($result)) {
$lineid=$row['ID_Line'];
echo '<h3>' . $row["Line_ShortName"] . ' - ' . $row["Line_Name"] . '</h3>';
}
}
echo '<div>
    <form name="addline" action="changeschedule.php" method="post">
        <select name="oldtime">
            <option value=\"\" disabled selected>Choose old time</option>';
            $sql = "SELECT * FROM `busschedule` WHERE ID_Line=$lineid";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
            echo "<option value='".$row["ID_Schedule"]."' >" . $row["Departure"] . " Day:".$row["Day_Type"]."</option>";
            }
            }
            echo '</select>
        <input type="text" name="newdepart" placeholder="Departure"/>
        <input type="text" name="daytype" placeholder="Day_Type"/>
        <button type="submit" class="btn btn-primary" name="submit"> Change </button>
    </form>
</div>';
}
function addsched()
{
    global $con;

    if(isset($_POST['lineid'])) {
        $query = "UPDATE `busschedule` SET `Departure`='" . $_POST['newdepart'] . "',`Day_Type`=" . $_POST['daytype'] . " WHERE `ID_Schedule`=" . $_POST['oldtime'] . "";
        $result = mysqli_query($con, $query);
        echo "nesto";
    }
}
