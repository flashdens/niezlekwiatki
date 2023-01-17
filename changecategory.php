<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dodaj kategorię | NiezłeKwiatki.pl</title>
    <link rel="icon" type="image/x-icon" href="./img/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    include 'autoryzacja.php';
    session_start();
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Błąd połączenia z serwerem: '.mysqli_connect_error());
    $category_id = $_POST['category_id'];
    $query = mysqli_query($conn, "SELECT * FROM niezlekwiatki_categories WHERE category_id = $category_id");
    $row = mysqli_fetch_array($query);
    ?>
  </head>
  <body class="bg-white">
    <div class="border border-success col-md-8 offset-md-2 text-center p-5">
        <h1>Aktualizacja kategorii</h1>
        <form action="altercategory.php" method="post">
          <div class="p-3">
            <label class="form-label">Nazwa kategorii:</label>
            <input
              type="hidden"
              name="category_id"
              value="<?=$row['category_id']?>"
              placeholder="JanKowalski"
            >
            <input
              type="text"
              name="category_name"
              value="<?=$row['category_name']?>"
              placeholder="JanKowalski"
              class="form-control"
              required
            >
          </div>
          <div class="p-3">
            <label class="form-label">Opis kategorii:</label>
            <textarea
              type="text"
              name="category_desc"
              class="row col-12"
              required
            >
            <?=$row['category_desc']?>
          </textarea>
          </div>
          <button id="submit" type="submit" class="btn btn-primary mb-4">Zmień kategorię!</button>
        </form>
      </div>
    </body>
    </html>
    