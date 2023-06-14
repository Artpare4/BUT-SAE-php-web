<?php

namespace Html\Form;

use Entity\Movie;
use Html\StringEscaper;

class MovieForm
{
    use StringEscaper;
    private ?Movie $movie;

    /**
     * @return Movie|null
     */
    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function __construct(?Movie $movie=null)
    {
        $this->movie = $movie;
    }

    public function getHtmlForm(string $action): string
    {
        if (isset($this->movie)) {
            $id = self::escapeString($this->movie->getId());
            $title = self::escapeString($this->movie->getTitle());
            $originalLang = self::escapeString($this->movie->getOriginalLanguage());
            $originalTitle = self::escapeString($this->movie->getOriginalTitle());
            $overview = self::escapeString($this->movie->getOverview());
            $releaseD = self::escapeString($this->movie->getReleaseDate());
            $runtime = self::escapeString($this->movie->getRuntime());
            $tagline = self::escapeString($this->movie->getTagline());
        } else {
            $id = null;
            $title = null;
            $originalLang = null;
            $originalTitle = null;
            $overview = null;
            $releaseD = null;
            $runtime = null;
            $tagline = null;
        }
        return <<<HTML
        <form action='$action' method='post'>
            <label>
                <input name="id" type="hidden" value="$id">
            </label>
            <label>
                Titre :
                <input name="title" type="text" value="$title" required>
            </label>
            <label>
                Titre Original :
                <input name="originalTitle" type="text" value="$originalTitle" required>
            </label>
            <label>
                Langue Originale :
                <input name="originalLanquage" type="text" value="$originalLang" required>
            </label>
            <label>
                Phrase d'accroche :
                <textarea name="tagline" required>
                $tagline
                </textarea>
            </label>
            <label>
                 Résumé :
                <textarea name="overview" required>
                $overview
                </textarea>
            </label>
            <label>
                Date de Sortie du film :
                <input name="releaseDate" type="date" value="$releaseD">
            </label>
            <label>
                Durée du film en minute :
                <input name="runtime" type="number" value="$runtime">
            </label>
            <button type="submit">Enregistrer</button>
        </form>
HTML;
    }

}