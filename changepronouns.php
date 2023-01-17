<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
session_start();
$newPronouns = $_POST['newPronouns'];
$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "UPDATE niezlekwiatki_users_credits SET pronouns = '$newPronouns' WHERE user_id = $user_id");
header('Location: user.php?msg=Zmiana zakończona sukcesem!');
?>