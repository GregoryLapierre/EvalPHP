<?php

namespace App\Controller;

use App\Model\AllMoviesModel;
use App\Controller\AbstractController;

class AllMoviesController extends AbstractController
{
    public function index()
    {   
        $AllMoviesModel = new AllMoviesModel();
      
        if(isset($_GET['p'])){
            $currentPage = $_GET['p'];
        }
        else{
            $currentPage = 1;
        }

        if(isset($_GET['search'])){
            $research = $_GET['search'];
        }
        else{
            $research = '';
        }

        if(isset($_GET['order'])){
            $order = $_GET['order'];
        } 
        else{
            $order = 1;
        }

        if(isset($_GET['select'])){
            $order = $_GET['select'];
        }
       
        if(isset($_GET['research'])){
            $research = strtolower($_GET['research']);
        }
        else{
            $research = '';
        }
        
        $movies = $AllMoviesModel->findByPage($currentPage, $order, $research);
        $pages = $AllMoviesModel->countPage($research);
        // var_dump($movies);
        // var_dump($order);
        // ma logique métier ici
        // exemple récupérer des données en BDD
        // traiter des formulaire
        // vérifier que l'utilisateur a les droits
        // etc...
        $this->render('Movies.php', [
            'movies' => $movies,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'research' => $research,
            'order' => $order
        ]);
    }

    public function create()
    {
        $AllMoviesModel = new AllMoviesModel();

        if (!empty($_POST['titre']) && !empty($_POST['genre']) && !empty($_POST['acteur']) & !empty($_POST['date'])) {
            $titre = $_POST['titre'];
            $genre = $_POST['genre'];
            $acteurs = $_POST['acteur'];
            $date = $_POST['date'];

            $AllMoviesModel = new AllMoviesModel();
           
            $AllMoviesModel->create($titre, $genre, $acteurs, $date);
            header('Location:http://localhost/Eval%20PHP/');
            exit();
        }
        else{
            echo 'Il faut remplir l\'ensemble des données pour ajouter un nouveau film.';
        } 
    }

    public function remove()
    {       
            $AllMoviesModel = new AllMoviesModel();

            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }

            $AllMoviesModel->remove($id);
         
            header('Location:http://localhost/Eval%20PHP/');
            exit();
    }

    public function selectUpdate()
    {       
            $AllMoviesModel = new AllMoviesModel();

            if(isset($_GET['id'])){
                $selectUpdate = $_GET['id'];
            }

            $selectMovies = $AllMoviesModel->findById($selectUpdate);
    
            $this->render('Movies.php', [
                'movies' => $selectMovies,
                'currentPage' => $selectMovies,
                'pages' => $selectMovies,
                'research' => $selectMovies,
                'order' => $selectMovies,
                'selectUpdate' => $selectMovies
            ]);

           
    }
}

