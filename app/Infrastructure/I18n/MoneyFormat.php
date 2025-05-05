<?php

namespace App\Infrastructure\I18n;

enum MoneyFormat: string
{
    case BEFORE = 'before';
    case AFTER = 'after';
    case BEFORE_LONG = 'before_long';
    case AFTER_LONG = 'after_long';

    public function label(): string
    {
        return match ($this) {
            self::BEFORE => '$123',
            self::AFTER => '123$',
            self::BEFORE_LONG => 'USD 123',
            self::AFTER_LONG => '123 USD',
        };
    }
}
