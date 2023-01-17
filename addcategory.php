<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
if (!isset($_POST['category_name']) || !isset($_POST['category_desc']))
    exit();
$category_name = $_POST['category_name'];
$category_desc = $_POST['category_desc'];
$query = mysqli_query($conn, "INSERT INTO niezlekwiatki_categories (category_name, category_desc) VALUES ('$category_name', '$category_desc')");
header('Location: user.php');
?>