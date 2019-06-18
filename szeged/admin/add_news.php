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
        <form class="w3-container" name="addline" action="xwrite_news.php" method="post">
            <div class="w3-row-padding">

                    <label class="w3-text-teal"><b>Naslov vesti:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" required="required" name="newstitle"
                           value="'.$record['News_Title'].'">

                    <label class="w3-text-teal"><b>Kratak opis:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="textarea" required="required" name="newsshort" >

                    <label class="w3-text-teal"><b>Cela vest:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="textarea" required="required" name="newsfull" >

                    <label class="w3-text-teal"><b>Važi do:</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="datetime" name="timeexpires" >

                    <label class="w3-text-teal"><b>Linije: (Kod linije)</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text"  name="showlines" value="*">


                    <label class="w3-text-teal"><b>Stanice: (ID stajalista)</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text"  name="showstops" value="*">


                    <label class="w3-text-teal"><b>Svuda važi: (1) ili (0)</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text"  name="showall" value="1">


            </div>
            <button class="w3-btn w3-blue-grey">Dodaj vest!</button><br/><p></p>


        </form>
    </div>
</div>
</body>
</html>