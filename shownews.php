<?php
// News for the news.php page are selected here
include_once("db_config.php");
@session_start();
include_once('functions.php');

@$ID_User=$_SESSION['ID_User'];

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
addComment();

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
            COMMENTS:";

        if (isset($ID_User)) {

            echo "<div>
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
        }
        getComment($newsid);
    }
}
?>



</body>
</html>






