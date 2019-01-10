<?php
session_start();
// Destroys all sessions.
if(session_destroy())
{
// Redirecting To Home Page
    header("Location: index.php");
}
?>