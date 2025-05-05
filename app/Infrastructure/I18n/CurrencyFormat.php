<?php

namespace App\Infrastructure\I18n;

enum CurrencyFormat: string
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

    public function isBefore(): bool
    {
        return in_array($this, [self::BEFORE, self::BEFORE_LONG]);
    }

    public function isAfter(): bool
    {
        return in_array($this, [self::AFTER, self::AFTER_LONG]);
    }
}
