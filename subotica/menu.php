<?php
@session_start();
echo '

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Javni Prevoz Subotica</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Početna</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="buslines.php">Red Vožnje</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="taxi.php">Taxi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="bike.php">Rent-a-Bike</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="news.php">News</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="../szeged/index.php">Visit Szeged!</a>
      </li>';
        if(isset($_SESSION['ID_User'])){
        echo'
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log out</a>
      </li>'; }
      else {
    echo'
      <li class="nav-item">
        <a class="nav-link" href="login.php">Log in</a>
      </li>';
      }
      echo'
    </ul>
  </div>
</nav>

';

 ?>