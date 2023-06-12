<?php

namespace Entity\Collection;

use PDO;
use Entity\Movie;
use Database\MyPdo;

class MovieCollection
{
    /**
     * Méthode de la classe MovieCollection. Cette méthode retourne une liste d'entité Movie
     * @return Movie[] List d'entité movie
     */
    public function getAllMovie(): array
    {
        $res=[];
        $request=MyPdo::getInstance()->prepare(<<<SQL
        SELECT *
        FROM movie;
SQL);
        $request->execute();
        $res=$request->fetchAll(PDO::FETCH_CLASS, Movie::class);
        return $res;
    }

    /**
     * Méthode de la classe MovieCollection. Cette méthode retourne une liste d'entité Movie appartenant au genre passé en paramtre.
     * @param string $idType id du genre
     * @return Movie[] liste de film
     */
    public function getByType(int $idType): array
    {
        $res=[];
        $request=MyPdo::getInstance()->prepare(<<<SQL
        SELECT m.id,m.posterId,m.originalLanguage,m.originalTitle,m.overwiew,m.releaseDate,m.runtime,m.tagline,m.title
        FROM movie m,
             movie_genre mg
        WHERE m.id=mg.movieId
        AND mg.genreId=:idType;
SQL);
        $request->execute([':idType'=>$idType]);
        $res=$request->fetchAll(PDO::FETCH_CLASS, Movie::class);
        return $res;
    }


}
