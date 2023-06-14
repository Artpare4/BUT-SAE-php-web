<?php

use Exception\ParameterException;
use Entity\Exception\EntityNotFoundException;
use Entity\Image;

try {
    if(!isset($_GET['imageId']) || !ctype_digit($_GET['imageId'])) {
        throw new ParameterException();
    }
    $image=new Image();
    $res=$image->getById($_GET['imageId']);
    header('HTTP 1.1 200 OK');
    header('Content-Type: image/jpeg');
    echo $res->getJpeg();
} catch (EntityNotFoundException|ParameterException) {
    header('Location: /image/actor.png');
}
