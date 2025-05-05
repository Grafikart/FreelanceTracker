<?php

namespace App\Http\Controllers;

use App\Domains\Reporting\Models\Project;
use App\Domains\Reporting\Requests\ProjectFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', Project::class);

        $user = $this->user();
        $builder = $this
            ->user()
            ->projects()
            ->with('client')
            ->active() // @phpstan-ignore-line scope is not recognized
            ->orderByDesc('created_at')
            ->get();

        return view('reporting.projects.index', [
            'user' => $user,
            'projects' => $builder,
            'title' => __('project.list_title'),
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', Project::class);

        $user = $this->user();

        return view('reporting.projects.form', [
            'user' => $user,
            'project' => Project::makeFromUser($user),
            'clients' => $user->clients()->pluck('name', 'id'),
            'action' => route('projects.store'),
            'title' => __('project.create_title'),
        ]);
    }

    public function store(ProjectFormRequest $request): RedirectResponse
    {
        $this->user()->projects()->create(
            $request->validated()
        );

        return redirect()->route('projects.index')->with('success', __('project.created'));
    }

    public function edit(Project $project): View
    {
        Gate::authorize('update', $project);

        $user = $this->user();

        return view('reporting.projects.form', [
            'user' => $user,
            'project' => $project,
            'clients' => $user->clients()->pluck('name', 'id'),
            'action' => route('projects.update', $project),
            'title' => __('project.edit_title'),
        ]);
    }

    public function update(ProjectFormRequest $request, Project $project): RedirectResponse
    {
        $project->update(
            $request->validated()
        );

        return redirect()->route('projects.index')->with('success', __('project.updated'));
    }
}
