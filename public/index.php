<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Entity\Collection\TypeCollection;
use Html\WebPage;

$pageWeb=new WebPage();

$pageWeb->setTitle("Films");

$pageWeb->appendContent(<<<HTML
    <div class='header'><h1>Films</h1></div>
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
HTML);
foreach ($allgenres as $genre) {
    $pageWeb->appendContent(<<<HTML
    <option value="{$genre->getId()}">{$genre->getName()}</option>
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
$pageWeb->appendContent("<div class='main'>");
if (isset($_GET['genre'])) {
    if(ctype_digit($_GET['genre'])) {
        $Collection=$filmCollection->getByType(intval($_GET['genre'])) ;
    } else {
        $Collection=$filmCollection->getAllMovie();
    }
} else {
    $Collection=$filmCollection->getAllMovie();
}



foreach ($Collection as $film) {
    $pageWeb->appendContent(<<<HTML
    <div class="movie"><a href="/movie.php?movieId={$film->getId()}"><img src="/imageFilm.php?imageId={$film->getPosterId()}"><div class="title">{$film->getTitle()}</div></a></div>
HTML);
}
$pageWeb->appendContent("</div>");



$pageWeb->appendContent(<<<HTML
    <div class="footer"><p>Last Modification:{$pageWeb->getLastModification()}</p></div>
HTML);

$pageWeb->appendCssUrl("/css/style.css");
echo $pageWeb->toHTML();
