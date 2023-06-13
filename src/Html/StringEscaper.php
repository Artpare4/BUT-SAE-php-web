<?php

namespace Html;

trait StringEscaper
{
    /**
     * Retourne une version protégée de la chaine entrée en paramètre.
     *
     * @param string $string
     * @return string
     */
    public static function escapeString(?string $string): ?string
    {
        if($string===null) {
            $res = "";
        } else {
            $res = htmlspecialchars($string, ENT_QUOTES|ENT_XML1);
        }
        return $res;
    }

    public static function stripTagsAndTrim(?string $string): ?string
    {
        if ($string===null) {
            $res = "";
        } else {
            $res = trim(strip_tags($string));
        }
        return $res;
    }
}
