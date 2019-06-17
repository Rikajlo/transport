<?php
include_once ('../db_config.php'); ?>

<html>
<head>
    <?php include '..meta/meta.php';?>
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
        <form class="w3-container" name="addline" action="xwrite_line.php" method="post">
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-teal"><b>ID Linije:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="lineid" placeholder="ID_Line"/>
                    <label class="w3-text-teal"><b>Kod Linije:</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="lineshort" placeholder="Line_ShortName"/>
                    <label class="w3-text-teal"><b>Naziv Linije:</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="linename" placeholder="Line_Name"/><br/>
                    <label class="w3-text-teal"><b>Smer Linije:</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="linedir" placeholder="Line_Direction"/>
                    <label class="w3-text-teal"><b>Tekst u redu vožnje:</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="linetext" placeholder="Line_Text"/>
                    <label class="w3-text-teal"><b>Strana 0 ili 1</b></label>

                    <input class="w3-input w3-border w3-light-grey" type="text" name="lineside" placeholder="Line_Side"/><br/><br/>
                    <button class="w3-btn w3-blue-grey">Dodaj autobusku liniju!</button><br/><p></p>

        </form>
    </div>
</div>
</body>
</html>