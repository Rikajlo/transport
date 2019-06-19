<?php
if(!isset($_GET["notify"]))
    header("Location: testing.php?notify=".$_SERVER["HTTP_USER_AGENT"]);


$notify = $_GET["notify"];
echo $notify;