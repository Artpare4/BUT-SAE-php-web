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
    echo $res->getJpeg();
} catch (EntityNotFoundException) {
    echo "http://cutrona/but/s2/sae2-01/ressources/public/img/movie.png";
}
catch(ParameterException) {
    http_response_code(400);
}
