<?php

declare(strict_types=1);
use Exception\ParameterException;
use Entity\Movie;

if(!isset($_GET['idmovie'])||!ctype_digit($_GET['idmovie'])) {
    throw new ParameterException();
}
$moviedelete=new Movie();
$moviedelete->setId(intval($_GET['idmovie']));
$moviedelete->delete();
header('HTTP 1.1 200 OK');
header('Location: /index.php');
