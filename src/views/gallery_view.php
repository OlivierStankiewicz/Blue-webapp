<!DOCTYPE html>
<html lang="pl">
  <head>
    <?php include "includes/head.inc.php"; ?>
    <link rel="stylesheet" href="static/css/gallery.css" />
    <title>galeria</title>
  </head>

  <body id="body">
    <div id="gallery-container">

      <header id="header">
        <h1>Galeria zdjęć</h1>
      </header>

      <nav id="menu">
        <ul>
          <li><a href="/index"><strong>STRONA GŁÓWNA</strong></a></li>
          <li><a href="/about"><strong>O BLUE</strong></a></li>
          <li><a href="/gallery" class="active"><strong>GALERIA</strong></a></li>
          <li><a href="https://instagram.com/blueberry.maltipoo"><strong>INSTAGRAM</strong></a></li>
          <li><a href="/account"><strong>TWOJE KONTO</strong></a></li>
          <li><a href="/addImg"><strong>DODAJ ZDJĘCIE</strong></a></li>
        </ul>
      </nav>

      <div id="content">
      <div id="image-grid">
      <?php foreach($images as $image):?>
                        <div class="photo">
                            <a href="<?=$image['photoWatermark']?>" target="_blank"><img src="<?=$image['photoMiniature']?>" alt="<?=$image['watermark']?>"></a>
                            <br/>
                            <p>Tytuł: <?=$image['title']?></p>
                            <p>Autor: <?=$image['author']?></p>
                        </div>
      <?php endforeach ?>
      </div>

      <div class="paging">
        <?php 
          for ($page = 1; $page <= $pages; $page++) {
            echo '<a href="/gallery?page='.$page.'">'.$page.' '.'</a>';
          }?>
      </div>
      </div>

    <?php include "includes/footer.inc.php"; ?>
    </div>
  </body>
</html>
