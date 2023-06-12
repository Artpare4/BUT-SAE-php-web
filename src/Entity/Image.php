<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Image
{
    private int $id;
    private string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * @param int $id
     * @return Image
     */
    public function setId(int $id): Image
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $jpeg
     * @return Image
     */
    public function setJpeg(string $jpeg): Image
    {
        $this->jpeg = $jpeg;
        return $this;
    }

    /**
     * Méthode de la classe Image . Cette méthode retourne une entié image ayant l'id passé en paramètre
     * @param int $id Id de l'image que l'on choisi
     * @return Image Entité image
     */
    public function getById(int $id): Image
    {
        $request=MyPdo::getInstance()->prepare(<<<SQL
    SELECT id,jpeg
    FROM image
    WHERE id=:idImage;
SQL);
        $request->execute([':idImage'=>$id]);
        $request->setFetchMode(PDO::FETCH_CLASS, Image::class);
        return $request->fetch();
    }
}
