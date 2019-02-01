<?php

// Connection to the database, and query related stuff to be included.
// THIS FILE IS FINISHED AND NEEDS NO FURTHER EDITING.

$con = mysqli_connect("localhost","phpmyadmin","iriswest2018","autobusevi");
mysqli_query($con,"SET NAMES utf8") or die (mysqli_error($con));
mysqli_query($con,"SET CHARACTER SET utf8") or die (mysqli_error($con));
mysqli_query($con,"SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
// Check connection
if (mysqli_connect_errno())
{
    echo "Neuspelo povezivanje na bazu podataka: " . mysqli_connect_error();
}
?>