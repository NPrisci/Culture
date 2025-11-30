<?php

namespace App\Http\Controllers;

use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenuController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $typesContenu = TypeContenu::all();
        return view('typecontenus.index', compact('typesContenu'));
    }

    public function create()
    {
        return view('typecontenus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_contenu' => 'required|string|max:255|unique:type_contenus,nom_contenu'
        ]);

        TypeContenu::create($request->all());

        return redirect()->route('typecontenus.index')
            ->with('success', 'Type de contenu créé avec succès.');
    }

    public function show($id)
    {
        $typeContenu = TypeContenu::findOrFail($id);
        return view('typecontenus.show', compact('typeContenu'));
    }

    public function edit($id)
    {
        $typeContenu = TypeContenu::findOrFail($id);
        return view('typecontenus.edit', compact('typeContenu'));
    }

    public function update(Request $request, $id)
    {
        $typeContenu = TypeContenu::findOrFail($id);

        $request->validate([
            'nom_contenu' => 'required|string|max:255|unique:type_contenus,nom_contenu,' . $id . ',id_type_contenu'
        ]);

        $typeContenu->update($request->all());

        return redirect()->route('typecontenus.index')
            ->with('success', 'Type de contenu mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $typeContenu = TypeContenu::findOrFail($id);
        $typeContenu->delete();

        return redirect()->route('typecontenus.index')
            ->with('success', 'Type de contenu supprimé avec succès.');
    }
}