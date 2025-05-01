<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $clients = Client::latest()->paginate(1);

        return view('clients.index', [
            'clients' => $clients,
            'title' => __('client.list_title'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('clients.form', [
            'client' => new Client(),
            'action' => route('clients.store'),
            'title' => __('client.create_title'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientFormRequest $request): RedirectResponse
    {
        $request->user()->clients()->create(
            $request->validated()
        );
        return redirect()->route('clients.index')
            ->with('success', __('client.created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): View
    {
        return view('clients.form', [
            'action' => route('clients.update', $client),
            'client' => $client,
            'title' => __('client.edit_title'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientFormRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')
            ->with('success', __('client.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', __('client.deleted'));
    }
}
