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
        <h3>Add a bike</h3>
    </div>
    <div id="AddCustomer">
        <form class="w3-container" method="post" enctype="multipart/form-data" action="xwrite_bike.php" >
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-teal"><b>Naziv rent a bike kompanije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="bikename">

                    <label class="w3-text-teal"><b>Opis bike kompanije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="bikedescription">

                    <label class="w3-text-teal"><b>Adresa 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="bikeaddress1">

                    <label class="w3-text-teal"><b>Adresa 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="bikeaddress2">

                </div>
                <div class="w3-half">
                    <label class="w3-text-teal"><b>Telefon 1:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="biketelephone1">

                    <label class="w3-text-teal"><b>Telefon 2:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="biketelephone2">

                    <label class="w3-text-teal"><b>Logo:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="file"  name="fileToUpload">


                </div>
            </div>



            <button class="w3-btn w3-blue-grey">Dodaj rent a bike kompaniju!</button><br/><p></p>
        </form>
    </div>

</div>
