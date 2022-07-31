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
  <a class="btn btn-secondary" href="?page=AllMovies" role="button">Retour sur le front</a>
</div>
  <h1>BACK-OFFICE FILMOTHÈQUE</h1>

  <form class="form" method="get">
    <input type="hidden" name="page" value="Admin">
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
 
    <table class="table table-light table-striped table-hover shadow">
      <thead class="table-dark text-center">
        <tr>
          <th scope="col">Titre</th>
          <th scope="col">Genre</th>
          <th scope="col">Acteurs</th>
          <th scope="col">Date de création</th>
          <th scope="col">Description</th>
          <th scope="col">Image</th>
        </tr>
      </thead>
      <?php foreach ($movies as $movie) : ?>
        <tr class="trBackOffice" onclick="location.href='?page=AdminSelectMovies&id=<?= $movie->getId() ?>'">
          <td><?= $movie->getTitre() ?></td>
          <td><?= $movie->getGenre() ?></td>
          <td><?= $movie->getActeurs() ?></td>
          <td><?= $movie->getDate() ?></td>
          <td><?= $movie->getDescription() ?></td>
          <td><img class="rounded" style="height: 100px" src="<?= $movie->getImage() ?>"></td>
        </tr>
      <?php endforeach ?>
    </table>

  <nav>
    <ul class="pagination">
      <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
      <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
        <a href="?page=Admin&p=<?= $currentPage - 1 ?>&search=<?= $research ?>&order=<?= $order ?>" class="page-link">Précédente</a>
      </li>
      <?php for ($page = 1; $page <= $pages; $page++) : ?>
        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
          <a href="?page=Admin&p=<?= $page ?>&search=<?= $research ?>&order=<?= $order ?>" class="page-link"><?= $page ?></a>
        </li>
      <?php endfor ?>
      <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
      <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
        <a href="?page=Admin&p=<?= $currentPage + 1 ?>&search=<?= $research ?>&order=<?= $order ?>" class="page-link">Suivante</a>
      </li>
    </ul>
  </nav>

<div class="d-flex justify-content-center">
  <form class="formAdd mt-4 w-50" method="post" action="?page=AdminAddMovies">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="titre" placeholder="Titre" value="" required>
      <label for="floatingInput">Titre</label>
    </div>
    <div class="row g-2">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" name="genre" placeholder="Genre" value="" required>
          <label for="floatingInput">Genre</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="date" class="form-control" id="floatingInput" name="date" placeholder="Date" value="" required>
          <label for="floatingInput">Date de création</label>
        </div>
      </div>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="acteur" placeholder="Acteurs" value="" required>
      <label for="floatingInput">Acteurs</label>
    </div>
    <div class="form-floating mb-3">
      <textarea type="text" class="form-control" id="floatingTextarea" name="description" placeholder="Description" value="" style="height: 150px" required></textarea>
      <label for="floatingTextarea">Description</label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="image" placeholder="Image" value="" required>
      <label for="floatingInput">Image (URL)</label>
    </div>
    <button type="submit" class="btn btn-secondary mb-4">Ajouter</button>
  </form>
</div> 

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>