<?php

namespace App\Domains\Settings\Requests;

use App\Infrastructure\I18n\I18nHelper;
use App\Infrastructure\Validation\SelectOptionValidator;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->user());
    }

    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'string'],
            'timezone' => ['required', new SelectOptionValidator(I18nHelper::timezones())],
            'date_format' => ['required', new SelectOptionValidator(I18nHelper::dateFormats())],
            'currency' => ['required', new SelectOptionValidator(I18nHelper::currencies())],
            'locale' => ['required', new SelectOptionValidator(I18nHelper::locales())],
            'hourly_rate' => ['required', 'numeric', 'min:0'],
            'hours_per_week' => ['required', 'numeric', 'integer', 'min:0'],
            'theme' => ['required', new SelectOptionValidator(I18nHelper::themes())],
        ];
    }
}
