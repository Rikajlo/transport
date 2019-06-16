<?php
include_once ('../db_config.php');


@$taxiname = stripslashes($_POST['taxiname']);
@$taxiname = mysqli_real_escape_string($con,$taxiname);

@$taxidescription = stripslashes($_POST['taxidescription']);
@$taxidescription = mysqli_real_escape_string($con,$taxidescription);

@$taxistop1 = stripslashes($_POST['taxistop1']);
@$taxistop1 = mysqli_real_escape_string($con,$taxistop1);

@$taxistop2 = stripslashes($_POST['taxistop2']);
@$taxistop2 = mysqli_real_escape_string($con,$taxistop2);

@$taxiaddress1 = stripslashes($_POST['taxiaddress1']);
@$taxiaddress1 = mysqli_real_escape_string($con,$taxiaddress1);

@$taxiaddress2 = stripslashes($_POST['taxiaddress2']);
@$taxiaddress2 = mysqli_real_escape_string($con,$taxiaddress2);

@$taxitelephone1 = stripslashes($_POST['taxitelephone1']);
@$taxitelephone1 = mysqli_real_escape_string($con,$taxitelephone1);

@$taxitelephone2 = stripslashes($_POST['taxitelephone2']);
@$taxitelephone2 = mysqli_real_escape_string($con,$taxitelephone2);

@$taxilogo = stripslashes($_POST['fileToUpload']);
@$taxilogo = mysqli_real_escape_string($con,$taxilogo);

@$taxiid = stripslashes($_POST['taxiid']);
@$taxiid = mysqli_real_escape_string($con,$taxiid);

@$upload=$_POST['fileToUpload'];



if(!empty($_FILES['fileToUpload']))
{
    $path = "../images/taxi/";
    $taxilogo= date('Y-m-d-H-i-s').basename( $_FILES['fileToUpload']['name']);
    $path = $path . $taxilogo;

    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path)) {
        echo "The file ".  basename( $_FILES['fileToUpload']['name']).
            " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
}


if(empty($_POST['edit'])) {
    $sql = "INSERT INTO taxicompanies(Taxi_Name, Taxi_Description, GPS_Stop_1, GPS_Stop_2, Address_Ln1, Address_Ln2, Telephone_1, Telephone_2, Logo_Image) 
VALUES ('$taxiname','$taxidescription','$taxistop1','$taxistop2','$taxiaddress1','$taxiaddress2','$taxitelephone1','$taxitelephone2','$taxilogo')";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
} else {
    $sql = "UPDATE taxicompanies SET Taxi_Name='$taxiname' ,Taxi_Description='$taxidescription' ,GPS_Stop_1='$taxistop1' ,
GPS_Stop_2='$taxistop2' ,Address_Ln1='$taxiaddress1' ,Address_Ln2='$taxiaddress2'
 ,Telephone_1='$taxitelephone1' ,Telephone_2='$taxitelephone2'
        WHERE ID_Taxi=$taxiid";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

}
/*
header("Location: list_taxis.php");
exit();
*/
?>