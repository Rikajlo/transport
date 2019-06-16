
<?php
include_once('functions.php');

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







