<?php
@session_start();
include_once('auth.php');
include_once ('../db_config.php'); ?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<?php include 'sidebar.php';?>
<div style="margin-left:250px">

    <div class="w3-container w3-teal">
        <h3>Edit bike data</h3>
    </div>
    <?php

    if(@$_GET['bike'])
    {
        $editbike=$_GET['bike'];

        $sql = "SELECT * FROM bikecompanies WHERE ID_Bike=$editbike LIMIT 1;";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                echo'

    <div id="Addbike">
        <form class="w3-container" method="post" action="xwrite_bike.php">
            <div class="w3-row-padding">
               <div class="w3-half">
               <input type="hidden" value="edit" name="edit">
               <input type="hidden" name="bikeid" value="'.$editbike.'">
                    <label class="w3-text-teal"><b>Naziv rent a bike kompanije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="bikename" 
                    value="'.$record['Bike_Name'].'">

                    <label class="w3-text-teal"><b>Opis rent a bike kompanije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="bikedescription" value="'.$record['Bike_Description'].'">

                        <label class="w3-text-teal"><b>Adresa 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="bikeaddress1" value="'.$record['Address_Ln1'].'">

                    <label class="w3-text-teal"><b>Adresa 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text"  name="bikeaddress2" value="'.$record['Address_Ln2'].'">

                </div>
                <div class="w3-half">
                    <label class="w3-text-teal"><b>Telefon 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="biketelephone1" value="'.$record['Telephone_1'].'">

                    <label class="w3-text-teal"><b>Telefon 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="biketelephone2" value="'.$record['Telephone_2'].'">

                    <label class="w3-text-teal"><b>Putanja ka logou:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="fileToUpload" value="'.$record['Logo_Image'].'">

                     </div>
            </div>
        <button class="w3-btn w3-blue-grey">Izmeni bike kompaniju!</button><br/><p></p>
        </form>
    </div>';
            }
        } else {
            echo 'GREŠKA! ODABRANI bike NE POSTOJI!';
        }

    } else {
        echo 'GREŠKA! bike NIJE ODABRAN';
    }

    ?>


</div>
</body>
</html>