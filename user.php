<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel użytkownika | NiezłeKwiatki.pl</title>
    <link rel="icon" type="image/x-icon" src="img/logo.ico">
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
                  class="form-control"
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
<?php
if (!isset($_SESSION['username'])) {
    echo "Nie zalogowano jako żaden użytkownik :c";
    exit();
    }
    $user_id = $_SESSION['user_id'];
    $query = mysqli_query($conn, "SELECT * FROM niezlekwiatki_users_credits WHERE user_id = $user_id");
    $row = mysqli_fetch_array($query);
    echo '<div class="border border-success col-md-8 offset-md-2 text-center p-3">';
    echo '<img src="'.$row['profile_picture'].'" height="400" width="400">';
    echo '<h1 class="my-3">Witaj, '.$row['username'].'!</h1>';
    echo '<h2 class="my-3">Na forum zarejestrowałxś się: '.$row['account_creation_date'].'</h2>';
    echo '<h2 class="my-3">Liczba Twoich postów: '.$row['total_posts'].'</h2>';
    echo '<h2 class="my-3">Licznik wydanych bitcoinów: 0.4202137 </h2>';
    echo '<h2 class="mt-4">Poniżej możesz zmienić ustawienia profilu!</h2>';
    echo '<a href="usersettings.php" type="button" class="btn btn-success">O tutaj!</a>';   
    echo '</div>';
?>  

              <?php
              if ($_SESSION['user_id'] == 1) {
                echo '
                <div class="mt-4 p-3 col-md-8 offset-md-2 justify-content-center border border-danger">
                  <h1 class="text-center">Super tajemniczy panel administratora!</h1>
                  <h2 class="text-center mt-3">Zarządzanie użytkownikami</h2>
                        <table class="table-bordered table-responsive justify-content-center col-8 text-center mx-auto">
                            <thead>
                                <tr>
                                  <th scope="col">Użytkownik</th>
                                  <th scope="col" class="d-none d-sm-table-cell">Posty</th>
                                  <th scope="col" class="d-none d-sm-table-cell">Data rejestracji</th>
                                  <th scope="col">Edytuj!</th>
                                </tr>
                              </thead>';  
              $query = mysqli_query($conn, "SELECT * FROM niezlekwiatki_users_credits");
              while ($result = mysqli_fetch_array($query)) {
                echo '<tr>';
                echo '<td><h4>' . $result['username'] . '</h4></td>
                <td>
                '. $result['total_posts'] . '
                </td>
                <td>
                ' . $result['account_creation_date'] . '
                </td>
                <td>
                <form action="deleteuser.php" method="post">
                <input type="hidden" name="user_id" value="'.$result['user_id'].'">    
                <button type="submit" class="btn btn-danger">Usuń użytkownika!</button>
                </form>
                </td>
                </tr>';
              }
              echo '<table class="table-bordered table-responsive justify-content-center col-8 text-center mx-auto mt-4">';
                echo '<h2 class="text-center mt-3">Zarządzanie kategoriami</h2>';
              echo '<thead>';
              echo '<tr>';
              echo '<th scope="col">ID kategorii</th>';
              echo '<th scope="col" class="d-none d-sm-table-cell">Nazwa kategorii</th>';
              echo '<th scope="col" class="d-none d-sm-table-cell">Opis kategorii</th>';
              echo '<th scope="col">Edytuj!</th>';
              echo '</tr>';
              echo '</thead>';
              $query = mysqli_query($conn, "SELECT * FROM niezlekwiatki_categories");
            }
            while ($result = mysqli_fetch_array($query)) {
              echo '<tr>';
              echo '<td><h4>' . $result['category_id'] . '</h4></td>
              <td>
              '. $result['category_name'] . '
              </td>
              <td>
              ' . $result['category_desc'] . '
              </td>
              <td>
              <form action="changecategory.php" method="post">
              <input type="hidden" name="category_id" value="'.$result['category_id'].'">    
              <button type="submit" class="btn btn-info">Edytuj kategorię!</button>
              </form>
              </td>
              </tr>';
            }
            echo '<td><h3>Dodaj kategorię!</h3></td>';
            echo '<form action="addcategory.php" method="post">';
              echo '<td><input type="text" name="category_name"></td>';
              echo '<td><input type="text" name="category_desc"></td>';
              echo '<td><button type="submit" class="btn btn-success">Dodaj kategorię!</button></td>';
              echo '</form>';
              echo '</table>';
            echo '<table class="table-bordered table-responsive justify-content-center col-8 text-center mx-auto mt-4">';
              echo '<h2 class="text-center mt-3">Zarządzanie postami</h2>';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">ID postu</th>';
            echo '<th scope="col" class="d-none d-sm-table-cell">Opublikował użytkownik:</th>';
            echo '<th scope="col" class="d-none d-sm-table-cell">Temat:</th>';
            echo '<th scope="col" class="d-none d-sm-table-cell">Zawartosć posta:</th>';
            echo '<th scope="col">Edytuj!</th>';
            echo '</tr>';
            echo '</thead>';
            $query = mysqli_query($conn, "SELECT * FROM niezlekwiatki_posts JOIN niezlekwiatki_users ON niezlekwiatki_posts.post_creator = niezlekwiatki_users.user_id 
            JOIN niezlekwiatki_topics ON niezlekwiatki_topics.topic_id = niezlekwiatki_posts.topic_id   
            ORDER BY post_id DESC");
              while ($result = mysqli_fetch_array($query)) {
                echo '<tr>';
                echo '<td><h4>' . $result['post_id'] . '</h4></td>
                <td>
                '. $result['username'] . '
                </td>
                <td>
                ' . $result['topic_title'] . '
                </td>
                <td>
                ' . $result['post_content'] . '
                </td>
                <td>
                <form action="deletepost.php" method="post">
                <input type="hidden" name="post_id" value="'.$result['post_id'].'">    
                <button type="submit" class="btn btn-danger">Usuń post!</button>
                </form>
                </td>
                </tr>';
              }
              ?>
        </table>
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