<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Client::class);
        $clients = $request->user()->clients()->orderByDesc('created_at')->paginate(20);

        return view('clients.index', [
            'clients' => $clients,
            'title' => __('client.list_title'),
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', Client::class);

        return view('clients.form', [
            'client' => new Client,
            'action' => route('clients.store'),
            'title' => __('client.create_title'),
        ]);
    }

    public function store(ClientFormRequest $request): RedirectResponse
    {
        Gate::authorize('create', Client::class);
        $request->user()->clients()->create(
            $request->validated()
        );

        return redirect()->route('clients.index')
            ->with('success', __('client.created'));
    }

    public function edit(Client $client): View
    {
        Gate::authorize('update', $client);

        return view('clients.form', [
            'action' => route('clients.update', $client),
            'client' => $client,
            'title' => __('client.edit_title'),
        ]);
    }

    public function update(ClientFormRequest $request, Client $client): RedirectResponse
    {
        Gate::authorize('update', $client);
        $client->update($request->validated());

        return redirect()->route('clients.index')
            ->with('success', __('client.updated'));
    }

    public function destroy(Client $client): RedirectResponse
    {
        Gate::authorize('delete', $client);
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', __('client.deleted'));
    }
}
