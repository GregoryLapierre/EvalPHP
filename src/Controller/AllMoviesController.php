<?php

namespace App\Controller;

use App\Model\AllMoviesModel;
use App\Controller\AbstractController;

class AllMoviesController extends AbstractController
{
    public function index()
    {
        $AllMoviesModel = new AllMoviesModel();

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

        $this->render('Movies.php', [
            'movies' => $movies,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'research' => $research,
            'order' => $order
        ]);
    }

    public function selectById()
    {
        $AllMoviesModel = new AllMoviesModel();

        if (isset($_GET['id'])) {
            $selectById = $_GET['id'];
        }

        $selectMovies = $AllMoviesModel->findById($selectById);

        $this->render('Movies.php', [
            'movies' => $selectMovies,
            'currentPage' => $selectMovies,
            'pages' => $selectMovies,
            'research' => $selectMovies,
            'order' => $selectMovies,
            'selectById' => $selectMovies
        ]);
    }
}
