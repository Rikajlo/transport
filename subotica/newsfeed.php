
<?php
include_once('functions.php');

$sql = "SELECT * FROM `busnews` ORDER BY Time_Posted DESC ";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<a href='news.php?newsid=".$row["ID_News"]."' class='news'><div class=\"w3-container\">
    <div class=\"w3-panel w3-blue w3-card-4\">
        <h3>
 ".$row["News_Title"]. "</h3><p>". $row["News_Short"]."<br/>". $row["News_Full"]."<br/> Posted on:  ".$row["Time_Posted"]."</p>
</div>
</div></a>";
    }
} else {
    echo "No news.";
}





