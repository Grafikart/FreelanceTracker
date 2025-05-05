<?php

use App\Infrastructure\I18n\CurrencyFormat;
use App\Infrastructure\I18n\MoneyFormatter;
use App\Infrastructure\I18n\NumberFormat;
use App\Models\User;

describe('MoneyFormatter', function () {

    beforeEach(function () {
        $this->formatter = new MoneyFormatter([
            'USD' => [
                'symbol' => '$',
                'decimal' => '.',
                'thousands' => ',',
            ],
            'EUR' => [
                'symbol' => '€',
                'decimal' => ',',
                'thousands' => '.',
            ],
        ]);
    });

    it('formats money correctly with different formats', function (int $amount, CurrencyFormat $moneyFormat, NumberFormat $numberFormat, string $expected) {
        $user = new User()->fill([
            'currency_format' => $moneyFormat,
            'number_format' => $numberFormat,
        ]);
        expect(
            $this->formatter->format($amount, 'USD', $user)
        )->toBe($expected);
    })->with([
        // Standard amount with different format combinations
        [12345, CurrencyFormat::BEFORE, NumberFormat::COMMA, '$123.45'],
        [12345, CurrencyFormat::AFTER, NumberFormat::COMMA, '123.45$'],
        [12345, CurrencyFormat::BEFORE_LONG, NumberFormat::COMMA, 'USD123.45'],
        [12345, CurrencyFormat::AFTER_LONG, NumberFormat::COMMA, '123.45USD'],

        // Large amount with different number formats
        [1234567, CurrencyFormat::BEFORE, NumberFormat::COMMA, '$12,345.67'],
        [1234567, CurrencyFormat::BEFORE, NumberFormat::DOT, '$12.345,67'],
        [1234567, CurrencyFormat::BEFORE, NumberFormat::SPACE, '$12 345,67'],
        [1234567, CurrencyFormat::BEFORE, NumberFormat::QUOTE, '$12\'345.67'],

        // Different combinations
        [9876, CurrencyFormat::AFTER, NumberFormat::DOT, '98,76$'],
        [9876, CurrencyFormat::AFTER_LONG, NumberFormat::SPACE, '98,76USD'],
    ]);

    it('returns the right symbol', function (string $currency, string $expectation) {
        expect($this->formatter->symbol($currency))->toBe($expectation);
    })->with([
        ['EUR', '€'],
        ['USD', '$'],
    ]);

    it('return the right symbol', function (CurrencyFormat $moneyFormat, string $expected, string $currency) {
        expect($this->formatter->symbol($currency, $moneyFormat))->toBe($expected);
    })->with([
        [CurrencyFormat::BEFORE, '$', 'USD'],
        [CurrencyFormat::AFTER, '$', 'USD'],
        [CurrencyFormat::AFTER, '€', 'EUR'],
        [CurrencyFormat::BEFORE_LONG, 'USD', 'USD'],
        [CurrencyFormat::AFTER_LONG, 'USD', 'USD'],
        [CurrencyFormat::AFTER_LONG, 'EUR', 'EUR'],
    ]);
});
