<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Entity\Collection\TypeCollection;
use Html\WebPage;
use Entity\Exception\EntityNotFoundException;

$pageWeb=new WebPage();

$pageWeb->setTitle("Films");

$pageWeb->appendContent(<<<HTML
    <header><h1>Films</h1></header>
HTML);
$pageWeb->appendContent(<<<HTML
    <div class="filtrage">
HTML);
$genres=new TypeCollection();
$allgenres=$genres->findAll();
$pageWeb->appendContent(<<<HTML
    <form method="get" name="choixgenre" action="/index.php">
        <label class="genrelist"> 
            <select name="genre">
             <option value="">Tous les films</option>
HTML);
foreach ($allgenres as $genre) {
    $pageWeb->appendContent(<<<HTML
    <option value="{$genre->getId()}">{$pageWeb->escapeString($genre->getName())}</option>
HTML);
}

$pageWeb->appendContent(<<<HTML
                </select>
            </label>
            <button type="submit">Envoyer</button>
        </form>
    </div>
HTML);


$filmCollection=new MovieCollection();
$pageWeb->appendContent("<main>");
try {
    if (isset($_GET['genre'])) {
        if (ctype_digit($_GET['genre'])) {
            $Collection = $filmCollection->getByType(intval($_GET['genre']));
        } else {
            $Collection = $filmCollection->getAllMovie();
        }
    } else {
        $Collection = $filmCollection->getAllMovie();
    }
} catch (EntityNotFoundException) {
    $Collection = $filmCollection->getAllMovie();
}

foreach ($Collection as $film) {
    $pageWeb->appendContent(<<<HTML
    <content class="movie"><a href="/movie.php?movieId={$film->getId()}"><img src="/imageFilm.php?imageId={$film->getPosterId()}"><content class="title">{$pageWeb->escapeString($film->getTitle())}</content></a></content>
HTML);
}
$pageWeb->appendContent("</main>");



$pageWeb->appendContent(<<<HTML
    <footer>Last Modification:{$pageWeb->getLastModification()}</footer>
HTML);

$pageWeb->appendCssUrl("/css/style.css");
echo $pageWeb->toHTML();
