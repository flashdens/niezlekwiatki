<?php
    include 'autoryzacja.php';
    session_start();
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
    $category_id = $_POST['category_id'];
    $topicName = $_POST['topicName'];
    $topic_creator = $_SESSION['user_id'];
    $date = date("Y-m-d H:i:s");
    $topicQuery = "INSERT INTO niezlekwiatki_topics (category_id, last_replier, last_reply_date, topic_title) VALUES (?, ?, ?, ?);" or die("Błąd komunikacji z bazą danych (szkodno...)!"); 
    $topicStatement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($topicStatement, $topicQuery))
        echo  "Błąd przy wysyłaniu zmiennych do wyrażenia preparowanego (kociakrew...)";
    else {
        mysqli_stmt_bind_param($topicStatement, "iiss", $category_id, $_SESSION['user_id'], $date, $topicName);
        mysqli_stmt_execute($topicStatement);
        $topic_id = $conn->insert_id;
    }
    $content = $_POST['content'];
    $postQuery = "INSERT INTO niezlekwiatki_posts (category_id, topic_id, post_creator, post_date, post_content) VALUES (?, ?, ?, ?, ?);" or die("Błąd komunikacji z bazą danych (szkodno...)!"); 
    $postStatement = mysqli_stmt_init($conn);
    $topicStatement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($postStatement, $postQuery)) {
        echo  "Błąd przy wysyłaniu zmiennych do wyrażenia preparowanego (kociakrew...)";
        exit();
    } else {
        mysqli_stmt_bind_param($postStatement, "iiiss", $category_id, $topic_id, $_SESSION['user_id'], $date, $content);
        mysqli_stmt_execute($postStatement);
        $result = $postStatement->get_result();
        $user = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $query3 = mysqli_query($conn, "UPDATE niezlekwiatki_users_credits SET total_posts = total_posts + 1 WHERE user_id = $topic_creator;");
        $query4 = mysqli_query($conn,"SELECT total_posts FROM niezlekwiatki_users_credits");
        $row = mysqli_fetch_array($query4);
        $total_posts = $row['total_posts'];
        $query5 = mysqli_query($conn, "UPDATE niezlekwiatki_topics SET last_replier = '$username', last_reply_date = '$date' WHERE topic_id = $topic_id;");
        $query7 = mysqli_query($conn, "UPDATE niezlekwiatki_categories SET last_updated_by = '$username', last_updated_when = '$date', number_of_posts = number_of_posts + 1, last_updated_id = $topic_id, last_updated_name = '$topicName' WHERE category_id = $category_id;");
        header('Location: viewcategory.php?category_id='.$category_id);
    }
?>