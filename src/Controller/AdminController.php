<?php

namespace App\Controller;

use App\Model\AdminModel;
use App\Controller\AbstractController;

class AdminController extends AbstractController
{
    public function index()
    {
        $AllMoviesModel = new AdminModel();

        if (isset($_GET['p'])) {
            $currentPage = $_GET['p'];
        } else {
            $currentPage = 1;
        }

        if (isset($_GET['search'])) {
            $research = $_GET['search'];
        } else {
            $research = '';
        }

        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        } else {
            $order = 1;
        }

        if (isset($_GET['select'])) {
            $order = $_GET['select'];
        }

        if (isset($_GET['research'])) {
            $research = strtolower($_GET['research']);
        } else {
            $research = '';
        }

        $movies = $AllMoviesModel->findByPage($currentPage, $order, $research);
        $pages = $AllMoviesModel->countPage($research);

        $this->render('Admin.php', [
            'movies' => $movies,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'research' => $research,
            'order' => $order,
        ]);
    }

    public function SelectMovies()
    {
        $AllMoviesModel = new AdminModel();

        if (isset($_GET['p'])) {
            $currentPage = $_GET['p'];
        } else {
            $currentPage = 1;
        }

        if (isset($_GET['search'])) {
            $research = $_GET['search'];
        } else {
            $research = '';
        }

        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        } else {
            $order = 1;
        }

        if (isset($_GET['select'])) {
            $order = $_GET['select'];
        }

        if (isset($_GET['research'])) {
            $research = strtolower($_GET['research']);
        } else {
            $research = '';
        }

        if (isset($_GET['id'])) {
            $selectId = $_GET['id'];
        }

        $selectMovies = $AllMoviesModel->findById($selectId);
        $movies = $AllMoviesModel->findByPage($currentPage, $order, $research);
        $pages = $AllMoviesModel->countPage($research);

        $this->render('SelectMovies.php', [
            'movies' => $movies,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'research' => $research,
            'order' => $order,
            'selectMovies' => $selectMovies
        ]);
    }

    public function create()
    {
        $AllMoviesModel = new AdminModel();

        if (!empty($_POST['titre']) && !empty($_POST['genre']) && !empty($_POST['acteur']) & !empty($_POST['date']) & !empty($_POST['description']) & !empty($_POST['image'])) {
            $titre = $_POST['titre'];
            $genre = $_POST['genre'];
            $acteurs = $_POST['acteur'];
            $date = $_POST['date'];
            $description = $_POST['description'];
            $image = $_POST['image'];

            $AllMoviesModel = new AdminModel();

            $AllMoviesModel->create($titre, $genre, $acteurs, $date, $description, $image);
            header('Location:http://localhost/Eval%20PHP/?page=Admin');
            exit();
        } 
    }

    public function remove()
    {
        $AllMoviesModel = new AdminModel();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $AllMoviesModel->remove($id);

        header('Location:http://localhost/Eval%20PHP/?page=Admin');
        exit();
    }

    public function update()
    {
        $AllMoviesModel = new AdminModel();

        if (!empty($_POST['titre']) && !empty($_POST['genre']) && !empty($_POST['acteur']) & !empty($_POST['date']) & !empty($_POST['description']) & !empty($_POST['image'])) {
            $titre = $_POST['titre'];
            $genre = $_POST['genre'];
            $acteurs = $_POST['acteur'];
            $date = $_POST['date'];
            $description = $_POST['description'];
            $image = $_POST['image'];

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }

            $AllMoviesModel = new AdminModel();

            $AllMoviesModel->update($titre, $genre, $acteurs, $date, $description, $image,$id);
            header('Location:http://localhost/Eval%20PHP/?page=AdminSelectMovies&id=' . $id );
            exit();
        } 
    }
}
