<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeMedia;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $medias = Media::with(['contenu', 'typeMedia'])->get();
        return view('medias.index', compact('medias'));
    }

    public function create()
    {
        $contenus = Contenu::all();
        $typesMedia = TypeMedia::all();
        return view('medias.create', compact('contenus', 'typesMedia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chemin' => 'required|string|max:255',
            'description' => 'nullable|string',
            'id_contentu' => 'required|exists:contenus,id_contenu',
            'id_type_media' => 'required|exists:type_medias,id_type_media'
        ]);

        Media::create($request->all());

        return redirect()->route('medias.index')
            ->with('success', 'Média créé avec succès.');
    }

    public function show($id)
    {
        $media = Media::with(['contenu', 'typeMedia'])->findOrFail($id);
        return view('medias.show', compact('media'));
    }

    public function edit($id)
    {
        $media = Media::findOrFail($id);
        $contenus = Contenu::all();
        $typesMedia = TypeMedia::all();
        return view('medias.edit', compact('media', 'contenus', 'typesMedia'));
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'chemin' => 'required|string|max:255',
            'description' => 'nullable|string',
            'id_contentu' => 'required|exists:contenus,id_contenu',
            'id_type_media' => 'required|exists:type_medias,id_type_media'
        ]);

        $media->update($request->all());

        return redirect()->route('medias.index')
            ->with('success', 'Média mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return redirect()->route('medias.index')
            ->with('success', 'Média supprimé avec succès.');
    }
}