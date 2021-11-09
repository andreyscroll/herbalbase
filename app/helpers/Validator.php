<?php

namespace Helpers;

class Validator
{
    /**
     * Validate search query
     */
    public static function validateSearchQuery($query): bool
    {
        return self::haveLenght($query) 
            && self::isCorrectString($query);
    }

    /**
     * Check for empty
     */
    public static function isNotEmpty($value): bool
    {
        return (!empty($value)) ? true : false;
    }

    /**
     * Check for lenght
     */
    public static function haveLenght($value): bool
    {
        $lenght = mb_strlen($value);
        return ($lenght >= 4 && $lenght <= 50) ? true : false;
    }

    /**
     * Check for correct string (regexp)
     */
    public static function isCorrectString($value): bool
    {
        if (! is_string($value) && ! is_numeric($value)) {
            return false;
        }
        
        return preg_match("#^[a-zA-Zа-яА-Я0-9\s]+$#u", $value);
    }
}