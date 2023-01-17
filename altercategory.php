<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
$category_id = $_POST['category_id'];
$category_name = $_POST['category_name'];
$category_desc = $_POST['category_desc'];
$query = mysqli_query($conn, "UPDATE niezlekwiatki_categories SET category_name = '$category_name', category_desc = '$category_desc' WHERE category_id = $category_id");
header('Location: user.php');
?>