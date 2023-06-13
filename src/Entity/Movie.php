<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Movie
{
    private ?int $id;
    private string $originalLanguage;
    private string $originalTitle;
    private string $overview;
    private string $releaseDate;
    private ?int $runtime;
    private string $tagline;
    private string $title;
    private ?int $posterId;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Movie
     */
    public function setId(int $id): Movie
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * @param string $originalLanguage
     * @return Movie
     */
    public function setOriginalLanguage(string $originalLanguage): Movie
    {
        $this->originalLanguage = $originalLanguage;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * @param string $originalTitle
     * @return Movie
     */
    public function setOriginalTitle(string $originalTitle): Movie
    {
        $this->originalTitle = $originalTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     * @return Movie
     */
    public function setOverview(string $overview): Movie
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     * @return Movie
     */
    public function setReleaseDate(string $releaseDate): Movie
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    /**
     * @param int $runtime
     * @return Movie
     */
    public function setRuntime(int $runtime): Movie
    {
        $this->runtime = $runtime;
        return $this;
    }

    /**
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * @param string $tagline
     * @return Movie
     */
    public function setTagline(string $tagline): Movie
    {
        $this->tagline = $tagline;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * @param int $posterId
     * @return Movie
     */
    public function setPosterId(int $posterId): Movie
    {
        $this->posterId = $posterId;
        return $this;
    }

    /**
     * Méthode de classe de Movie
     * Renvoie un Movie possédant les attributs de celui recherché dans la base de données
     * en fonction de son ID.
     *
     * @param int $id
     * @return Movie
     */
    public static function findById(int $id): Movie
    {
        $request = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM movie
            WHERE id = ?;
        SQL
        );
        $request->bindValue(1, $id);
        $request->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $request->execute();
        if ($res = $request->fetch()) {
            return $res;
        } else {
            throw new EntityNotFoundException();
        }
    }

    public function delete(): Movie
    {
        $request = MyPdo::getInstance()->prepare(<<<SQL
            DELETE FROM movie
            WHERE id = ?;
        SQL);
        $request->bindValue(1, $this->id);
        $request->execute();
        $this->id=null;
        return $this;

    }

    public function update(): Movie
    {
        $request = MyPdo::getInstance()->prepare(<<<SQL
            UPDATE movie
            SET title = :title,
                originalLanguage = :originalLanguage,
                originalTitle = :originalTitle,
                overview = :overview,
                releaseDate = TO_DATE(:releaseDate,'YYYY-MM-DD'),
                runtime = :runtime,
                tagline = :tagline
            WHERE id = :id;
        SQL);
        $request->bindValue('title', $this->title);
        $request->bindValue('originalLanguage', $this->originalLanguage);
        $request->bindValue('originalTitle', $this->originalTitle);
        $request->bindValue('overview', $this->overview);
        $request->bindValue('releaseDate', $this->releaseDate);
        $request->bindValue('runtime', $this->runtime);
        $request->bindValue('tagline', $this->tagline);
        $request->execute();
        return $this;
    }
    public function insert(): Movie
    {
        $request = MyPdo::getInstance()->prepare(<<<SQL
            INSERT INTO movie (originalLanguage,originalTitle,overview,releaseDate,runtime,tagline,title)
            VALUES (:originalLanguage,:originalTitle,:overview,TO_DATE(:releaseDate,'YYYY-MM-DD'),:runtime,:tagline,:title);
        SQL);
        $request->bindValue('title', $this->title);
        $request->bindValue('originalLanguage', $this->originalLanguage);
        $request->bindValue('originalTitle', $this->originalTitle);
        $request->bindValue('overview', $this->overview);
        $request->bindValue('releaseDate', $this->releaseDate);
        $request->bindValue('runtime', $this->runtime);
        $request->bindValue('tagline', $this->tagline);
        $request->execute();

        $request = MyPdo::getInstance()->prepare(<<<SQL
            SELECT id
            FROM movie
            WHERE title = ?;
        SQL);
        $request->bindValue(1, $this->title);
        $request->execute();
        $this->id= $request->fetch()['id'];
        return $this;
    }
}
