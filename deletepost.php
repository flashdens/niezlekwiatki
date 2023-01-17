<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
$query1 = mysqli_query($conn, "SELECT niezlekwiatki_topics.topic_id FROM niezlekwiatki_posts JOIN niezlekwiatki_topics ON niezlekwiatki_posts.topic_id = niezlekwiatki_topics.topic_id");
$row = mysqli_fetch_array($query1);
$post_id = $_POST['post_id'];
$query2 = mysqli_query($conn, "DELETE FROM niezlekwiatki_posts WHERE post_id = $post_id");
$query3 = mysqli_query($conn, "UPDATE niezlekwiatki_topics SET topic_replies = topic_replies - 1 WHERE topic_id = $row[0]");
header('Location: user.php');
?>