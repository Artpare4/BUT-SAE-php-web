<?php

declare(strict_types=1);

namespace Entity\Collection;

use PDO;
use Database\MyPdo;
use Entity\Type;

class TypeCollection
{
    /**
     * Méthode de classe de TypeCollection
     * Retourne l'entièreté des Genres présents dans la base de données sous forme d'un tableau indexé.
     *
     * @return Type[]
     */
    public static function findAll(): array
    {
        $request = MyPdo::getInstance()->prepare(<<<SQL
            SELECT id, name
            FROM genre
            ORDER BY name;
        SQL);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, Type::class);
    }
}
