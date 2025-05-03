<?php

namespace App\Http\Controllers;

use App\Domains\Settings\Requests\SettingRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    public function index(): View
    {
        return view('settings.index', [
            'user' => $this->user(),
        ]);
    }

    public function store(SettingRequest $request): RedirectResponse
    {
        $this->user()->update($request->validated());

        return redirect()->route('settings')->with('success', __('settings.updated'));
    }

    public function company(): void {}

    public function profile(): void {}
}
