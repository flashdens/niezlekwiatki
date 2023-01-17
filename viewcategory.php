<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kategoria | NiezłeKwiatki.pl</title>
    <link rel="icon" type="image/x-icon" href="./img/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    session_start();
    include 'autoryzacja.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
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
            <form action="search.php" method="get">
                <input
                  class="form-control"
                  name="search"
                  type="search"
                  placeholder="Szukaj!"
                  aria-label="Search">
              </li>
              <li class="nav-item mx-2 align-self-center">
                  <button
                    class="nav-item btn btn-secondary"
                    type='submit'
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
  if (!isset($_SESSION['user_id'])) {
    echo '<!-- HERO -->';
    echo '<div class="p-5 text-center border text-black" style="background-image: url(./img/hero.jpg); background-repeat: no-repeat; background-size: cover; ">';
    echo '<h1 class="p-3">NiezłeKwiatki.pl</h1>';
    echo '<h2 class="p-3">Największe na wydziale forum florystyczne!</h2>';
    echo '<h4 class="p-3">Jesteśmy grupą studentów i studentek florystyki, którym zależy na rozwijaniu swoich pasji oraz dzieleniu się wiedzą z innymi. <br><br> 
    Serdecznie zapraszamy do rejestracji na forum, by wspólnie odkrywać kolorowe dary Matki Natury!</h4>';
    echo '<a type="button" class="btn btn-success" href="register.html">Zarejestruj się!</a>';
    echo '</div>';
    echo '<!-- END OF HERO -->';
  }
  ?>
  <?php
    if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];
    $query = mysqli_query($conn, "SELECT * FROM niezlekwiatki_categories WHERE category_id = $id ;") or die("Błąd przy łączeniu się z bazą danych (szkodno)...".mysqli_connect_error());;
    $row = mysqli_fetch_array($query);
  } 
    if (!mysqli_num_rows($query)) {
    echo '<h1 class="text-center">Ta kategoria jeszcze nie istnieje!</h1>';
    exit();
    }
  ?>

<div class="text-center p-3">
  <h1> 
    Przeglądana kategoria:  <?=$row['category_name']?>
  </h1>
  <?php
  if (!isset($_SESSION['user_id'])) {
    echo '<div id="reply-container" class="justify-content-center text-center border offset-md-2 col-8 mt-3">';
    echo '<h2 class="p-3">By tworzyć wątki, załóż konto na forum, bądź zaloguj się!</h2>';
    echo '<a type="button" class="btn btn-success mb-3 mx-4" href="register.html">Zarejestruj się!</a>';
    echo '<a type="button" class="btn btn-success mb-3 mx-4" href="login.html">Zaloguj się!</a>';
    echo '</div>';
  }
  else {
    echo '<a type="button" href="createtopic.php?category_id='.$id.'" class="btn btn-success my-2">Stwórz wątek!</a>';
  }
  ?>
</div>
    <!-- TOPICS -->
    <div class="p-3 justify-content-center ">
        <table class="table-bordered table-responsive justify-content-center mx-auto text-center border col-8 ">
            <thead>
                <tr>
                  <th scope="col">Temat</th>
                  <th scope="col" class="d-none d-sm-table-cell">Liczba odpowiedzi</th>
                  <th scope="col" class="d-none d-sm-table-cell">Liczba wyświetleń</th>
                  <th scope="col">Ostatnia aktywność</th>
                  <th scope="col">Lecym?</th>
                </tr>
              </thead>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM niezlekwiatki_topics WHERE category_id = $id ORDER BY last_reply_date DESC;");
            if (!mysqli_num_rows($query)) {
                echo '<h2 class="text-center"> W tej kategorii nie został zaczęty jeszcze żaden wątek. </h2>';
                exit();
            } else {
              while ($result = mysqli_fetch_array($query)) {
                echo '<tr> ';
                echo '<td><h4>' . $result['topic_title'] . '</h4></td>
                <td class="d-none d-sm-table-cell">' . $result['topic_replies'] . '</td>
                <td class="d-none d-sm-table-cell"  q>' . $result['topic_views'] . '</td>
               <td>' . $result['last_reply_date'] . '<br><span>' . $result['last_replier'] . '</span><br><td>
                <a type="button" class="btn btn-success" href="./viewtopic.php?category_id=' . $result['category_id'] . '&topic_id='.$result['topic_id'].'">Lecym!</a></td>
                </tr>';
              }
            }
            ?>
        </table>
        </div>
      <!-- END OF TOPICS -->      
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
