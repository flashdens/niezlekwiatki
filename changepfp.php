<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
session_start();
$newProfilePic = $_POST['newProfilePic'];
$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "UPDATE niezlekwiatki_users_credits SET profile_picture = '$newProfilePic' WHERE user_id = $user_id");
header('Location: user.php?msg=Zmiana zakończona sukcesem!');
?>