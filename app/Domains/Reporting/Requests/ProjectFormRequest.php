<?php

namespace App\Domains\Reporting\Requests;

use App\Domains\Reporting\Models\Project;
use App\Infrastructure\I18n\I18nHelper;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property Project|null $project
 */
class ProjectFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->project instanceof Project) {
            return $this->user()->can('update', $this->project);
        }

        return $this->user()->can('create', Project::class);
    }

    public function rules(): array
    {
        $ownedByUser = function (Builder $query) {
            $query->where('user_id', $this->user()->id);
        };
        return [
            'name' => ['required', 'string', 'min:5', 'max:255', Rule::unique('projects')
                ->where($ownedByUser)
                ->ignore($this->project)],
            'currency' => ['required', 'string', 'min:3', 'max:3', Rule::in(array_keys(I18nHelper::currencies()))],
            'client_id' => ['required', Rule::exists('clients', 'id')->where($ownedByUser)],
            'budget' => ['numeric', 'min:0'],
            'rate' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        return [
            ...$data,
            'budget' => $data['budget'] * 100,
            'rate' => $data['rate'] * 100,
        ];
    }
}
