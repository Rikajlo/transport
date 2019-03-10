<?php
//include auth.php file on all secure pages
include_once("db_config.php");
include_once("menu.php");
include_once("functions.php");

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
            include("popupnews.php");
            ?>
            <h2>Spisak taxi kompanija u Subotici:</h2>

            <div class="busdeparture">
                <?php
                $sql = "SELECT * FROM `bikecompanies` order by `ID_Bike` desc";

                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                echo '<table class="biketable">
                    <tr><td rowspan="6" class="tabimg"><img class="img-fluid" src="images/bike/' . $row["Logo_Image"] . '" class="imgfilm" alt="Taxiimage"/></td>
                        <td class="naziv"><h3>' . $row["Bike_Name"] . '</h3></td></tr>
                    <tr><td class="zanr">' . $row["Bike_Description"] . ' </td></tr>
                    <tr><td class="opis">' . $row["Address_Ln1"] . '</td></tr>
                    <tr><td class="glumci">' . $row["Telephone_1"] . '</td></tr>
                    <tr><td class="termini"><a href="tel:' . $row["Telephone_1"] . '">POZOVITE BICIKLU!</a></td></tr>
                </table>';
                $bikecompset=$row['ID_Bike'];
                echo $bikecompset;
                     if($bikecompset){
echo 'test';
                    $sql2 = "SELECT * FROM `bikestations` where ID_Bike=$bikecompset order by Name_B asc";
                $result2 = $con->query($sql2);
                if ($result2->num_rows > 0) {
                    echo 'test33';
                    while ($row2 = $result2->fetch_assoc()) {

                        echo'
                    
                        <table class="biketable">
                    <tr><td rowspan="6" class="tabimg"><img class="img-fluid" src="images/bike/' . $row["Logo_Image"] . '" class="imgfilm2" alt="Taxiimage"/></td>
                        <td class="naziv"><h3>' . $row2["Name_B"] . '</h3></td></tr>
                    <tr><td class="zanr">' . $row2["Address_B"] . ' </td></tr>
                   
                    <tr><td class="termini"><a href="tel:' . $row["Telephone_1"] . '">POZOVITE TAXI!</a></td></tr>
                </table>';
                        $bikecompset=0;
                    }
                }
                }

                     }
                     }
                 else {
                echo "No taxis.";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
