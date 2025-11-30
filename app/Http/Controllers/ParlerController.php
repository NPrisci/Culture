<?php

namespace App\Http\Controllers;

use App\Models\Parler;
use App\Models\Region;
use App\Models\Langue;
use Illuminate\Http\Request;

class ParlerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $parlers = Parler::with(['region', 'langue'])->get();
        return view('parler.index', compact('parlers'));
    }

    public function create()
    {
        $regions = Region::all();
        $langues = Langue::all();
        return view('parler.create', compact('regions', 'langues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue'
        ]);

        // Vérifier si la relation existe déjà
        $exists = Parler::where('id_region', $request->id_region)
            ->where('id_langue', $request->id_langue)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Cette relation région-langue existe déjà.');
        }

        Parler::create($request->all());

        return redirect()->route('parler.index')
            ->with('success', 'Relation région-langue créée avec succès.');
    }

    public function show($id)
    {
        $parler = Parler::with(['region', 'langue'])->findOrFail($id);
        return view('parler.show', compact('parler'));
    }

    public function edit($id)
    {
        $parler = Parler::findOrFail($id);
        $regions = Region::all();
        $langues = Langue::all();
        return view('parler.edit', compact('parler', 'regions', 'langues'));
    }

    public function update(Request $request, $id)
    {
        $parler = Parler::findOrFail($id);

        $request->validate([
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue'
        ]);

        $parler->update($request->all());

        return redirect()->route('parler.index')
            ->with('success', 'Relation région-langue mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $parler = Parler::findOrFail($id);
        $parler->delete();

        return redirect()->route('parler.index')
            ->with('success', 'Relation région-langue supprimée avec succès.');
    }
}