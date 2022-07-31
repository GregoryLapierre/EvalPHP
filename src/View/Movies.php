<?php

namespace App;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

//connexion base de donnée
use App\Database;

$db = new Database();
$db->Connect();
?>

<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/Movies.css">
  <title>Filmothèque</title>
</head>

<body>
  <div class="buttonAdmin">
    <a class="btn btn-secondary" href="?page=Admin" role="button">Back-Office</a>
  </div>
  <h1>FILMOTHÈQUE</h1>

  <form class="form" method="get" action="">
    <div class="research">
      <div class="form-floating d-flex justify-content-between mb-1">
        <select class="form-select" id="floatingSelect" name="select" aria-label="Floating label select example">
          <option value="1" <?php if ($order == 1) {
                              echo 'selected';
                            } ?>>Décroissant</option>
          <option value="2" <?php if ($order == 2) {
                              echo 'selected';
                            } ?>>Croissant</option>
        </select>
        <label for="floatingSelect">Classé par date d'ajout</label>
        <button type="submit" class="btn btn-secondary ms-1">Trier<br>Retour</button>
      </div>
      <input type="text" class="form-control" id="research" name="research" placeholder="Recherche par titre, genre ou acteur">
    </div>
  </form>

  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
      <?php foreach ($movies as $movie) : ?>
        <div class="col">
          <div class="card h-100" data-movie="<?= $movie->getId() ?>">
            <a href="?page=SelectById&id=<?= $movie->getId() ?>" class="list-group-item list-group-item-action h-100" aria-current="true">
              <img class="img-fluid mx-auto d-block shadow p-1 mt-1 bg-body rounded" src="<?= $movie->getImage() ?>">
              <div class="d-flex w-100 justify-content-center mt-3">
                <h5 class="mb-1"><?= $movie->getTitre() ?></h5>
              </div>
              <div class="d-flex w-100 justify-content-between">
                <p class="mb-1"><?= $movie->getGenre() ?></p>
                <small>Réalisé le <?= $movie->getDate() ?></small>
              </div>
              <div class="d-flex w-100 justify-content-between mb-2">
                <small><?= $movie->getActeurs() ?></small>
              </div>
              <small><?= $movie->getDescription() ?></small>
            </a>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>

  <nav>
    <ul class="pagination">
      <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
      <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
        <a href="?p=<?= $currentPage - 1 ?>&search=<?= $research ?>&order=<?= $order ?>" class="page-link">Précédente</a>
      </li>
      <?php for ($page = 1; $page <= $pages; $page++) : ?>
        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
          <a href="?p=<?= $page ?>&search=<?= $research ?>&order=<?= $order ?>" class="page-link"><?= $page ?></a>
        </li>
      <?php endfor ?>
      <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
      <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
        <a href="?p=<?= $currentPage + 1 ?>&search=<?= $research ?>&order=<?= $order ?>" class="page-link">Suivante</a>
      </li>
    </ul>
  </nav>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>