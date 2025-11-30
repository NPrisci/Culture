<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function edit()
{
    return view('profile.edit', [
        'user' => Auth::user(),
        'langues' => \App\Models\Langue::all(),
    ]);
}

public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'nom'            => 'required|string|max:255',
        'prenom'         => 'required|string|max:255',
        'email'          => 'required|email|unique:users,email,' . $user->id_utilisateur . ',id_utilisateur',
        'sexe'           => 'nullable|in:H,F',
        'date_naissance' => 'nullable|date',
        'id_langue'      => 'nullable|exists:langues,id_langue',
        'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Upload de photo si existe
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/photos'), $filename);

        $validated['photo'] = $filename;
    }

    $user->update($validated);

    return back()->with('status', 'Profil mis à jour avec succès !');
}


    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
