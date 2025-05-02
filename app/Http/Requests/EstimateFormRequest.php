<?php

namespace App\Http\Requests;

use App\Models\Estimate;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstimateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->method() === 'POST') {
            return $this->user()->can('create', Estimate::class);
        }

        $estimate = $this->route()->parameter('estimate');
        if (!$estimate instanceof Estimate) {
            throw new \Exception('Estimate not found');
        }

        return $this->user()->can('update', $estimate);
    }

    public function prepareForValidation()
    {
        $this->merge([
            'rows' => array_map(fn ($row) => [
                ...$row,
                'price' => $row['price'] * 100,
            ], json_decode($this->rows, true)),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $ownedByUser = function (Builder $query) {
            $query->where('user_id', $this->user()->id);
        };

        $rules = [
            'client_id' => [
                'required',
                Rule::exists('clients', 'id')->where($ownedByUser),
            ],
            'estimate_id' => ['required', 'numeric', 'min:1', Rule::unique('estimates')->where($ownedByUser)],
            'created_at' => ['required', 'date', 'before_or_equal:today'],
            'label' => ['required', 'string', 'max:255'],
            'rows' => ['required', 'array'],
            'rows.*.label' => ['required', 'string', 'max:255'],
            'rows.*.quantity' => ['required', 'numeric', 'min:0'],
            'rows.*.price' => ['required', 'numeric', 'min:0'],
            'tax' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', Rule::in(array_keys(config('i18n.currencies')))],
        ];

        if ($this->route()->parameter('estimate')) {
            unset($rules['estimate_id']);
        }

        return $rules;
    }

}
