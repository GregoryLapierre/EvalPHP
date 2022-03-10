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

<h1>FILMOTHÈQUE</h1>

<form class="form" method="get" action="">
    <div class="form-floating">
      <select class="form-select" id="floatingSelect" name="select" aria-label="Floating label select example">
        <option value="1" <?php if($order == 1){echo 'selected';} ?>>Décroissant</option>
        <option value="2" <?php if($order == 2){echo 'selected';} ?>>Croissant</option>
      </select>
      <label for="floatingSelect">Classé par date d'ajout</label>
      <button type="submit" class="btn btn-secondary ">Trier<br>Retour</button>
    </div>

    <div class="research">
      <input type="text" class="form-control" id="research" name="research" placeholder="Recherche par titre, genre ou acteur">
    </div>  
</form>

<div class="container">
<?php foreach($movies as $movie): ?>
    <div class="list-group position-relative" data-movie="<?= $movie->getId() ?>">
      <a href="?page=RemoveMovies&id=<?= $movie->getId() ?>" class="btn-close"></a>
      <a href="?page=SelectUpdateMovies&id=<?= $movie->getId() ?>" class="list-group-item list-group-item-action" aria-current="true">
        <div class="d-flex w-100 justify-content-between">  
          <h5 class="mb-1"><?= $movie->getTitre() ?></h5>
        </div>
        <div class="d-flex w-100 justify-content-between">
          <p class="mb-1"><?= $movie->getGenre() ?></p>
          <small>Ajouté le <?= $movie->getDate() ?></small>
        </div>
        <small><?= $movie->getActeurs() ?></small>
      </a>
      <!-- <a class="btn btn-secondary btn-sm" href="?page=SelectUpdateMovies&id=<?= $movie->getId() ?>">Modifier</a> -->
    </div>
  <?php endforeach ?>
</div> 
  
<nav>
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a href="?p=<?= $currentPage - 1 ?>&search=<?= $research ?>&order=<?= $order ?>" class="page-link">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
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

<form class="formAdd" method="post" action="?page=AddMovies">
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="floatingInput" name="titre" placeholder="Titre" value="">
    <label for="floatingInput">Titre</label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="floatingInput" name="genre" placeholder="Genre" value="">
    <label for="floatingInput">Genre</label>
  </div>
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="floatingInput" name="acteur" placeholder="Acteur" value="">
    <label for="floatingInput">Acteur</label>
  </div>
  <div class="form-floating mb-3">
    <input type="date" class="form-control" id="floatingInput" name="date" placeholder="Date" value="">
    <label for="floatingInput">Date d'ajout</label>
  </div>
  <button type="submit" class="btn btn-secondary ">Ajouter</button>
</form>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>

