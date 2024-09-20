<?php

namespace App\Enums;

enum TopicFileEnum: string
{
    case MAP = 'map';

    public static function getValues()
    {
        return [
            self::MAP->value,
        ];
    }

    public static function getValuesAsString($separator)
    {
        return implode($separator, self::getValues());
    }
}
