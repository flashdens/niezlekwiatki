<?php
include 'autoryzacja.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
session_start();
$creator = $_SESSION['user_id'];
$creatorName = $_SESSION['username'];
$topic_id = $_POST['topic_id'];
$category_id = $_POST['category_id'];
$content = $_POST['post_content'];
if (!isset($content) || $content == '') {
  echo 'Weźże napisz coś ciekawego...';
  exit();
}
$date = date('Y-m-d H:i:s');
$query = "INSERT INTO niezlekwiatki_posts (category_id, topic_id, post_creator, post_date, post_content)
VALUES (?, ?, ?, ?, ?);";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $query)) {
  echo "Błąd przy przygotowaniu wyrażenia preparowanego (psiakrew...)";
  exit();
} else
  mysqli_stmt_bind_param($statement, "iiiss", $category_id, $topic_id, $creator, $date, $content);
if (!mysqli_stmt_execute($statement)) {
    echo "Błąd przy wysyłaniu zmiennych do wyrażenia preparowanego (kociakrew...)";
    exit();
}
$post_id = $conn->insert_id;
$query3 = mysqli_query($conn, "UPDATE niezlekwiatki_users_credits SET total_posts = total_posts + 1 WHERE user_id = $creator;");
$query4 = mysqli_query($conn,"SELECT topic_title FROM niezlekwiatki_topics WHERE topic_id = $topic_id;");
$row = mysqli_fetch_array($query4);
$topic_title = $row['topic_title']; 
$query5 = mysqli_query($conn, "UPDATE niezlekwiatki_topics SET topic_replies = topic_replies + 1, last_replier = '$creatorName', last_reply_date = '$date' WHERE topic_id = $topic_id");
$query6 = mysqli_query($conn,"SELECT number_of_posts FROM niezlekwiatki_categories WHERE category_id = $category_id");
$row = mysqli_fetch_array($query6);
$number_of_posts = $row['number_of_posts'];
$query7 = mysqli_query($conn, "UPDATE niezlekwiatki_categories SET last_updated_by = '$creatorName', last_updated_when = '$date', last_updated_id = $topic_id, last_updated_name = '$topic_title' WHERE category_id = $category_id;");
header("Location: " . $_SERVER["HTTP_REFERER"]);
?>