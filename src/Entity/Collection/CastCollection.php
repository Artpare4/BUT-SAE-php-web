<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Cast;
use PDO;

class CastCollection
{
    public static function findByMovie(int $id): array
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
            throw new Exception();
        }
    }

}
