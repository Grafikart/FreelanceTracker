<?php

namespace App\Infrastructure\I18n;

use App\Models\User;
use Auth;

/**
 * Format money amount using user settings
 */
class MoneyFormatter
{

    public static function format(int $amount, string $currency, ?User $user = null): string
    {
        $user ??= Auth::user();
        $moneyFormat = $user?->money_format ?? MoneyFormat::AFTER;
        $numberFormat = $user?->number_format ?? NumberFormat::SPACE;

        $symbol = $currency;
        if (in_array($moneyFormat, [MoneyFormat::BEFORE, MoneyFormat::AFTER])) {
            $symbol = config('i18n.currencies')[$currency]['symbol'];
        }

        $price = number_format($amount / 100, 2, $numberFormat->decimal(), $numberFormat->thousands());

        $pattern = match ($moneyFormat) {
            MoneyFormat::BEFORE => '%1$s%2$s',
            MoneyFormat::AFTER => '%2$s%1$s',
            MoneyFormat::BEFORE_LONG => '%1$s%2$s',
            MoneyFormat::AFTER_LONG => '%2$s%1$s',
        };

        return sprintf($pattern, $symbol, $price);
    }
}
