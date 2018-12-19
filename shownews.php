<?php
// News for the news.php page are selected here
include_once("db_config.php");
include_once('menu.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vesti</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
            <?php
@$newsid = $_GET['newsid'];
if(isset($_POST['newcomment'])){
    $newcommnet = $_POST['newcomment'];
    $newsid = $_POST['newsid'];
    $line='';
    foreach ($_POST['lines'] as $lines)
        $line .= " ".$lines;
    $query = "INSERT into `buscomments` (ID_News, ID_User, Comment_Content, Show_Lines)
              VALUES ($newsid,1,'$newcommnet','$line')";//$_SESSION["ID_User"]
    $result = mysqli_query($con,$query);
    header('Location: news.php?newsid='.$newsid.'');
}
$sql = "SELECT * FROM `busnews` WHERE ID_News=$newsid";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class=\"w3-container\">
            <div class=\"w3-panel w3-blue w3-card-4\">
                <h3>" . $row["News_Title"] . "</h3><p>" . $row["News_Short"] . "<br/><br/>" . $row["News_Full"] . "<br/> 
                Posted on:  " . $row["Time_Posted"] . "</p>
            </div>
            COMMENTS:
            <div>
            <form name=\"commentpost\" action=\"shownews.php\" method=\"post\">
                <input type=\"hidden\" value=\"$newsid\" name=\"newsid\" />
                <textarea class=\"form-control\" name=\"newcomment\" rows=\"4\" required></textarea>
                <select class=\"dropdown-primary\" name='lines[ ]' multiple size='3'>
                    <option value=\"\" disabled selected>Choose lines</option>";
                    selectlines($con);
                echo "</select>
                <button type=\"submit\" class=\"btn btn-primary\" name=\"submit\"> Post Comment </button>
            </form>
        </div>";

        $sql = "SELECT *, u.Username as uname FROM buscomments b JOIN users u ON b.ID_User = u.ID_User 
              WHERE ID_News=$newsid ORDER BY Time_Posted DESC";
        $result = $con->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $showlines = explode(" ",$row["Show_Lines"]);
                echo "<div class=\"w3-panel w3-light-gray w3-card-4\">
                    <p><b>" . $row["uname"] . "</b> &nbsp; <small>" . timeAgo($row["Time_Posted"]) . "</small></p>
                    <p>" . $row["Comment_Content"] . "<br/></p>";
                    foreach($showlines as $line){
                    echo "<a href='buslines.php?line=$line'>$line</a> ";};
                echo "</div>";
            }
               echo "</div>";
        } else {
            echo "NO COMMENTS FOR THIS POST.";
        }
    }
}
?>



</body>
</html>






