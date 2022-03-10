<?php

namespace App\Model;

use PDO;
use App\database\Database;

class AllMoviesModel
{
    protected $id;

    protected $titre;

    protected $genre;

    protected $acteurs;

    protected $date;

    protected $pdo;

    const TABLE_NAME = 'AllMovies';

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function findByPage($page, $order, $research)
    {   // On détermine le nombre d'articles par page
        $parPage = 10;
        
        $pageDebut = ($page - 1) * $parPage;
        
        if($order == 1){
            $order = 'DESC';
        }
        else{
            $order = 'ASC';
        }

        if($research != null ){
            $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' 
            WHERE titre LIKE "%'.$research.'%" OR genre LIKE "%'.$research.'%" OR acteurs LIKE "%'.$research.'%"
            ORDER BY `date` '. $order;
        }
        else{
            $sql = 'SELECT
                `id`
                ,`titre`
                ,`genre`
                ,`acteurs`
                ,`date`
                FROM ' . self::TABLE_NAME . '
                ORDER BY `date` '. $order .'
                LIMIT '. $pageDebut . ','. $parPage;
        }
        $pdoStatement = $this->pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }

    public function countPage($research){
        $parPage = 10;
        
        // On détermine le nombre total d'articles
        $sql = 'SELECT COUNT(*) AS count FROM ' . self::TABLE_NAME . ' WHERE titre LIKE "%'.$research.'%" OR genre LIKE "%'.$research.'%" OR acteurs LIKE "%'.$research.'%"';

        // On prépare la requête
        $query = $this->pdo->prepare($sql);

        // On exécute
        $query->execute();

        // On récupère le nombre d'articles
        $total = $query->fetch();
        $total = $total['count'];
        
         // On calcule le nombre de pages total
         return ceil($total / $parPage);
    }

    public function create($titre, $genre, $acteurs, $date)
    {   $sql = "INSERT INTO " . self::TABLE_NAME . " (titre, genre, acteurs, date) 
        VALUES ('$titre', '$genre', '$acteurs', '$date')";
      
        $pdoStatement = $this->pdo->prepare($sql);
        
        $result = $pdoStatement->execute();
        
        return $result;
    }

    public function remove($id)
    {   $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id = $id";
        
        $pdoStatement = $this->pdo->prepare($sql);
        
        $result = $pdoStatement->execute();
        
        return $result;
    }

    public function findById($id)
    {           $sql = "SELECT
                `id`
                ,`titre`
                ,`genre`
                ,`acteurs`
                ,`date`
                FROM " . self::TABLE_NAME . "
                WHERE id = $id";
        
        $pdoStatement = $this->pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }






    // public function Research($research){
    //     $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE titre LIKE "%'.$research.'%" OR genre LIKE "%'.$research.'%" OR acteurs LIKE "%'.$research.'%"';
        
    //     $pdoStatement = $this->pdo->query($sql);
    //     $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    //         return $result;
        
    // }
    // public function findById($id)
    // {
    //     $sql = 'SELECT
    //             `id`
    //             ,`name`
    //             FROM ' . self::TABLE_NAME . '
    //             WHERE `id` = :id
    //             ORDER BY `id` ASC;
    //     ';

    //     $pdoStatement = $this->pdo->prepare($sql);
    //     $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    //     $result = $pdoStatement->execute();
    //     $result = $pdoStatement->fetchObject(self::class);
    //     return $result;
    // }

    // public function create($name)
    // {
    //     $sql = 'INSERT INTO ' . self::TABLE_NAME . '
    //             (`name`)
    //             VALUES
    //             (:name)
    //     ';

    //     $pdoStatement = $this->pdo->prepare($sql);
    //     $pdoStatement->bindValue(':name', $name, PDO::PARAM_STR);
        
    //     $result = $pdoStatement->execute();
        
    //     if (!$result) {
    //         return false;
    //     }

    //     return $this->pdo->lastInsertId();
    // }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of genre
     */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of acteurs
     */ 
    public function getActeurs()
    {
        return $this->acteurs;
    }

    /**
     * Set the value of acteurs
     *
     * @return  self
     */ 
    public function setActeurs($acteurs)
    {
        $this->acteurs = $acteurs;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}