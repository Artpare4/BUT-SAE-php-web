<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    private string $head;
    private string $title;
    private string $body;

    /**
     * Méthode de la classe WebPage. Cette méthode construit un nouvel objet webpage ayant pour titre la chaîne de caratère passé en paramètre.
     * @param string $title
     */
    public function __construct(string $title = "")
    {
        $this->title = $title;
        $this->head = "";
        $this->body = "";
    }

    /**
     * Méthode de la classe WebPage. Cette méthode retourne une chaîne de caratère contenant tout le contenu de l'attribut head.
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * Méthode de la classe WebPage. Cette méthode retourne une chaîne de caratère contenant tout le contenu de l'attribut Title.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Méthode de la classe WebPage. Cette méthode retourne une chaîne de caratère contenant tout le contenu de l'attribut Body.
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Méthode de la classe WebPage. Cette méthode permet de modifier la valeur du titre de la page web.
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Méthode de la classe WebPage. Cette méthode permet l'ajout de contenu dans le head.
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Méthode de la classe WebPage. Cette méthode ajoute du contenu css dans le head.
     * @param string $css
     * @return void
     */
    public function appendCss(string $css): void
    {
        $res = "<style>";
        $res .= $css;
        $res .= "</style>";
        $this->appendToHead($res);
    }

    /**
     * Méthode de la classe WebPage. Cette méthode ajout l'url d'un fichier css passé en paramètre dans le Head.
     * @param string $css
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $res = "<link rel=\"stylesheet\" href=\"";
        $res .= $url;
        $res .= "\">";
        $this->appendToHead($res);
    }

    /**
     * Méthode de la classe WebPage. Cette méthode ajoute du contenu javascript dans le head.
     * @param string $js
     * @return void
     */
    public function appendJs(string $js): void
    {
        $res = "<script>";
        $res .= $js;
        $res .= "</script>";
        $this->appendToHead($res);
    }

    /**
     * Méthode de la classe WebPage. Cette méthode ajout l'url d'un fichier javacript passé en paramètre dans le Head.
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url)
    {
        $res = "<script src=\"";
        $res .= $url;
        $res .= "\"></script>";
        $this->appendToHead($res);
    }

    /**
     * Méthode de la classe WebPage. Cette méthode permet d'ajouter d'un contenu dans le Body.
     * @param string $content
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Méthode de la classe WebPage. Cette méthode retourne une chaîne de caratère produisant la page Web complète.
     * @return string
     */
    public function toHTML(): string
    {
        $res = <<<HTML
    <!DOCTYPE html>
    <html lang="fr">
    <head>
         <meta charset="UTF-8">
         <title> $this->title</title>
         <meta name="viewport">
         $this->head
         
    </head>
    <body>
        $this->body
    </body>
</html>
HTML;

        return $res;
    }

    /**
     * Méthode de la classe WebPage. Cette méthode retourne la dernière date de modification du document.
     * @return string
     */
    public function getLastModification(): string
    {
        return date('j F o', getlastmod());
    }

    /**
     * Méthode de la classe WebPage. Cette méthdoe retourne la chaîne de caractère en ayant protéger les caractères spéciaux pouvant dégrader la page Web.
     * @param string $string
     * @return string
     */
    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
    }
}
