<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ustawienia użytkownika | NiezłeKwiatki.pl</title>
    <link rel="icon" type="image/x-icon" src="img/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    include 'autoryzacja.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
    session_start();
    ?>
  </head>
  <body>
   <!-- NAVBAR -->
   <nav class="navbar navbar-expand-lg bg-success mb-3">
    <div class="container-fluid">
    <a class="navbar-brand" href="./index.php"
      ><img
        class="d-inline-block align-top"
        src="./img/logo.png"
        width="60"
        height="60"
    /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon pe-3"></span>
      </button>
    <div class="collapse navbar-collapse justify-content-around flex-column flex-lg-row justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav">
          <li class="nav-item text-center mx-2 py-3">
                <input
                  class="form-control"
                  type="search"
                  placeholder="Szukaj!"
                  aria-label="Search">
              </li>
              <li class="nav-item mx-2 align-self-center mx-2">
                  <button
                    class="nav-item btn btn-secondary"
                    type='button'
                    onClick="Swal.fire({title: 'Szlachta nie pracuje', imageUrl: 'https://www.mygam.pl/static/208472b16dc6e1813c4749673b7b9b8b/pepega.png'})"
                  >
                    Wyszukaj
                  </button>
              </li>
              <?php
              if (!isset($_SESSION['user_id'])) {
                echo '<li class="nav-item align-self-center mx-2 py-3 py-lg-0" id="">';
                echo '<a class="nav-item btn btn-info ms-auto" type="button" href="./login.html">Zaloguj się!</a>';
                echo '</li>';
              }
              else {
                echo '<div class="nav-item btn-group mx-2 py-3 py-lg-0 align-self-center">';
                echo '<button type="button" class="btn btn-info dropdown-toggle"data-bs-toggle="dropdown" aria-expanded="false">';
                echo $_SESSION['username'];
                echo '</button>';
                echo '<ul class="dropdown-menu">';
                echo '<li><a class="dropdown-item" href="user.php">Panel użytkownika</a></li>';
                echo '<li><a class="dropdown-item" href="usersettings.php">Ustawienia</a></li>';
                echo '<li><hr class="dropdown-divider"></li>';
                echo '<li><a class="dropdown-item" href="logout.php">Wyloguj się!</a></li>';
                echo '</ul>';
                echo '</div>';
              }
              ?>
      </ul>
    </div>
  </div>
  </nav>
  <!-- END OF NAVBAR -->
<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
if (!isset($_SESSION['username'])) {
    echo "Nie zalogowano jako żaden użytkownik :c";
    exit();
    }
if (isset($_GET['msg'])) 
      echo '<h1 class="text-center">'.$_GET['msg'].'</h1>';
?>
<h1 class="text-center p-3">Panel użytkownika - czuj się jak u siebie w domu!</h1>
<div class="border border-success col-md-8 offset-md-2 text-center p-3">
    <p>Zmień zdjęcie profilowe:</p>
    <form class="p-3" action="changepfp.php" method="post">
    <input type="url" placeholder="tutaj wklej link do nowego zdjęcia profilowego!" name="newProfilePic" class="form-control" required>  
    <button type="submit" class="btn btn-success"> Zmień!</button>
    </form>
    <p class="p-3">Zmień zdjęcie profilowe:</p>
    <form action="changepronouns.php" method="post">
    <input type="url" placeholder="tutaj wprowadź nowe zaimki!" name="newPronouns" class="form-control" required>  
    <button type="submit" class="btn btn-success"> Zmień!</button>
    </form>
</div>
      <!-- FOOTER -->
      <footer class="bg-success text-center text-lg-start mt-3">
    <div class="text-center p-3">
      © 2023 
      <a class="text-white" href="https://github.com/flashdens">miloszek :)</a>
    </div>
  </footer>
  <!--END OF FOOTER -->
  </body>
</html>
