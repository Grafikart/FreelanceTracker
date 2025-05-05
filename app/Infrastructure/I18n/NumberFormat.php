<?php

namespace App\Infrastructure\I18n;

enum NumberFormat: string
{
    case COMMA = 'comma';
    case DOT = 'dot';
    case SPACE = 'space';
    case QUOTE = 'quote';

    public function label(): string
    {
        return match ($this) {
            self::COMMA => '1,234.56',
            self::DOT => '1.234,56',
            self::SPACE => '1 234,56',
            self::QUOTE => '1\'234.56',
        };
    }

    public function decimal(): string
    {
        return match ($this) {
            self::COMMA => '.',
            self::DOT => ',',
            self::SPACE => ',',
            self::QUOTE => '.',
        };
    }

    public function thousands(): string
    {
        return match ($this) {
            self::COMMA => ',',
            self::DOT => '.',
            self::SPACE => ' ',
            self::QUOTE => '\'',
        };
    }
}
