<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Cast;
use Entity\Exception\EntityNotFoundException;
use PDO;

class CastCollection
{
    /**
     * Méthode de classe de CastCollection
     * Retourne l'entièreté des Cast en rapport avec l'id du Movie entré en paramètre.
     *
     * @param int $id
     * @return Cast[]
     */
    public static function findByMovieId(int $id): ?array
    {
        $request = MyPdo::getInstance()->prepare(<<<SQL
            SELECT id, movieId, peopleId as "actorId", role, orderIndex
            FROM cast
            WHERE movieId = ?;
        SQL);
        $request->bindValue(1, $id);
        $request->execute();
        if ($results = $request->fetchAll(PDO::FETCH_CLASS, Cast::class)) {
            return $results;
        } else {
            return null;
        }
    }


    /**
     * Méthode de classe de CastCollection
     * Retourne l'entièreté des Cast en rapport avec l'id de l'Actor entré en paramètre.
     *
     * @param int $id
     * @return Cast[]
     */
    public static function findByActorId(int $id): array
    {
        $request = MyPdo::getInstance()->prepare(<<<SQL
            SELECT id, movieId, peopleId as "actorId", role, orderIndex
            FROM cast
            WHERE peopleId = ?;
        SQL);
        $request->bindValue(1, $id);
        $request->execute();
        if ($results = $request->fetchAll(PDO::FETCH_CLASS, Cast::class)) {
            return $results;
        } else {
            throw new EntityNotFoundException("Acteur non trouvé");
        }
    }

}
