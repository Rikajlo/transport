<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <META NAME="author" CONTENT="Martin Kiš, Daniel Ištvan">
    <META NAME="Description" CONTENT="Stajališni red vožnje na teritoriji grada Subotica, unesite naziv željene stanice i saznajte za koliko minuta stiže sledeći autobus.">
    <META NAME="Keywords" CONTENT="javni prevoz, gradski saobracaj, subotica, linija, autobus, stajaliste, stanica, javni prevoz u subotici">
    <META NAME="Geography" CONTENT="Subotica, Serbia">
    <META NAME="Language" CONTENT="Serbian">
    <META NAME="distribution" CONTENT="Global">
    <META NAME="Robots" CONTENT="INDEX,FOLLOW">
    <META NAME="zipcode" CONTENT="24000">
    <META NAME="city" CONTENT="Subotica">
    <META NAME="country" CONTENT="Serbia">
    <link rel="stylesheet" href="css/style.css" />

    <link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body>
<?php
// Log-in page.
require('db_config.php');
include_once('menu.php');
@session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);
    //Checking is user existing in the database or not
    $query = "SELECT ID_User, Username, Password, IsAdmin  FROM `users` WHERE Username='$username'
and password='".md5($password)."'";
    $result = mysqli_query($con,$query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        @session_start();
        $_SESSION['username'] = $username;
        while($row = $result->fetch_assoc()) {
            $userid = $row['ID_User'];
            $_SESSION['ID_User'] = $row['ID_User'];
            $_SESSION['isadmin'] = $row['IsAdmin'];
        }
        // Redirect user to index.php
        header("Location: index.php");
    }else{
        echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
    }
}else{
    ?>
    <div class="form">
        <h1>Prijava</h1>
        <form action="" method="post" name="login">
            <input type="text" name="username" placeholder="Korisničko ime" required />
            <input type="password" name="password" placeholder="Lozinka" required />
            <input name="submit" type="submit" value="Prijava" />
        </form>
        <p>Niste registrovani? <a href='registration.php'>Registrujte se ovde!</a></p>
    </div>
<?php }  ?>





</body>
</html>