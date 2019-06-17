<?php
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

    <div class="w3-container w3-teal"><h4>Spisak rent a bike kompanija</h4></div>

    <div id="driverss">
        <div class="w3-responsive">
            <table class="w3-table-all">
                <tr>
                    <th>OPCIJE</th>
                    <th>Naziv komp.</th>
                    <th>Opis</th>
                    <th>Adresa 1</th>
                    <th>Adresa 2</th>
                    <th>Telefon 1</th>
                    <th>Telefon 2</th>
                </tr>
                <?php
                if(!($search)) {
                    $sql = "SELECT * from bikecompanies";
                    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

                    if (mysqli_num_rows($result) > 0) {
                        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                            echo '<tr>
<td><a href="edit_bike.php?bike=' . $record['ID_Bike'] . '">EDIT</a> </td><td>' . $record['Bike_Name'] . '
                       </td>
                       <td>' . $record['Bike_Description'] . '</td>
                        <td>' . $record['Address_Ln1'] . '</td>
                        <td> ' . $record['Address_Ln2'] . '</td>
                        <td>' . $record['Telephone_1'] . '</td>
                                                <td>' . $record['Telephone_2'] . '</td>
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