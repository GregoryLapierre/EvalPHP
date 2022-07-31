<?php

namespace App\Controller;

use App\Model\AdminModel;
use App\Controller\AbstractController;

class ImportController extends AbstractController
{
    public function index()
    {
        $opts = array(
            'http' =>
            array(
                'method'  => 'GET',
            )
        );

        $context  = stream_context_create($opts);
        $url = 'https://api.themoviedb.org/3/discover/movie/?certification_country=US&certification=R&sort_by=vote_average.desc&api_key=1aef9ee10b458a7521af75f34948c08c';
        $result = file_get_contents($url, false, $context);
        $result = json_decode($result, true);
         dd($result);
        $movie = new AdminModel();
        foreach ($result['results'] as $data) {
            $movie->create($data['title'], 'Genre', 'Acteurs', $data['release_date'], $data['overview'], 'https://image.tmdb.org/t/p/w500' . $data['backdrop_path']);
        }
    }
}
