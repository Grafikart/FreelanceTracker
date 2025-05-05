<?php

namespace App\Http\Controllers;

use App\Domains\Reporting\Models\Task;
use App\Domains\Reporting\Requests\TaskFormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Task::class);
        $tasks = $request->user()->tasks()->orderByDesc('created_at');

        $state = $request->query('state');
        if ($state === 'deleted') {
            $tasks = $tasks->onlyTrashed(); // @phpstan-ignore-line scope is not recognized
        }

        return view('reporting.tasks.index', [
            'task' => new Task,
            'state' => $state,
            'tasks' => $tasks->get(),
            'title' => __('task.list_title'),
        ]);
    }

    public function store(TaskFormRequest $request): View
    {
        $task = $request->user()->tasks()->create(
            $request->validated()
        );

        return view('reporting.tasks.row', [
            'task' => $task,
        ]);
    }

    public function edit(Task $task): View
    {
        Gate::authorize('update', $task);

        return view('reporting.tasks.form', [
            'task' => $task,
        ]);
    }

    public function update(TaskFormRequest $request, Task $task): View
    {
        $task->update($request->validated());

        return view('reporting.tasks.row', [
            'task' => $task,
        ]);
    }

    public function show(Task $task): View
    {
        Gate::authorize('update', $task);

        return view('reporting.tasks.form', [
            'task' => $task,
        ]);
    }

    public function destroy(Task $task): Response
    {
        Gate::authorize('delete', $task);
        if ($task->trashed()) {
            $task->restore();
        } else {
            $task->delete();
        }

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
