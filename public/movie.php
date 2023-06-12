<?php

declare(strict_types=1);
use Html\WebPage;
use Entity\Actor;
use Entity\Collection\CastCollection;
use Entity\Cast;
use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

if (!isset($_GET['movieId']) or !ctype_digit($_GET['movieId'])) {
    header("Location: index.php");
    exit();
} else {
    $movieId = intval($_GET['movieId']);
}

try {
    $myMovie = Movie::findById($movieId);
    $html = new WebPage();
    $html->setTitle($myMovie->getTitle());
    $html->appendContent("<header><h1>{$myMovie->getTitle()}</h1>\n");
    $html->appendContent("<main><content class='movie'><div class='imgContent'><img src='img/movie.png'></div>");

    $html->appendContent("<div class='infoContent'><div class='titleDate'><div class='title'>{$myMovie->getTitle()}</div>");
    $html->appendContent("<div class='date'>{$myMovie->getReleaseDate()}</div></div>");

    $html->appendContent("<div class='originalTitle'>{$myMovie->getOriginalTitle()}</div>");
    $html->appendContent("<div class='tagline'>{$myMovie->getTagline()}</div>");
    $html->appendContent("<div class='overview'>{$myMovie->getOverview()}</div>");

    $casts = CastCollection::findByMovieId($movieId);
    foreach ($casts as $cast) {
        $actor = Actor::findById($cast->getActorId());
        $html->appendContent("<content class='actor'><div class='imgContent'><img src='img/movie.png'></div>");
        $html->appendContent("<div class='infoContent'><div class='actorInfo'>{$cast->getRole()}</div>");
        $html->appendContent("<div class='actorInfo'>{$actor->getName()}</div></div>");
    }
    echo $html->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
