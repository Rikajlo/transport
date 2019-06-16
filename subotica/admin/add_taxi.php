<?php
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
        <h3>Add a taxi</h3>
    </div>
    <div id="AddCustomer">
        <form class="w3-container" method="post" enctype="multipart/form-data" action="xwrite_taxi.php" >
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-teal"><b>Naziv taxi kompanije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxiname">

                    <label class="w3-text-teal"><b>Opis taxi kompanije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxidescription">

                    <label class="w3-text-teal"><b>GPS Stajališta 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxistop1">

                    <label class="w3-text-teal"><b>GPS Stajališta 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="taxistop2">

                    <label class="w3-text-teal"><b>Adresa 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxiaddress1">

                    <label class="w3-text-teal"><b>Adresa 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="taxiaddress2">

                </div>
                <div class="w3-half">
                    <label class="w3-text-teal"><b>Telefon 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="taxitelephone1">

                    <label class="w3-text-teal"><b>Telefon 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="taxitelephone2">

                    <label class="w3-text-teal"><b>Logo:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="file"  name="uploadedimage">


                </div>
            </div>



            <button class="w3-btn w3-blue-grey">Dodaj taxi kompaniju!</button><br/><p></p>
        </form>
    </div>

</div>
