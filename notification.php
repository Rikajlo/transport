<?php
include('db_config.php');
include('functions.php');

if(isset($_REQUEST['line'])){
    $line=$_REQUEST['line'];
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
    <?php include_once("include/meta.php"); ?>

    <link rel="stylesheet" href="../css/bootstrap.css">

</head>
<body>
<?php
include('menu.php');
?>


<div class="row">
    <div class="col-lg-3 col-md-3 col-12"><?php include('sidemenu.php'); ?></div>
    <div class="col-lg-9 col-md-9 col-12">
        <?php

        @$notif = stripslashes(@$_REQUEST['id']);
        @$notif = mysqli_real_escape_string($con,@$notif);

        $sql = "SELECT * FROM `notifications` WHERE ID_Notification=$notif LIMIT 1";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class=\"w3-container\">
    <div class=\"w3-panel w3-blue w3-card-4\">
        <h3>
 ".$row["News_Title"]. "</h3><p>". $row["News_Short"]."<br/>". $row["News_Image"]."<br/> Posted on:  ".$row["Date_Published"]."</p>
</div>
</div>";
            }
        } else {
            echo "Not available.";
        }


        ?>
    </div>
</div>

<?php include_once 'include/footer.php'; ?>
