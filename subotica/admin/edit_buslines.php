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
        <h3>Edit line data</h3>
    </div>
    <?php

    if(@$_GET['line'])
    {
        $editline=$_GET['line'];

        $sql = "SELECT * FROM buslines WHERE ID_Line=$editline LIMIT 1;";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                echo'

    <div id="Addline">
        <form class="w3-container" method="post" action="xwrite_line.php">
            <div class="w3-row-padding">
               <div class="w3-half">
               <input type="hidden" value="edit" name="edit">
               <input type="hidden" name="lineid" value="'.$editline.'">
                    <label class="w3-text-teal"><b>Kod linije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="lineshort" 
                    value="'.$record['Line_ShortName'].'">

                    <label class="w3-text-teal"><b>Naziv linije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="linename" value="'.$record['Line_Name'].'">

                    <label class="w3-text-teal"><b>Smer linije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="linedir" value="'.$record['Line_Direction'].'">

                    <label class="w3-text-teal"><b>Tekst linije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="linetext" value="'.$record['Line_Text'].'">

                    <label class="w3-text-teal"><b>Strana linije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="lineside" name="lineside" value="'.$record['Line_Side'].'">


                </div>
               
            </div>
        <button class="w3-btn w3-blue-grey">Izmeni autobusku liniju!</button><br/><p></p>
        </form>
    </div>';
            }
        } else {
            echo 'GREŠKA! ODABRANI line NE POSTOJI!';
        }

    } else {
        echo 'GREŠKA! line NIJE ODABRAN';
    }

    ?>


</div>
</body>
</html>