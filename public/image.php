<?php

use Entity\Exception\ParameterException;
use Entity\Image;
try {
    if(!isset($_GET['imageId'])|| !ctype_digit($_GET['imageId'])) {
        throw new ParameterException();
    }
    $image=new Image();

} catch (ParameterException) {

}
