<?php

namespace App\Infrastructure\I18n;

use App\Models\User;
use Auth;

/**
 * Format money amount using user settings
 */
class MoneyFormatter
{

    public array $currencies;

    public function __construct(?array $currencies = null)
    {
        $this->currencies = $currencies ?? config('i18n.currencies');
    }

    public function format(int $amount, string $currency, ?User $user = null): string
    {
        $user ??= Auth::user();
        $moneyFormat = $user?->currency_format ?? CurrencyFormat::AFTER;
        $numberFormat = $user?->number_format ?? NumberFormat::SPACE;

        $symbol = $currency;
        if (in_array($moneyFormat, [CurrencyFormat::BEFORE, CurrencyFormat::AFTER])) {
            $symbol = $this->currencies[$currency]['symbol'];
        }

        $price = number_format($amount / 100, 2, $numberFormat->decimal(), $numberFormat->thousands());

        $pattern = match ($moneyFormat) {
            CurrencyFormat::BEFORE => '%1$s%2$s',
            CurrencyFormat::AFTER => '%2$s%1$s',
            CurrencyFormat::BEFORE_LONG => '%1$s%2$s',
            CurrencyFormat::AFTER_LONG => '%2$s%1$s',
        };

        return sprintf($pattern, $symbol, $price);
    }

    public function symbol(string $currency, CurrencyFormat $moneyFormat = CurrencyFormat::AFTER)
    {
        if (in_array($moneyFormat, [CurrencyFormat::BEFORE, CurrencyFormat::AFTER])) {
            return $this->currencies[$currency]['symbol'];
        }
        return $currency;
    }
}
