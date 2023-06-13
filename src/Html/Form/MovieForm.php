<?php

namespace Html\Form;

use Entity\Movie;
use Html\StringEscaper;

class MovieForm
{
    use StringEscaper;
    private ?Movie $movie;

    /**
     * @return Movie|null
     */
    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function __construct(?Movie $movie=null):
    {
        $this->movie = $movie;
    }
}