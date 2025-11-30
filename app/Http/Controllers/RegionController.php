<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|integer|min:0',
            'superficie' => 'nullable|numeric|min:0',
            'localisation' => 'nullable|string|max:255'
        ]);

        Region::create($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Région créée avec succès.');
    }

    public function show($id)
    {
        $region = Region::findOrFail($id);
        return view('regions.show', compact('region'));
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, $id)
    {
        $region = Region::findOrFail($id);

        $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|integer|min:0',
            'superficie' => 'nullable|numeric|min:0',
            'localisation' => 'nullable|string|max:255'
        ]);

        $region->update($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Région mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        return redirect()->route('regions.index')
            ->with('success', 'Région supprimée avec succès.');
    }
}