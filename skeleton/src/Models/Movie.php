<?php

namespace Models;

use Exception;
use PDO;

class Movie extends Database
{
    private $id;
    private $title;
    private $type;
    private $genre;
    private $rating;
    private $is_watched;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($value)
    {
        if (empty($value))
            throw new Exception('Title is required');
        if (strlen($value) > 255 && strlen($value) < 0)
            throw new Exception('Title must be 255 characters max');
        $this->title = htmlspecialchars($value);
    }
    public function getType()
    {
        return $this->type;
    }

    public function setType($value)
    {
        if ($value !== 'serie' && $value !== 'film')
            throw new Exception('The type must only be "film" or "serie"');
        $this->title = htmlspecialchars($value);
    }
    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($value)
    {
        if ($value < 1 || $value > 5 || $value !== null)
            throw new Exception('The type must only be "film" or "serie"');
        $this->title = htmlspecialchars($value);
    }

    public function getAll()
    {
        $queryExecute = $this->db->prepare("SELECT * FROM `movies` ORDER BY created_at");
        $queryExecute->execute();
        return $queryExecute->fetchAll(PDO::FETCH_OBJ);
    }

    public function addFilm($title, $type, $genre, $watched, $rating)
    {
        $queryExecute = $this->db->prepare("INSERT INTO `movies` (`title`, `type`, `genre`,  `is_watched`, `rating` ) VALUES (:title, :type, :genre, :watched, :rating)");
        $queryExecute->bindValue(':title', $title, PDO::PARAM_STR);
        $queryExecute->bindValue(':type', $type, PDO::PARAM_STR);
        $queryExecute->bindValue(':genre', $genre, PDO::PARAM_STR);
        $queryExecute->bindValue(':watched', $watched, PDO::PARAM_STR);
        $queryExecute->bindValue(':rating', $rating, PDO::PARAM_STR);
        return $queryExecute->execute();

    }


    public function getAllByType($type)
    {
        $queryExecute = $this->db->prepare("SELECT * FROM `movies` WHERE `type` = :type ORDER BY created_at");
        $queryExecute->bindValue(':type', $type, PDO::PARAM_STR);
        $queryExecute->execute();
        return $queryExecute->fetchAll(PDO::FETCH_OBJ);
    }


}
