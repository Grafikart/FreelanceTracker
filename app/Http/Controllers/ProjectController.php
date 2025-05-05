<?php

namespace App\Http\Controllers;

use App\Domains\Reporting\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Project::class);

        $builder = $request
            ->user()
            ->projects()
            ->with('client')
            ->active() // @phpstan-ignore-line scope is not recognized
            ->orderByDesc('created_at')
            ->get();

        return view('reporting.projects.index', [
            'user' => $this->user(),
            'projects' => $builder,
            'title' => __('project.list_title'),
        ]);
    }
}
