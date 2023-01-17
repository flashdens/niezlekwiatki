  <?php
    include 'autoryzacja.php';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginQuery = "SELECT * FROM niezlekwiatki_users WHERE username = ?;" or die("Niewłaściwy login!"); 
    $loginStatement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($loginStatement, $loginQuery)) {
      echo "Nie działa :C";
    } else
      mysqli_stmt_bind_param($loginStatement, "s", $username);
      mysqli_stmt_execute($loginStatement);
    $result = $loginStatement->get_result();
    $row = $result->fetch_array();
    if (mysqli_num_rows($result) && password_verify($password, $row['password'])) {
    session_start();
    $_SESSION['username'] = $row['username'];
    $_SESSION['user_id'] = $row['user_id'];
    header("Location: user.php");
    } else 
    echo "Niewłaściwy login lub hasło!";
    ?>
