<?php

namespace App\Http\Controllers;

use App\Models\TypeMedia;
use Illuminate\Http\Request;

class TypeMediaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $typesMedia = TypeMedia::all();
        return view('typemedias.index', compact('typesMedia'));
    }

    public function create()
    {
        return view('typemedias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_media' => 'required|string|max:255|unique:type_medias,nom_media'
        ]);

        TypeMedia::create($request->all());

        return redirect()->route('typemedias.index')
            ->with('success', 'Type de média créé avec succès.');
    }

    public function show($id)
    {
        $typeMedia = TypeMedia::findOrFail($id);
        return view('typemedias.show', compact('typeMedia'));
    }

    public function edit($id)
    {
        $typeMedia = TypeMedia::findOrFail($id);
        return view('typemedias.edit', compact('typeMedia'));
    }

    public function update(Request $request, $id)
    {
        $typeMedia = TypeMedia::findOrFail($id);

        $request->validate([
            'nom_media' => 'required|string|max:255|unique:type_medias,nom_media,' . $id . ',id_type_media'
        ]);

        $typeMedia->update($request->all());

        return redirect()->route('typemedias.index')
            ->with('success', 'Type de média mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $typeMedia = TypeMedia::findOrFail($id);
        $typeMedia->delete();

        return redirect()->route('typemedias.index')
            ->with('success', 'Type de média supprimé avec succès.');
    }
}