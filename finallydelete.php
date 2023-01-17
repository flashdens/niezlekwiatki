<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
session_start();
$user_id = $_POST['user_id'];
$query = mysqli_query($conn, "DELETE FROM niezlekwiatki_users WHERE user_id = $user_id");
$query2 = mysqli_query($conn, "DELETE FROM niezlekwiatki_users_credits WHERE user_id = $user_id");
header('Location: user.php');
?>