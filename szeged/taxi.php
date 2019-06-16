<?php
//include auth.php file on all secure pages
include_once("db_config.php");
include_once("functions.php");

?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once("include/meta.php"); ?>

    <title>Taxi</title>

</head>
<body>
<?php include_once("menu.php"); ?>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-3 content1-left">
            <?php
            include("sidemenu.php")
            ?>
        </div>
        <div class="col-sm-9 content1-right" style="min-height: 100%;">
            <?php
            include("popupnews.php");
            ?>
            <h2>Spisak taxi kompanija u Subotici:</h2>

            <div class="busdeparture">
                <div class="row">
                <?php
                $sql = "SELECT * FROM `taxicompanies` order by `ID_Taxi` desc";

                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                echo '<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="images/taxi/' . $row["Logo_Image"] . '"" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">' . $row["Taxi_Name"] . '</a>
                            </h4>
                            <h5>' . $row["Telephone_1"] . '</h5>
                            <p class="card-text">' . $row["Taxi_Description"] . '</p>
                            <p class="card-text">' . $row["Address_Ln1"] . '</p>

                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><a href="tel:' . $row["Telephone_1"] . '">POZOVITE TAXI!</a></small>
                        </div>
                    </div>
                </div>';
                }
                } else {
                echo "Nema gi.";
                }
                ?>
                </div>
            </div>


        </div>
    </div>
</div>

<?php include_once 'include/footer.php'; ?>
