<?php

namespace App\Domains\Reporting\Requests;

use App\Domains\Reporting\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property Task|null $task
 */
class TaskFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->task instanceof Task) {
            $this->redirect = route('tasks.update', $this->task);

            return $this->user()->can('update', $this->task);
        }

        return $this->user()->can('create', Task::class);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:255', Rule::unique(Task::class)->where('user_id', $this->user()->id)],
        ];
    }
}
