<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Actor;
use PDO;

class ActorCollection
{
    /**
     * Méthode de classe de ActorCollection
     * Retourne l'entièreté des Acteurs présents dans la base de données sous forme d'un tableau indexé.
     *
     * @return Actor[]
     */
    public static function findAll(): array
    {
        $request = MyPdo::getInstance()->prepare(<<<SQL
            SELECT id, avatarId, birthday, deathday, name, biography, placeOfBirth
            FROM people
            ORDER BY name;
        SQL);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, Actor::class);

    }
}
