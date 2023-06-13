<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\WebPage;

$pageWeb=new WebPage();

$pageWeb->setTitle("Films");

$pageWeb->appendContent(<<<HTML
    <div class='header'><h1>Films</h1></div>
HTML);


$filmCollection=new MovieCollection();
$Collection=$filmCollection->getAllMovie();
$pageWeb->appendContent("<div class='main'>");

foreach ($Collection as $film) {
    $pageWeb->appendContent(<<<HTML
    <div class="movie"><a href="/movie.php?moveId={$film->getId()}"><img src="/image/default_picture.png"><div class="title">{$film->getTitle()}</div></a></div>
HTML);
}
$pageWeb->appendContent("</div>");



$pageWeb->appendContent(<<<HTML
    <div class="footer"><p>Last Modification:{$pageWeb->getLastModification()}</p></div>
HTML);

$pageWeb->appendCssUrl("/css/style.css");
echo $pageWeb->toHTML();
