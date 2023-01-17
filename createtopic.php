<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stwórz temat | NiezłeKwiatki.pl</title>
    <link rel="icon" type="image/x-icon" href="./img/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    include 'autoryzacja.php';
    session_start();
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
                <input
                  type="search"
                  placeholder="Szukaj!"
                  aria-label="Search">
              </li>
              <li class="nav-item mx-2 align-self-center">
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
  </head>
  <body class="bg-white">
  <?php
  if (!isset($_SESSION['user_id'])) {
    echo '<img src="https://i1.sndcdn.com/avatars-5YhOoeqkl8R1QTtE-VPEy0Q-t500x500.jpg" alt="sus">';
    exit();
  }
?>
    <div class="border border-success col-md-8 offset-md-2 text-center p-5">
        <h1>Stwórz wątek!</h1>
        <form action="addtopic.php" method="post">
          <div class="p-3">
            <label class="form-label">Nazwa wątku:</label>
            <input
              type="text"
              name="topicName"
              placeholder="Zgniły mi margaretki!"
              class="form-control"
              required
            />
          </div>
          <div class="">  
            <?php
            $cat = $_GET['category_id'];
            $query = mysqli_query($conn, "SELECT category_name FROM niezlekwiatki_categories WHERE category_id = $cat");
            $row = mysqli_fetch_array($query);
            ?>
            <h2>Tworzysz wątek w kategorii: <?=$row['category_name']?></h2>
          </div>
          <div class="p-3">
            <label class="form-label">Treść:</label>
            <textarea
              type="text"
              name="content"
              class="form-control"
              required
            >
            </textarea>
          </div>
          <input
              type="hidden"
              name="category_id"
              placeholder="Zgniły mi margaretki!"
              value = <?=$cat?>
              class="form-control"
              required
            />
          <button type="submit" class="btn btn-primary">Opublikuj!</button>
        </form>
      </div>
    </div>
    </body>
    </html>
    