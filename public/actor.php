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
    $html->setTitle($myActor->getName());
    $html->appendContent("<header><h1>Acteur - {$myActor->getName()}</h1></header>\n");
    $html->appendContent("<main><content class='principal'><div class='imgContent'><img class='mainImg' src='imageActor.php?imageId=".$myActor->getAvatarId()."' alt='Image Acteur'></div>");

    $html->appendContent("<div class='infoContent'><div class='info'>{$myActor->getName()}</div>");
    $html->appendContent("<div class='info'>{$myActor->getPlaceOfBirth()}</div>");
    $birthDate = ($myActor->getBirthday()) ?: "Naissance inconnue";
    $deathDate = ($myActor->getDeathday()) ?: "Mort inconnue / En vie";
    $html->appendContent("<div class='info'><div class='dates'>$birthDate</div> - <div class='dates'>$deathDate</div></div>");
    $html->appendContent("<div class='info'>{$myActor->getBiography()}</div></div></content>");

    $casts = CastCollection::findByActorId($actorId);
    foreach ($casts as $cast) {
        $movie = Movie::findById($cast->getMovieId());
        $html->appendContent("<content class='secondary'><div class='imgContent'><img src='imageFilm.php?imageId=".$movie->getPosterId()."' alt='Image Film'></div>");
        $html->appendContent("<div class='infoContent'><div class='secondaryInfo'><div class='titleDate'><div class='title'>{$movie->getTitle()}</div><div class='date'>{$movie->getReleaseDate()}</div></div></div>");
        $html->appendContent("<div class='secondaryInfo'>{$cast->getRole()}</div></div></div></content>");
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
