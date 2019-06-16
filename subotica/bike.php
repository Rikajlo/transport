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
            <h2>Spisak Rent-a-Bike kompanija u Subotici:</h2>

            <div class="busdeparture">
                <?php
                $sql = "SELECT * FROM `bikecompanies` order by `ID_Bike` desc";

                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                echo '<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="images/bike/' . $row["Logo_Image"] . '" /></div>
						</div>
					
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">' . $row["Bike_Name"] . '</h3>
						
						<p class="product-description">' . $row["Bike_Description"] . '</p>

						<h5 class="sizes">Address: ' . $row["Address_Ln1"] . '
							
						</h5>
						<h5 class="colors">Phone: ' . $row["Telephone_1"] . '
							
						</h5>
						<div class="action">
							<a href="tel:' . $row["Telephone_1"] . '"><button class="btn btn-default" type="button">CALL</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>';
                $bikecompset=$row['ID_Bike'];
                     if($bikecompset){
echo '<div class="row"><h4>Bike stations</h4></div><div class="row">';
                    $sql2 = "SELECT * FROM `bikestations` where ID_Bike=$bikecompset order by Name_B asc";
                $result2 = $con->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {

                        echo'


<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="images/taxi/' . $row2["Logo_Image"] . '"" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">' . $row2["Name_B"] . '</a>
                            </h4>
                            <h5>' . $row["Telephone_1"] . '</h5>
                            <p class="card-text">' . $row2["Address_B"] . '</p>

                        </div>
                        
                    </div>
                </div>';

                    }
                    $bikecompset=0;
                    echo '</div>';
                }
                }

                     }
                     }
                 else {
                echo "No bikes.";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
