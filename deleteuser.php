<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
session_start();
$user_id = $_POST['user_id'];
$selectQuery = mysqli_query($conn, "SELECT username FROM niezlekwiatki_users WHERE user_id = $user_id");
$row = mysqli_fetch_array($selectQuery);
echo '<div class="border border-danger text-center p-3">';
echo '<h1 class="p-3">Czy na pewno chcesz usunąć użytkownika '.$row[0].'?</h1>';
?>

<form action="finallydelete.php" method="post">
    <input name="user_id" type="hidden" value="<?=$user_id?>">
    <button type="submit" class="btn btn-danger">Potwierdź usunięcie</button>
</form>
<button class="btn btn-info" onclick="history.go(-1)">Zabierz mnie stąd!</button>

