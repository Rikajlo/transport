<?php
//include auth.php file on all secure pages
include_once("db_config.php");
include_once("functions.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

<?php include_once ('meta/meta.php');
?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



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
</body>
</html>
