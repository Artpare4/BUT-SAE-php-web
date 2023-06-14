<?php

declare(strict_types=1);
use Entity\Exception\ParameterException;
use Entity\Movie;

if(!isset($_POST['idmovie'])||!ctype_digit($_POST['idmovie'])) {
    throw new ParameterException();
}
$moviedelete=new Movie();
$moviedelete->setId($_POST['idmovie']);
$moviedelete->delete();
