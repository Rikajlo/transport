<?php
@session_start();
include_once('auth.php');
include_once ('../db_config.php');


@$bikename = stripslashes($_POST['bikename']);
@$bikename = mysqli_real_escape_string($con,$bikename);

@$bikedescription = stripslashes($_POST['bikedescription']);
@$bikedescription = mysqli_real_escape_string($con,$bikedescription);


@$bikeaddress1 = stripslashes($_POST['bikeaddress1']);
@$bikeaddress1 = mysqli_real_escape_string($con,$bikeaddress1);

@$bikeaddress2 = stripslashes($_POST['bikeaddress2']);
@$bikeaddress2 = mysqli_real_escape_string($con,$bikeaddress2);

@$biketelephone1 = stripslashes($_POST['biketelephone1']);
@$biketelephone1 = mysqli_real_escape_string($con,$biketelephone1);

@$biketelephone2 = stripslashes($_POST['biketelephone2']);
@$biketelephone2 = mysqli_real_escape_string($con,$biketelephone2);

@$bikelogo = stripslashes($_POST['fileToUpload']);
@$bikelogo = mysqli_real_escape_string($con,$bikelogo);

@$bikeid = stripslashes($_POST['bikeid']);
@$bikeid = mysqli_real_escape_string($con,$bikeid);

@$upload=$_POST['fileToUpload'];



if(!empty($_FILES['fileToUpload']))
{
    $path = "../images/bike/";
    $bikelogo= date('Y-m-d-H-i-s').basename( $_FILES['fileToUpload']['name']);
    $path = $path . $bikelogo;

    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path)) {
        echo "The file ".  basename( $_FILES['fileToUpload']['name']).
            " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
}


if(empty($_POST['edit'])) {
    $sql = "INSERT INTO bikecompanies(bike_Name, bike_Description, Address_Ln1, Address_Ln2, Telephone_1, Telephone_2, Logo_Image) 
VALUES ('$bikename','$bikedescription','$bikeaddress1','$bikeaddress2','$biketelephone1','$biketelephone2','$bikelogo')";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
} else {
    $sql = "UPDATE bikecompanies SET bike_Name='$bikename' ,bike_Description='$bikedescription' ,Address_Ln1='$bikeaddress1' ,Address_Ln2='$bikeaddress2'
 ,Telephone_1='$biketelephone1' ,Telephone_2='$biketelephone2'
        WHERE ID_bike=$bikeid";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

}

header("Location: list_bikes.php");
exit();

?>