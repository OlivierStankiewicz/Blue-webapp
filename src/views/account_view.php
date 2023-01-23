<!DOCTYPE html>
<html lang="pl">
  <head>
    <?php include "includes/head.inc.php"; ?>
    <link rel="stylesheet" href="static/css/index.css" />
    <title>konto</title>
  </head>

  <body id="body">
    <div id="main-page">

      <header id="header">
        <h1>Twoje konto</h1>
      </header>

      <nav id="menu">
        <ul>
          <li><a href="/index"><strong>STRONA GŁÓWNA</strong></a></li>
          <li><a href="/about"><strong>O BLUE</strong></a></li>
          <li><a href="/gallery"><strong>GALERIA</strong></a></li>
          <li><a href="https://instagram.com/blueberry.maltipoo"><strong>INSTAGRAM</strong></a></li>
          <li><a href="/account" class="active"><strong>TWOJE KONTO</strong></a></li>
        </ul>
      </nav>

      <div id="img-container">
      <?php 
            if ($loggedIn === true) { 
                include 'partial/loggedIn_view.php';
            } 
            else {
                include 'partial/registration_view.php';
                include 'partial/login_view.php';
            }
        ?>
      </div>

      <?php include "includes/footer.inc.php"; ?>
      
    </div>
  </body>
</html>