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
        <h3>Edit news data</h3>
    </div>
    <?php

    if(@$_GET['news'])
    {
        $editnews=$_GET['news'];

        $sql = "SELECT * FROM busnews WHERE ID_news=$editnews LIMIT 1;";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                echo'

    <div id="Addnews">
        <form class="w3-container" method="post" action="xwrite_news.php">
            <div class="w3-row-padding">
               
               <input type="hidden" value="edit" name="edit">
               <input type="hidden" name="newsid" value="'.$editnews.'">
                    <label class="w3-text-teal"><b>Naslov vesti:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="newstitle" 
                    value="'.$record['News_Title'].'">

                    <label class="w3-text-teal"><b>Kratak opis:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="textarea" required="required" name="newsshort" value="'.$record['News_Short'].'">

                    <label class="w3-text-teal"><b>Cela vest:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="textarea" required="required" name="newsfull" value="'.$record['News_Full'].'">

                    <label class="w3-text-teal"><b>Važi do:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="time_expires" value="'.$record['Time_Expires'].'">

                    <label class="w3-text-teal"><b>Linije: (Kod linije)</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text"  name="showlines" value="'.$record['Show_Lines'].'">


                    <label class="w3-text-teal"><b>Stanice: (ID stajalista)</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" " name="showstops" value="'.$record['Show_Stops'].'">


                    <label class="w3-text-teal"><b>Svuda važi: (1) ili (0)</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text"  name="showall" value="'.$record['Show_All'].'">


                
               
            </div>
        <button class="w3-btn w3-blue-grey">Izmeni vest!</button><br/><p></p>
        </form>
    </div>';
            }
        } else {
            echo 'GREŠKA! ODABRANA VEST NE POSTOJI!';
        }

    } else {
        echo 'GREŠKA! VEST NIJE ODABRANA';
    }

    ?>


</div>
</body>
</html>