<?php

namespace App\Enums;

enum StatusEnum: int
{
    case HIDDEN = 0;
    case ACTIVE = 1;

    public static function getValues()
    {
        return [
            self::HIDDEN->value,
            self::ACTIVE->value,
        ];
    }

    public static function getValuesAsString($separator)
    {
        return implode($separator, self::getValues());
    }
}
