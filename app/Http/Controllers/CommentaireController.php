<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\User;
use App\Models\Contenu;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $commentaires = Commentaire::with(['utilisateur', 'contenu'])->get();
        return view('commentaires.index', compact('commentaires'));
    }

    public function create()
    {
        $utilisateurs = User::all();
        $contenus = Contenu::all();
        return view('commentaires.create', compact('utilisateurs', 'contenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'texte' => 'required|string',
            'note' => 'nullable|integer|min:1|max:5',
            'id_utilisateur' => 'required|exists:users,id',
            'id_contentu' => 'required|exists:contenus,id_contenu'
        ]);

        $data = $request->all();
        $data['date'] = now();

        Commentaire::create($data);

        return redirect()->route('commentaires.index')
            ->with('success', 'Commentaire créé avec succès.');
    }

    public function show($id)
    {
        $commentaire = Commentaire::with(['utilisateur', 'contenu'])->findOrFail($id);
        return view('commentaires.show', compact('commentaire'));
    }

    public function edit($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $utilisateurs = User::all();
        $contenus = Contenu::all();
        return view('commentaires.edit', compact('commentaire', 'utilisateurs', 'contenus'));
    }

    public function update(Request $request, $id)
    {
        $commentaire = Commentaire::findOrFail($id);

        $request->validate([
            'texte' => 'required|string',
            'note' => 'nullable|integer|min:1|max:5',
            'id_utilisateur' => 'required|exists:users,id',
            'id_contentu' => 'required|exists:contenus,id_contenu'
        ]);

        $commentaire->update($request->all());

        return redirect()->route('commentaires.index')
            ->with('success', 'Commentaire mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->delete();

        return redirect()->route('commentaires.index')
            ->with('success', 'Commentaire supprimé avec succès.');
    }
}