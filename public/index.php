<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\WebPage;

$pageWeb=new WebPage();

$pageWeb->setTitle("Films");

$pageWeb->appendContent(<<<HTML
    <div class='Header'><h1>Films</h1></div>
HTML);


$filmCollection=new MovieCollection();
$Collection=$filmCollection->getAllMovie();
$pageWeb->appendContent("<div class='main'>");

foreach ($Collection as $film) {
    $pageWeb->appendContent(<<<HTML
    <div class="movie"><img src="/image/default_picture.png"><p>{$film->getTitle()}</p></div>
HTML);
}
$pageWeb->appendContent("</div>");



$pageWeb->appendContent(<<<HTML
    <div><p>Last Modification:{$pageWeb->getLastModification()}</p></div>
HTML);

$pageWeb->appendCssUrl("/css/style.css");
echo $pageWeb->toHTML();
