<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use App\Models\User;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
   

    public function index()
    {
        $contenus = Contenu::with(['region', 'langue', 'typeContenu'])->get();
        return view('contenus.index', compact('contenus'));
    }

    public function create()
    {
        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();
        $utilisateurs = User::all();
        
        return view('contenus.create', compact('regions', 'langues', 'typesContenu', 'utilisateurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'statut' => 'required|string|in:brouillon,publié,archivé'
        ]);

        $data = $request->all();
        $data['date_creation'] = now();
        $data['id_auteur'] = auth()->id() ?? 1;

        Contenu::create($data);

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu créé avec succès.');
    }

    public function show($id)
    {
        $contenu = Contenu::with(['region', 'langue', 'typeContenu', 'auteur', 'medias'])->findOrFail($id);
        return view('contenus.show', compact('contenu'));
    }

    public function edit($id)
    {
        $contenu = Contenu::findOrFail($id);
        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();
        $utilisateurs = User::all();
        
        return view('contenus.edit', compact('contenu', 'regions', 'langues', 'typesContenu', 'utilisateurs'));
    }

    public function update(Request $request, $id)
    {
        $contenu = Contenu::findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'statut' => 'required|string|in:brouillon,publié,archivé'
        ]);

        $contenu->update($request->all());

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $contenu = Contenu::findOrFail($id);
        $contenu->delete();

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu supprimé avec succès.');
    }
}