<?php
@session_start();
include_once('auth.php');
include_once ('../db_config.php'); ?>

<html>
<head>
    <?php include('../meta/meta.php'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<?php include 'sidebar.php';?>


<div style="margin-left:250px; font-size:12px;">

    <div class="w3-container w3-teal"><h3>Spisak autobuskih linija</h3></div>

    <div id="driverss">
        <div class="w3-responsive">
        <table class="w3-table-all">
            <tr>
                <th>OPCIJE</th>
                <th>ID Linije</th>
                <th>Linija</th>
                <th>Naziv Linije</th>
                <th>Smer Linije</th>
                <th>Tekst</th>
                <th>Strana</th>
            </tr>
            <?php
            if(!($search)) {
                $sql = "SELECT * from buslines";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                if (mysqli_num_rows($result) > 0) {
                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		
                        echo '<tr>
<td><a href="edit_buslines.php?line=' . $record['ID_Line'] . '">EDIT</a> </td><td>' . $record['ID_Line'] . '
                       </td>
                       <td>' . $record['Line_ShortName'] . '</td>
                        <td>' . $record['Line_Name'] . '</td>
                        <td> ' . $record['Line_Direction'] . '</td>
                        <td>' . $record['Line_Text'] . '</td>
                                                <td>' . $record['Line_Side'] . '</td>
  </tr>';
                    }
                }
            }


            ?>


        </table>
        </div>
    </div>

</div>
</body>

</html>