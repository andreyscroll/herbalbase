<?php

namespace Helpers;

class Str
{
    /**
     * Clear input string
     */
    public static function clearInput($query): string
    {
        return trim(htmlspecialchars(strip_tags($query)));
    }
}