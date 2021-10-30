<?php

namespace Helpers;

class Validator
{
    /**
     * 
     * 
     */
    public static function validateSearchQuery(string $query): bool
    {
        return (self::isNotEmpty($query) && self::haveLenght($query)) ? true : false;
    }

    /**
     * 
     * 
     */
    public static function isNotEmpty(string $value): bool
    {
        return (!empty($value)) ? true : false;
    }

    /**
     * 
     * 
     */
    public static function haveLenght(string $value): bool
    {
        $lenght = strlen($value);
        return ($lenght >= 3 && $lenght <= 50) ? true : false;
    }
}