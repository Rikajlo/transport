<?php
include_once ('../db_config.php'); ?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<?php include 'sidebar.php';?>
<?php
$search=0;
$numsearch=0;
@$searchtaxiName=stripslashes(@$_REQUEST['taxiName']);
@$searchtaxiName=mysqli_real_escape_string($con,@$searchtaxiName);
@$searchtaxiDescription=stripslashes(@$_REQUEST['taxiDescription']);
@$searchtaxiDescription=mysqli_real_escape_string($con,@$searchtaxiDescription);
@$searchAddress=stripslashes(@$_REQUEST['address']);
@$searchAddress=mysqli_real_escape_string($con,@$searchAddress);
@$searchtelephone1=stripslashes(@$_REQUEST['telephone1']);
@$searchtelephone1=mysqli_real_escape_string($con,@$searchtelephone1);

if((@$searchtaxiName or @$searchtaxiDescription or @$searchAddress or @$searchtelephone1)>0)
{ @$search=1;
    if(@$searchtaxiName>0){$numsearch++;}
    if(@$searchtaxiDescription>0){$numsearch++;}
    if(@$searchAddress>0){$numsearch++;}
    if(@$searchtelephone1>0){$numsearch++;}
}else{
    @$search=0;
}

?>
<div style="margin-left:250px; font-size:12px;">

    <div class="w3-container w3-teal"><h4>Search</h4></div>
    <div id="searchdrivers" >
        <form name="driversearch" action="" method="post">
            <div class="w3-threequarter">
                <div class="w3-quarter"><input class="w3-input w3-light-gray" type="text" name="taxiName" placeholder="Naziv taxi kompanije" /></div>
                <div class="w3-quarter"><input class="w3-input w3-light-gray" type="text" name="taxiDescription" placeholder="Opis" /></div>
                <div class="w3-quarter"><input class="w3-input w3-light-gray" type="text" name="address" placeholder="Adresa 1" /></div>
                <div class="w3-quarter"><input class="w3-input w3-light-gray" type="text" name="telephone1" placeholder="Telefon 1" /></div>
            </div>
            <div class="w3-quarter">
                <input type="submit" class="w3-button w3-indigo w3-block"name="submit" value="Search customers!" />
            </div>
        </form>
    </div>

    <div class="w3-container w3-teal"> <h4>Spisak Taxi kompanija</h4></div>
    <div id="driverss">
        <div class="w3-responsive">
        <table class="w3-table-all">
            <tr>
                <th>OPCIJE</th>
                <th>Naziv kompanije</th>
                <th>Opis kompanije</th>
                <th>Adresa 1</th>
                <th>Adresa 2</th>
                <th>Telefon 1</th>
                <th>Telefon 2</th>
            </tr>
            <?php
            if(!($search)) {
                $sql = "SELECT * from taxicompanies";
                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

                if (mysqli_num_rows($result) > 0) {
                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		
                        echo '<tr>
<td><a href="edit_taxi.php?taxi=' . $record['ID_Taxi'] . '">EDIT</a> </td><td>' . $record['Taxi_Name'] . '
                       </td>
                       <td>' . $record['Taxi_Description'] . '</td>
                        <td>' . $record['Address_Ln1'] . '</td>
                        <td> ' . $record['Address_Ln2'] . '</td>
                        <td>' . $record['Telephone_1'] . '</td>
                                                <td>' . $record['Telephone_2'] . '</td>
  </tr>';
                    }
                }
            }


            ?>

            <?php
            if($search) {
                if ( isset($_REQUEST['taxiName']) || isset($_REQUEST['taxiDescription']) || isset($_REQUEST['address']) || isset($_REQUEST['telephone1']) ) {
                    $clause = "where ";
                    $conds = [];
                    if (!empty($_POST['taxiName'])) $conds[] = "Taxi_Name LIKE '{$searchtaxiName}%'";
                    if (!empty($_POST['taxiDescription'])) $conds[] = "Taxi_Description LIKE '{$searchtaxiDescription}%'";
                    if (!empty($_POST['address'])) $conds[] = "Address_Ln1 LIKE '{$searchAddress}%'";
                    if (!empty($_POST['telephone1'])) $conds[] = "Telephone_1 LIKE '{$searchtelephone1}%'";
                    if (count($conds) > 0) {
                        $clause .= (count($conds) == 1) ? $conds[0] : implode(' AND ', $conds);
                    }
                }


                $sql = "SELECT * from taxicompanies $clause;";
                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

                if (mysqli_num_rows($result) > 0) {
                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                        
                        echo '<tr>
<td><a href="edit_taxi.php?taxi=' . $record['ID_Taxi'] . '">EDIT</a> </td><td>' . $record['Taxi_Name'] . '
                       </td>
                                               <td>' . $record['Taxi_Description'] . '</td>

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