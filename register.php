  <?php
    include 'autoryzacja.php';

    function checkDataUniquity ($conn, $username, $email) {
    $usernameQuery = mysqli_query($conn, "SELECT username FROM niezlekwiatki_users WHERE username = '$username';");
    $emailQuery = mysqli_query($conn, "SELECT email FROM niezlekwiatki_users WHERE email = '$email';");
    if (mysqli_num_rows($usernameQuery) > 0) {
      echo "Rejestracja zakończona niepowodzeniem - istnieje już konto o podanej nazwie użytkownika!";
      die();
    }
    if (mysqli_num_rows($emailQuery) > 0) {
      echo "Rejestracja zakończona niepowodzeniem - istnieje już konto zarejestrowane z użyciem podanego adresu e-mail!";
      die();
      }   
    }

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $pronouns = $_POST['pronouns']; 
    $registerQuery = "INSERT INTO niezlekwiatki_users (username, password, email, pronouns) VALUES (?, ?, ?, ?);";
    $registerStatement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($registerStatement, $registerQuery)) {
      echo  "Błąd przy wysyłaniu zmiennych do wyrażenia preparowanego (kociakrew...)";
      exit();
    } 
    mysqli_stmt_bind_param($registerStatement, "ssss", $username, $password, $email, $pronouns);
    checkDataUniquity($conn, $username, $email);
    if (!mysqli_stmt_execute($registerStatement)) {
      echo "Błąd przy wysyłaniu zmiennych do wyrażenia preparowanego (kociakrew...)";
      exit();
    }
    $getid = mysqli_query($conn, "SELECT user_id FROM niezlekwiatki_users WHERE username = '$username'");
    $row = mysqli_fetch_array($getid);
    $user_id = $row['user_id'];
    $query = "INSERT INTO niezlekwiatki_users_credits (user_id, username, account_creation_date, pronouns, profile_picture) VALUES (?, ?, ?, ?, ?);";
    $stmt =  mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo  "Błąd przy wysyłaniu zmiennych do wyrażenia preparowanego (kociakrew...)";
      exit();
    }
    $total_posts = 0;
    $pronouns = $_POST['pronouns'];
    if (!isset($_POST['profile_picture']) || $_POST['profile_picture'] == '') 
      $profile_picture = "https://static-cdn.jtvnw.net/jtv_user_pictures/0d223a03-7a47-4f7c-8279-1f1c7c679932-profile_image-300x300.png";
    else 
      $profile_picture =  $_POST['profile_picture'];
    $date = date("Y-m-d H:i:s");
    mysqli_stmt_bind_param($stmt, "issss", $user_id, $username, $date, $pronouns, $profile_picture);
  if (!mysqli_stmt_execute($stmt)) {
    echo "Błąd przy wysyłaniu zmiennych do wyrażenia preparowanego (kociakrew...)";
    exit();
  }
  header('Location: index.php?msg=Rejestracja zakończona sukcesem! Możesz teraz zalogować się na swoje konto!');
  ?>
