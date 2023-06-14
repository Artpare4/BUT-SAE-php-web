<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use Exception\ParameterException;
use Html\Form\MovieForm;
use Html\WebPage;

try {
    if (!isset($_GET['movieId'])) {
        $MovieId=null;
        $form = new MovieForm();
        $info = "Création d'un film";
    } else {
        if (!ctype_digit($_GET['movieId'])) {
            throw new ParameterException();
        } else {
            $movieId = intval($_GET['movieId']);
            $movie = Movie::findById($movieId);
            $form = new MovieForm($movie);
            $info = "Modification du film \"{$movie->getTitle()}\"";
        }
    }
    $page = new WebPage();
    $page->setTitle('Modification des films');
    $page->appendContent("<header><h1>$info</h1></header>");

    $page->appendCssUrl('/css/style.css');

    $page->appendContent(<<<HTML
    <main>
        <content class="form">
            {$form->getHtmlForm('movie-save.php')}
        </content>
    </main>
    <footer>{$page->getLastModification()}</footer>
    HTML);
    echo $page->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}