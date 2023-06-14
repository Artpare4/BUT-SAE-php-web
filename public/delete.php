<?php

declare(strict_types=1);
use Entity\Exception\ParameterException;
use Entity\Movie;

if(!isset($_GET['idmovie'])||!ctype_digit($_GET['idmovie'])) {
    throw new ParameterException();
}
$moviedelete=new Movie();
$moviedelete->setId($_GET['idmovie']);
$moviedelete->delete();
