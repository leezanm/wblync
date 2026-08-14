<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChangePasswordController extends Controller
{
    public function edit(): View
    {
        return view('profile.change-password');
    }

    public function update(ChangePasswordRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $user->forceFill([
            'password' => $validated['password'],
        ])->save();

        return redirect()
            ->route('password.change.edit')
            ->with('success', 'Password updated successfully.');
    }
}
