<?php
include('szedb.php');

if (isset($_SESSION['isadminszeged']))
    header("Location: indexszeged.php");

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
    $query = "SELECT ID_User, Username, Password, IsAdmin  FROM `users` WHERE Username='$username' and IsAdmin=1
and password='".md5($password)."'";
    $result = mysqli_query($con,$query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        @session_start();
        $_SESSION['username'] = $username;
        while($row = $result->fetch_assoc()) {
            $userid = $row['ID_User'];
            $_SESSION['ID_User'] = $row['ID_User'];
            $_SESSION['isadminszeged'] = $row['IsAdmin'];
        }
        // Redirect user to index.php
        header("Location: indexszeged.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notifications - Szeged</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>

<div class="container">
    <h2>Login Szeged Admin</h2>
    <form class="form-horizontal" action="" method="post" name="login">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-default btn-primary">Submit</button> &nbsp;
        <a class="btn btn-primary" href="index.php">Returnt</a>
    </form>
</div>
<?php include_once("footer.php") ?>
</body>
</html>
