<?php

use Entity\Exception\ParameterException;
use Entity\Exception\EntityNotFoundException;
use Entity\Image;

try {
    if(!isset($_GET['imageId'])|| !ctype_digit($_GET['imageId'])) {
        throw new ParameterException();
    }
    $image=new Image();
    $res=$image->getById($_GET['imageId']);
    header('HTTP 1.1 200 OK');
    header('Content-Type: image/jpeg');
    echo $res->getJpeg();
} catch (EntityNotFoundException) {
    header('Location: /image/default_picture.png');
} catch(ParameterException) {
    http_response_code(400);
}
