<?php

namespace App\Domains\Settings;

enum Theme: string
{

    case LIGHT = 'light';
    case DARK = 'dark';
    case SYSTEM = 'system';

    public function label(): string
    {
        return match ($this) {
            self::LIGHT => __('settings.themes.light'),
            self::DARK => __('settings.themes.dark'),
            self::SYSTEM => __('settings.themes.system'),
        };
    }
}
