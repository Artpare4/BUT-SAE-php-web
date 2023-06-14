<?php

declare(strict_types=1);
use Html\WebPage;
use Entity\Actor;
use Entity\Collection\CastCollection;
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
    $html->appendCssUrl("css/style.css");
    $html->setTitle($html->escapeString($myMovie->getTitle()));
    $html->appendContent("<header><h1>Film - {$html->escapeString($myMovie->getTitle())}</h1></header>\n");
    $html->appendContent("<main><content class='principal'><div class='imgContent'><img src='/imageFilm.php?imageId={$myMovie->getPosterId()}' alt=''></div>");

    $html->appendContent("<div class='infoContent'><div class='titleDate'><div class='titleMovieDesc'>{$html->escapeString($myMovie->getTitle())}</div>");
    $html->appendContent("<div class='date'>{$html->escapeString($myMovie->getReleaseDate())}</div></div>");

    $html->appendContent("<div class='infoOriginalTitle'>{$html->escapeString($myMovie->getOriginalTitle())}</div>");
    $html->appendContent("<div class='infoTagLine'>{$html->escapeString($myMovie->getTagline())}</div>");
    $html->appendContent("<div class='infoDesc'>{$html->escapeString($myMovie->getOverview())}</div></div></content>");

    $casts = CastCollection::findByMovieId($movieId);
    foreach ($casts as $cast) {
        $actor = Actor::findById($cast->getActorId());
        $html->appendContent("<content class='secondary'><a class='secondary' href='/actor.php?actorId={$actor->getId()}'><div class='imgContent'><img src='/imageActor.php?imageId={$actor->getAvatarId()}' alt='Image Actor'></div>");
        $html->appendContent("<div class='infoContent'><div class='secondaryInfo'>{$html->escapeString($cast->getRole())}</div>");
        $html->appendContent("<div class='secondaryInfo'>{$html->escapeString($actor->getName())}</div></div></a></content>");
    }

    $html->appendContent("</main>");
    $html->appendContent("<footer>{$html->getLastModification()}</footer>");
    echo $html->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
