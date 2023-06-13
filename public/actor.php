<?php
declare(strict_types=1);
use Html\WebPage;
use Entity\Actor;
use Entity\Collection\CastCollection;
use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if (!isset($_GET['actorId']) or !ctype_digit($_GET['actorId'])) {
        throw new ParameterException();
    } else {
        $actorId = intval($_GET['actorId']);
    }
    $myActor = Actor::findById($actorId);
    $html = new WebPage();
    $html->appendCssUrl("css/content.css");
    $html->setTitle($html->escapeString($myActor->getName()));
    $html->appendContent("<header><h1>Acteur - {$html->escapeString($myActor->getName())}</h1></header>\n");
    $html->appendContent("<main><content class='principal'><div class='imgContent'><img class='mainImg' src='imageActor.php?imageId=".$myActor->getAvatarId()."' alt='Image Acteur'></div>");

    $html->appendContent("<div class='infoContent'><div class='info'>{$html->escapeString($myActor->getName())}</div>");
    $html->appendContent("<div class='info'>{$html->escapeString($myActor->getPlaceOfBirth())}</div>");
    $birthDate = ($html->escapeString($myActor->getBirthday())) ?: "Naissance inconnue";
    $deathDate = ($myActor->getDeathday()) ?: "Mort inconnue / En vie";
    $html->appendContent("<div class='info'><div class='dates'>$birthDate</div> - <div class='dates'>{$html->escapeString($deathDate)}</div></div>");
    $html->appendContent("<div class='info'>{$html->escapeString($myActor->getBiography())}</div></div></content>");

    $casts = CastCollection::findByActorId($actorId);
    foreach ($casts as $cast) {
        $movie = Movie::findById($cast->getMovieId());
        $html->appendContent("<content class='secondary'><a class ='secondary' href='movie.php?movieId=".$cast->getMovieId()."'><div class='imgContent'><img src='imageFilm.php?imageId=".$movie->getPosterId()."' alt='Image Film'></div>");
        $html->appendContent("<div class='infoContent'><div class='secondaryInfo'><div class='titleDate'><div class='title'>{$html->escapeString($movie->getTitle())}</div><div class='date'>{$html->escapeString($movie->getReleaseDate())}</div></div></div>");
        $html->appendContent("<div class='secondaryInfo'>{$html->escapeString($cast->getRole())}</div></div></div></a></content>");
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
