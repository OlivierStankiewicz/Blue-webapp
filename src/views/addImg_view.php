<!DOCTYPE html>
<html lang="pl">
  <head>
    <?php include "includes/head.inc.php"; ?>
    
    <title>nowe zdjęcie</title>
  </head>

  <body>
    
    <p>PRZEŚLIJ ZDJĘCIE!</p>

    <form method="post" enctype="multipart/form-data">
      <label for="image">Twój plik ze zdjęciem:</label><br>
      <input type="file" name="image"/><br>
      <label for="title">Tytuł zdjęcia:</label><br>
      <input type="text" name="title" required/><br>
      <label for="author">Autor zdjęcia:</label><br>
      <input type="text" name="author" required/><br>
      <label for="watermark">Tekst, który ma być na zdjęciu:</label><br>
      <input type="text" name="watermark" required/><br>
      <input type="submit" value="wyślij" required/>    <br>
    </form>
    <a href = "gallery"> Powrót <br></a>

    <?php
    if (!empty($model['alerts'])) {
      foreach ($model['alerts'] as $alert_message)
        echo "$alert_message \r\n";
    }?>

  </body>
</html>
