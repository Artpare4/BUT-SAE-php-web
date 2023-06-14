<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use Exception\ParameterException;
use Html\Form\MovieForm;

try {
    if (!isset($_GET['movieId'])) {
        $MovieId=null;
        $form = new MovieForm();
    } else {
        if (!ctype_digit($_GET['movieId'])) {
            throw new ParameterException();
        } else {
            $movieId = intval($_GET['movieId']);
            $movie = Movie::findById($movieId);
            $form = new MovieForm($movie);
        }
    }
    echo $form->getHtmlForm('movie-save.php');
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}