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
}
