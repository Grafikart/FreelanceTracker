<?php

namespace App\Domains\Estimates\Requests;

use App\Domains\Estimates\Estimate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Update estimate state
 * @property \App\Domains\Estimates\Estimate $estimate
 */
class EstimateStateFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->hasValidSignature(true) || $this->user()->can('update', $this->estimate);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'state' => ['required', 'integer', Rule::in([
                Estimate::STATUS_APPROVED,
                Estimate::STATUS_REJECTED,
            ])],
        ];
    }
}
