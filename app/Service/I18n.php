<?php

namespace App\Service;

class I18n
{
    public static function currencies()
    {
        return array_map(fn ($currency) => [
            'value' => $currency['code'],
            'label' => sprintf('%s - %s', $currency['name'], $currency['code']),
        ], config('i18n.currencies'));
    }
}
