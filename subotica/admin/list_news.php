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
<?php
$search=0;
$numsearch=0;
@$searchnewsTitle=stripslashes(@$_REQUEST['newsTitle']);
@$searchnewsTitle=mysqli_real_escape_string($con,@$searchnewsTitle);
@$searchnewsShort=stripslashes(@$_REQUEST['newsShort']);
@$searchnewsShort=mysqli_real_escape_string($con,@$searchnewsShort);
@$searchtimePosted=stripslashes(@$_REQUEST['timePosted']);
@$searchtimePosted=mysqli_real_escape_string($con,@$searchtimePosted);
@$searchtimeExpires=stripslashes(@$_REQUEST['timeExpires']);
@$searchtimeExpires=mysqli_real_escape_string($con,@$searchtimeExpires);

if((@$searchnewsTitle or @$searchnewsShort or @$searchtimePosted or @$searchtimeExpires)>0)
{ @$search=1;
    if(@$searchnewsTitle>0){$numsearch++;}
    if(@$searchnewsShort>0){$numsearch++;}
    if(@$searchtimePosted>0){$numsearch++;}
    if(@$searchtimeExpires>0){$numsearch++;}
}else{
    @$search=0;
}

?>
<div style="margin-left:250px; font-size:12px;">

    <div class="w3-container w3-teal"><h4>Pretraga Vesti</h4></div>
    <div id="searchdrivers" >
        <form name="driversearch" action="" method="post">
            <div class="w3-threequarter">
                <div class="w3-quarter"><input class="w3-input w3-light-gray" type="text" name="newsTitle" placeholder="Naslov Vesti" /></div>
                <div class="w3-quarter"><input class="w3-input w3-light-gray" type="text" name="newsShort" placeholder="Opis" /></div>
                <div class="w3-quarter"><input class="w3-input w3-light-gray" type="text" name="timePosted" placeholder="Vest postavljena" /></div>
                <div class="w3-quarter"><input class="w3-input w3-light-gray" type="text" name="timeExpires" placeholder="Važi do" /></div>
            </div>
            <div class="w3-quarter">
                <input type="submit" class="w3-button w3-indigo w3-block"name="submit" value="Pretraga!" />
            </div>
        </form>
    </div>

    <div class="w3-container w3-teal"> <h4>Spisak Vesti</h4></div>
    <div id="driverss">
        <div class="w3-responsive">
        <table class="w3-table-all">
            <tr>
                <th>OPCIJE</th>
                <th>Naslov</th>
                <th>Ukratko</th>
                <th>Postavljeno</th>
                <th>Važi do</th>
                <th>Svuda</th>
                <th>Linije</th>
            </tr>
            <?php
            if(!($search)) {
                $sql = "SELECT * from busnews";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                if (mysqli_num_rows($result) > 0) {
                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

		
                        echo '<tr>
<td><a href="edit_news.php?news=' . $record['ID_News'] . '">EDIT</a> </td><td>' . $record['News_Title'] . '
                       </td>
                       <td>' . $record['News_Short'] . '</td>
                        <td>' . $record['Time_Posted'] . '</td>
                        <td> ' . $record['Time_Expires'] . '</td>
                        <td>' . $record['Show_All'] . '</td>
                                                <td>' . $record['Show_Lines'] . '</td>
  </tr>';
                    }
                }
            }


            ?>

            <?php
            if($search) {
                if ( isset($_REQUEST['newsTitle']) || isset($_REQUEST['newsShort']) || isset($_REQUEST['timePosted']) || isset($_REQUEST['timeExpires']) ) {
                    $clause = "where ";
                    $conds = [];
                    if (!empty($_POST['newsTitle'])) $conds[] = "News_Title LIKE '{$searchnewsTitle}%'";
                    if (!empty($_POST['newsShort'])) $conds[] = "News_Short LIKE '{$searchnewsShort}%'";
                    if (!empty($_POST['timePosted'])) $conds[] = "Time_Posted LIKE '{$searchtimePosted}%'";
                    if (!empty($_POST['timeExpires'])) $conds[] = "Time_Expires LIKE '{$searchtimeExpires}%'";
                    if (count($conds) > 0) {
                        $clause .= (count($conds) == 1) ? $conds[0] : implode(' AND ', $conds);
                    }
                }


                $sql = "SELECT * from busnews $clause;";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                if (mysqli_num_rows($result) > 0) {
                    while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                        echo '<tr>
<td><a href="edit_news.php?news=' . $record['ID_News'] . '">EDIT</a> </td><td>' . $record['News_Title'] . '
                       </td>
                       <td>' . $record['News_Short'] . '</td>
                        <td>' . $record['Time_Posted'] . '</td>
                        <td> ' . $record['Time_Expires'] . '</td>
                        <td>' . $record['Show_All'] . '</td>
                                                <td>' . $record['Show_Lines'] . '</td>
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