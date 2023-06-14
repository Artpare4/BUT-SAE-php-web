<?php
declare(strict_types=1);
use Html\WebPage;
use Html\Form\MovieForm;
$pageDelete=new WebPage();
$form=new MovieForm();
$pageDelete->setTitle("Page de suppression");

$pageDelete->appendContent(<<<HTML
    <header>Page du suppression du film </header>
HTML);
