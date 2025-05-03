<?php

namespace App\Infrastructure\Validation;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Ensure the selected value was in the list of options
 */
readonly class SelectOptionValidator implements ValidationRule
{
    /**
     * @param  array{value: string, label: string}[]  $option
     */
    public function __construct(private array $option) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $values = array_column($this->option, 'value');
        if (! in_array($value, $values)) {
            $fail(__('validation.select_option'));
        }
    }
}
