<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $utilisateurs = User::with(['role', 'langue'])->get();
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function create()
    {
        $roles = Role::all();
        $langues = Langue::all();
        return view('utilisateurs.create', compact('roles', 'langues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'prenom' => 'nullable|string|max:255',
            'id_role' => 'nullable|exists:roles,id_role',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'statut' => 'required|string|in:actif,inactif'
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'prenom' => $request->prenom,
            'id_role' => $request->id_role,
            'id_langue' => $request->id_langue,
            'statut' => $request->statut,
            'date_inscription' => now(),
        ]);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    // SOLUTION SIMPLE : Utiliser l'ID directement
    public function show($id)
    {
        $utilisateur = User::with(['role', 'langue', 'contenus', 'commentaires'])->findOrFail($id);
        return view('utilisateurs.show', compact('utilisateur'));
    }

    public function edit($id)
    {
        $utilisateur = User::findOrFail($id);
        $roles = Role::all();
        $langues = Langue::all();
        return view('utilisateurs.edit', compact('utilisateur', 'roles', 'langues'));
    }

    public function update(Request $request, $id)
    {
        $utilisateur = User::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id_utilisateur',
            'prenom' => 'nullable|string|max:255',
            'id_role' => 'nullable|exists:roles,id_role',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'statut' => 'required|string|in:actif,inactif'
        ]);

        $data = $request->only(['nom', 'email', 'prenom', 'id_role', 'id_langue', 'statut']);
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed'
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $utilisateur->update($data);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}