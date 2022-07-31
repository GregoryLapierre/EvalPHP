<?php

namespace App\Model;

use PDO;
use App\database\Database;

class AdminModel
{
    protected $id;

    protected $titre;

    protected $genre;

    protected $acteurs;

    protected $date;

    protected $description;

    protected $image;

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

        if ($order == 1) {
            $order = 'DESC';
        } else {
            $order = 'ASC';
        }

        if ($research != null) {
            $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' 
            WHERE titre LIKE "%' . $research . '%" OR genre LIKE "%' . $research . '%" OR acteurs LIKE "%' . $research . '%"
            ORDER BY `date` ' . $order;
        } else {
            $sql = 'SELECT
                `id`
                ,`titre`
                ,`genre`
                ,`acteurs`
                ,`date`
                ,`description`
                ,`image`
                FROM ' . self::TABLE_NAME . '
                ORDER BY `date` ' . $order . '
                LIMIT ' . $pageDebut . ',' . $parPage;
        }
        $pdoStatement = $this->pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }

    public function countPage($research)
    {
        $parPage = 10;

        // On détermine le nombre total d'articles
        $sql = 'SELECT COUNT(*) AS count FROM ' . self::TABLE_NAME . ' WHERE titre LIKE "%' . $research . '%" OR genre LIKE "%' . $research . '%" OR acteurs LIKE "%' . $research . '%"';

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

    public function create($titre, $genre, $acteurs, $date, $description, $image)
    {
        $sql = "INSERT INTO " . self::TABLE_NAME . " (titre, genre, acteurs, date, description, image) 
        VALUES (:titre, :genre, :acteurs, :date, :description, :image)";
       
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':titre', $titre, PDO::PARAM_STR);
        $pdoStatement->bindValue(':genre', $genre, PDO::PARAM_STR);
        $pdoStatement->bindValue(':acteurs', $acteurs, PDO::PARAM_STR);
        $pdoStatement->bindValue(':date', $date, PDO::PARAM_STR);
        $pdoStatement->bindValue(':description', $description, PDO::PARAM_STR);
        $pdoStatement->bindValue(':image', $image, PDO::PARAM_STR);
        $result = $pdoStatement->execute();

        return $result;
    }

    public function remove($id)
    {
        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id = $id";

        $pdoStatement = $this->pdo->prepare($sql);

        $result = $pdoStatement->execute();

        return $result;
    }

    public function findById($id)
    {
        $sql = "SELECT
                `id`
                ,`titre`
                ,`genre`
                ,`acteurs`
                ,`date`
                ,`description`
                ,`image`

                FROM " . self::TABLE_NAME . "
                WHERE id = $id";

        $pdoStatement = $this->pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }

    public function update($titre, $genre, $acteurs, $date, $description, $image, $id)
    {
        $sql = "UPDATE " . self::TABLE_NAME . 
        " SET titre = :titre, 
            genre = :genre, 
            acteurs = :acteurs, 
            date = :date, 
            description = :description, 
            image = :image 
            WHERE id = :id";
                
        $pdoStatement = $this->pdo->prepare($sql);
        $pdoStatement->bindValue(':titre', $titre, PDO::PARAM_STR);
        $pdoStatement->bindValue(':genre', $genre, PDO::PARAM_STR);
        $pdoStatement->bindValue(':acteurs', $acteurs, PDO::PARAM_STR);
        $pdoStatement->bindValue(':date', $date, PDO::PARAM_STR);
        $pdoStatement->bindValue(':description', $description, PDO::PARAM_STR);
        $pdoStatement->bindValue(':image', $image, PDO::PARAM_STR);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $pdoStatement->execute();
        return $result;
    }

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

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
