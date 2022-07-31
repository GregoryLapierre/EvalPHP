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
  <a class="btn btn-secondary me-1" href="?page=Admin" role="button">Retour sur le back-office</a>
  <a class="btn btn-secondary" href="?page=AllMovies" role="button">Retour sur le front</a>
</div>
<?php foreach ($selectMovies as $selectMovie) : ?>
  <h1><?= $selectMovie->getTitre() ?></h1>
<?php endforeach ?>

  <table class="table table-light table-striped shadow">
      <thead class="table-dark text-center">
        <tr>
          <th scope="col">Titre</th>
          <th scope="col">Genre</th>
          <th scope="col">Acteurs</th>
          <th scope="col">Date de création</th>
          <th scope="col">Description</th>
          <th scope="col">Image</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
      <?php foreach ($selectMovies as $selectMovie) : ?>
        <tr class="text-center">
          <td><?= $selectMovie->getTitre() ?></td>
          <td><?= $selectMovie->getGenre() ?></td>
          <td><?= $selectMovie->getActeurs() ?></td>
          <td><?= $selectMovie->getDate() ?></td>
          <td><?= $selectMovie->getDescription() ?></td>
          <td><img class="rounded shadow" style="height: 100px" src="<?= $selectMovie->getImage() ?>"></td>
          <td><a href="?page=AdminRemoveMovies&id=<?= $selectMovie->getId() ?>" class="btn btn-secondary" role="button">Supprimer</a></td>
        </tr>
      <?php endforeach ?>
    </table>

<div class="d-flex justify-content-center">
  <?php foreach ($selectMovies as $selectMovie) : ?>
  <form class="formAdd mt-4 w-50" method="post" action="?page=AdminUpdate&id=<?= $selectMovie->getId() ?>">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="titre" placeholder="Titre" value="<?= $selectMovie->getTitre() ?>" required>
      <label for="floatingInput">Titre</label>
    </div>
    <div class="row g-2">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" name="genre" placeholder="Genre" value="<?= $selectMovie->getGenre() ?>" required>
          <label for="floatingInput">Genre</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="date" class="form-control" id="floatingInput" name="date" placeholder="Date" value="<?= $selectMovie->getDate() ?>" required>
          <label for="floatingInput">Date de création</label>
        </div>
      </div>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="acteur" placeholder="Acteurs" value="<?= $selectMovie->getActeurs() ?>" required>
      <label for="floatingInput">Acteurs</label>
    </div>
    <div class="form-floating mb-3">
      <textarea type="text" class="form-control" id="floatingTextarea" name="description" placeholder="Description" style="height: 150px" required><?= $selectMovie->getDescription() ?></textarea>
      <label for="floatingTextarea">Description</label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="image" placeholder="Image" value="<?= $selectMovie->getImage() ?>" required>
      <label for="floatingInput">Image (URL)</label>
    </div>
    <button type="submit" class="btn btn-secondary mb-4">Modifier</button>
  </form>
  <?php endforeach ?>
</div> 

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

</body>

</html>