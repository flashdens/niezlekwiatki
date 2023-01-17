<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wątek | NiezłeKwiatki.pl</title>
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
</form>    
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
  $topic_id = $_GET['topic_id'];
  $category_id = $_GET['category_id'];
  $query1 = mysqli_query($conn, "SELECT * FROM niezlekwiatki_topics WHERE topic_id = $topic_id LIMIT 1");
  $row = mysqli_fetch_array($query1);
  $current_views = $row['topic_views'];
  $query2 = mysqli_query($conn, "SELECT * FROM niezlekwiatki_posts WHERE topic_id = $topic_id ORDER BY post_id ASC");
  $query3 = mysqli_query($conn, "UPDATE niezlekwiatki_topics SET topic_views = $current_views + 1 WHERE topic_id = $topic_id");
  if (!mysqli_num_rows($query2)) {
    echo '<h1 class="text-center">Temat nie istnieje lub jest pusty...</h1>';
  }
  ?>
  <h1 class="text-center p-3"> Przeglądany temat: <?=$row['topic_title']?></h1>
  <div class="text-center justify-content-center">
  <?php
  while ($row = mysqli_fetch_array($query2)) {
    $post_creator = $row['post_creator'];
    $userQuery = mysqli_query($conn, "SELECT * FROM niezlekwiatki_users_credits JOIN niezlekwiatki_users 
    ON niezlekwiatki_users.user_id = niezlekwiatki_users_credits.user_id WHERE niezlekwiatki_users.user_id = $post_creator;");
    $userRow = mysqli_fetch_array($userQuery);
    echo '<div id="post-container" class="row display-block mt-3">';
    echo '<div id="user-label" class="d-flex flex-column justify-content-center text-center col-2 border p-3">';
    echo '<img
    class="text-center mx-auto"
    src="'.$userRow['profile_picture'].'"
    width="80px"
    height="80px"
    px-2>';
    echo '<h4 class="text-center d-none d-md-table-cell">'.$userRow['username'].'</h4>';
    echo '<p class="d-none d-md-table-cell">'.$userRow['pronouns'].'</p>';
    echo '<p class="d-none d-md-table-cell">zarejestrowano: '.$userRow['account_creation_date'].'</p>';
    echo '<p class="d-none d-md-table-cell">liczba postów: '.$userRow['total_posts'].'</p>';
    echo '</div>';
    echo '<div id="content-box" class="col border">';
    echo '<div id="timestamp" class="border-bottom">';
    echo $row['post_date'];
    echo '<h4 class="text-center d-block d-md-none">'.$userRow['username'].'</h4>';
    echo '</div>';
    echo '<div id="post-content">';
    echo $row['post_content'];
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

  if (isset($_SESSION['user_id'])) {
    echo '<div id="reply-container" class="row d-flex justify-content-center text-center border mt-3">';
    echo '<h2 class="p-2 mt-1">Stwórz odpowiedź!</h2><br>';
    echo '<form action="addreply.php" method="post">';
    echo '<input type="hidden" name="topic_id" value="'.$topic_id.'" />';
    echo '<input type="hidden" name="category_id" value="'.$category_id.'" />';
    echo '<textarea name="post_content" id="reply-box" class="border col-12 p-3">';
    echo '</textarea>';
    echo '<button type="submit" class="p-3 justify-content-center btn btn-success text-center">Opublikuj!</button>';
    echo '</form>';
    echo '</div>';
  }
  else {
    echo '<div id="reply-container" class="justify-content-center text-center border mt-3">';
    echo '<h2 class="p-3">By odpowiadać w wątkach, załóż konto na forum, bądź zaloguj się!</h2>';
    echo '<a type="button" class="btn btn-success mb-3 mx-4" href="register.html">Zarejestruj się!</a>';
    echo '<a type="button" class="btn btn-success mb-3 mx-4" href="login.html">Zaloguj się!</a>';
    echo '</div>';
  }
  ?>
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
