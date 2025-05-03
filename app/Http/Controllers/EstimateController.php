<?php

namespace App\Http\Controllers;

use App\Domains\Estimates\Requests\EstimateFormRequest;
use App\Domains\Estimates\Requests\EstimateStateFormRequest;
use App\Domains\Clients\Client;
use App\Domains\Estimates\Estimate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class EstimateController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Estimate::class);
        $tab = $request->query('tab', 'open');

        $builder = $request
            ->user()
            ->estimates()
            ->with('client')
            ->when($tab === 'open', fn($query) => $query->open()) // @phpstan-ignore-line scope is not recognized
            ->orderByDesc('created_at');
        $estimates = $tab === 'open' ? $builder->get() : $builder->paginate(20);

        return view('estimates.index', [
            'user' => $this->user(),
            'estimates' => $estimates,
            'tab' => $tab,
            // @phpstan-ignore-next-line open scope is not recognized
            'count' => $tab === 'open' ? $estimates->count() : $request->user()->estimates()->open()->count(),
            'title' => __('estimate.list_title'),
        ]);
    }

    public function show(Request $request, Estimate $estimate)
    {
        if ($request->hasValidSignature(true)) {
            return view('estimates.public', [
                'estimate' => $estimate,
            ]);
        }

        Gate::authorize('view', $estimate);
        return view('estimates.show', [
            'estimate' => $estimate,
            'url' => \URL::signedRoute('estimates.show', $estimate, now()->addDays(10), true),
            'title' => __('estimate.show_title'),
        ]);
    }

    public function pdf(Request $request, Estimate $estimate)
    {
        Gate::authorize('view', $estimate);
        if ($request->query('mode') === 'html') {
            return view('estimates.pdf', ['estimate' => $estimate, 'mode' => 'html']);
        }
        $pdf = Pdf::loadView('estimates.pdf', [
            'estimate' => $estimate,
        ]);
        return $pdf->stream('estimate.pdf');
    }

    public function create(): View
    {
        Gate::authorize('create', Estimate::class);

        $user = $this->user();
        return view('estimates.form', [
            'estimate' => Estimate::makeFromUser($user),
            'action' => route('estimates.store'),
            'clients' => Client::clientsOptions($user),
            'title' => __('estimate.create_title'),
        ]);
    }

    public function store(EstimateFormRequest $request): RedirectResponse
    {
        $request->user()->estimates()->create(
            $request->validated()
        );

        return redirect()->route('estimates.index')
            ->with('success', __('estimate.created'));
    }

    public function edit(Request $request, Estimate $estimate): View
    {
        Gate::authorize('update', $estimate);
        return view('estimates.form', [
            'action' => route('estimates.update', $estimate),
            'estimate' => $estimate,
            'clients' => Client::clientsOptions($request->user()),
            'title' => __('estimate.edit_title'),
        ]);
    }

    public function update(EstimateFormRequest $request, Estimate $estimate): RedirectResponse
    {
        $estimate->update($request->validated());

        return redirect()->route('estimates.index')
            ->with('success', __('estimate.updated'));
    }

    /**
     * Update estimate state
     */
    public function state(EstimateStateFormRequest $request, Estimate $estimate): RedirectResponse
    {
        $estimate->update($request->validated());

        return redirect()->back()->with('success', __('estimate.updated'));
    }

    public function destroy(Estimate $estimate): RedirectResponse
    {
        Gate::authorize('delete', $estimate);
        $estimate->delete();

        return redirect()->route('estimates.index')
            ->with('success', __('estimate.deleted'));
    }
}
