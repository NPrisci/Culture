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
   

    // public function index()
    // {
    //     $contenus = Contenu::with(['region', 'langue', 'typeContenu'])->get();
    //     return view('contenus.index', compact('contenus'));
    // }

    public function index()
    {
        // Utilisez paginate() au lieu de get()
        $contenus = Contenu::with(['region', 'langue', 'typeContenu'])
            ->orderBy('date_creation', 'desc')
            ->paginate(10); 
        
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

    public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'texte' => 'required|string',
        'id_region' => 'required|exists:regions,id_region',
        'id_langue' => 'required|exists:langues,id_langue',
        'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
        'statut' => 'required|string|in:brouillon,publié,archivé',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'alt_image' => 'nullable|string|max:255',
        'lien_video' => 'nullable|url|max:500',
        'video_file' => 'nullable|file|mimes:mp4,avi,mov,mkv|max:51200',
        'titre_video' => 'nullable|string|max:255',
        'audio_file' => 'nullable|file|mimes:mp3,wav,m4a,ogg|max:20480',
        'titre_audio' => 'nullable|string|max:255',
        'duree_audio' => 'nullable|numeric|min:1|max:360',
    ]);

    $data = $request->except(['image', 'video_file', 'audio_file']); // exclure les fichiers
    $data['date_creation'] = now();
    $data['id_auteur'] = auth()->id() ?? 1;

    // Gestion image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $data['image'] = $imagePath;
    }

    // Gestion vidéo
    if ($request->hasFile('video_file')) {
        $videoPath = $request->file('video_file')->store('videos', 'public');
        $data['video_file'] = $videoPath;
    }

    // Gestion audio
    if ($request->hasFile('audio_file')) {
        $audioPath = $request->file('audio_file')->store('audios', 'public');
        $data['audio_file'] = $audioPath;
    }

    Contenu::create($data);

    return redirect()->route('contenus.index')
        ->with('success', 'Contenu créé avec succès.');
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
        'statut' => 'required|string|in:brouillon,publié,archivé',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'alt_image' => 'nullable|string|max:255',
        'lien_video' => 'nullable|url|max:500',
        'video_file' => 'nullable|file|mimes:mp4,avi,mov,mkv|max:51200',
        'titre_video' => 'nullable|string|max:255',
        'audio_file' => 'nullable|file|mimes:mp3,wav,m4a,ogg|max:20480',
        'titre_audio' => 'nullable|string|max:255',
        'duree_audio' => 'nullable|numeric|min:1|max:360',
    ]);

    $data = $request->except(['image', 'video_file', 'audio_file']);

    // Gestion image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si existante
        if ($contenu->image && \Storage::disk('public')->exists($contenu->image)) {
            \Storage::disk('public')->delete($contenu->image);
        }
        $imagePath = $request->file('image')->store('images', 'public');
        $data['image'] = $imagePath;
    }

    // Gestion vidéo
    if ($request->hasFile('video_file')) {
        if ($contenu->video_file && \Storage::disk('public')->exists($contenu->video_file)) {
            \Storage::disk('public')->delete($contenu->video_file);
        }
        $videoPath = $request->file('video_file')->store('videos', 'public');
        $data['video_file'] = $videoPath;
    }

    // Gestion audio
    if ($request->hasFile('audio_file')) {
        if ($contenu->audio_file && \Storage::disk('public')->exists($contenu->audio_file)) {
            \Storage::disk('public')->delete($contenu->audio_file);
        }
        $audioPath = $request->file('audio_file')->store('audios', 'public');
        $data['audio_file'] = $audioPath;
    }

    $contenu->update($data);

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