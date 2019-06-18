<?php
include_once ('../db_config.php'); ?>

<html>
<head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<?php include 'sidebar.php';?>
<div style="margin-left:250px">

    <div class="w3-container w3-teal">
        <h3>Edit taxi data</h3>
    </div>
    <?php

    if(@$_GET['taxi'])
    {
        $edittaxi=$_GET['taxi'];

        $sql = "SELECT * FROM taxicompanies WHERE ID_Taxi=$edittaxi LIMIT 1;";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                echo'

    <div id="Addtaxi">
        <form class="w3-container" method="post" action="xwrite_taxi.php">
            <div class="w3-row-padding">
               <div class="w3-half">
               <input type="hidden" value="edit" name="edit">
               <input type="hidden" name="taxiid" value="'.$edittaxi.'">
                    <label class="w3-text-teal"><b>Naziv taksi kompanije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxiname" 
                    value="'.$record['Taxi_Name'].'">

                    <label class="w3-text-teal"><b>Opis taksi kompanije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxidescription" value="'.$record['Taxi_Description'].'">

                    <label class="w3-text-teal"><b>GPS 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxistop1" value="'.$record['GPS_Stop_1'].'">

                    <label class="w3-text-teal"><b>GPS 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="taxistop2" value="'.$record['GPS_Stop_2'].'">

                    <label class="w3-text-teal"><b>Adresa 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxiaddress1" value="'.$record['Address_Ln1'].'">

                    <label class="w3-text-teal"><b>Adresa 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text"  name="taxiaddress2" value="'.$record['Address_Ln2'].'">

                </div>
                <div class="w3-half">
                    <label class="w3-text-teal"><b>Telefon 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxitelephone1" value="'.$record['Telephone_1'].'">

                    <label class="w3-text-teal"><b>Telefon 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="taxitelephone2" value="'.$record['Telephone_2'].'">

                    <label class="w3-text-teal"><b>Putanja ka logou:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="fileToUpload" value="'.$record['Logo_Image'].'">

                     </div>
            </div>
        <button class="w3-btn w3-blue-grey">Izmeni taxi kompaniju!</button><br/><p></p>
        </form>
    </div>';
            }
        } else {
            echo 'GREŠKA! ODABRANI TAXI NE POSTOJI!';
        }

    } else {
        echo 'GREŠKA! TAXI NIJE ODABRAN';
    }

    ?>


</div>
</body>
</html>