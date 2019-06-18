<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
    <?php include_once("include/meta.php"); ?>

    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<?php
require('db_config.php');
include ("menu.php");
?>
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-3 content1-left">
            <?php
            //include("sidemenu.php")
            ?>
</div>
<div class="col-sm-9 content1-right">
    <?php
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
    // removes backslashes
    $username = stripslashes($_POST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con,$password);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con,$email);
    $trn_date = date("Y-m-d H:i:s");
    echo 'test';
    $query = "INSERT into `users` (username, password, email)
    VALUES ('$username', '".md5($password)."', '$email')";
    $result = mysqli_query($con,$query);
    if($result){
    echo "<div class='form'>
        <h3>You are registered successfully.</h3>
        <br/>Click here to <a href='login.php'>Login</a></div>";
    }
    }else{
    ?>
    <div class="form">
        <h1>Registration</h1>
        <form name="registration" action="" method="post">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="submit" name="submit" value="Register" />
        </form>
    </div>
    <?php } ?>
</div></div></div>

<?php include_once 'include/footer.php'; ?>
