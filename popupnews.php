<?php
// Pop up with the latest news for index.php
include_once("db_config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<?php
$sql = "SELECT * FROM `busnews` ORDER BY Time_Posted DESC LIMIT 1";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " <div class=\"w3-panel w3-yellow w3-display-container\">
  <span onclick=\"this.parentElement.style.display='none'\"
        class=\"w3-button w3-yellow w3-large w3-display-topright\">x</span><h3>
 ".$row["News_Title"]. "</h3>". $row["News_Short"]."<br/>". $row["News_Full"]."<br/> Posted on:  ".$row["Time_Posted"]."</p>
</div>";
    }
} else {
    echo "No news.";
}
?>

</body>
</html>






