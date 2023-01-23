<!DOCTYPE html>
<html lang="pl">
  <head>
    <?php include "includes/head.inc.php"; ?>
    <link rel="stylesheet" href="static/css/index.css" />
    <title>strona główna</title>
  </head>

  <body id="body">
    <div id="main-page">

      <header id="header">
        <h1>Blueberry</h1>
      </header>

      <nav id="menu">
        <ul>
          <li><a href="/index" class="active"><strong>STRONA GŁÓWNA</strong></a></li>
          <li><a href="/about"><strong>O BLUE</strong></a></li>
          <li><a href="/gallery"><strong>GALERIA</strong></a></li>
          <li><a href="https://instagram.com/blueberry.maltipoo"><strong>INSTAGRAM</strong></a></li>
          <li><a href="/account"><strong>TWOJE KONTO</strong></a></li>
        </ul>
      </nav>

      <div id="img-container">
        <img src="static/img/JPEGimage43.jpeg" alt="śliczny biały piesek na zielonym tle"/>
        <img src="static/img/JPEGimage41.jpeg" alt="dostojny pies w ogródku" />
        <img src="static/img/JPEGimage69.jpeg" alt="piesio na łóżku" />
      </div>

      <?php include "includes/footer.inc.php"; ?>
      
    </div>
  </body>
</html>