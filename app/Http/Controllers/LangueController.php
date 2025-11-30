<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class LangueController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    //
    public function index()
    {
        $langues = Langue::all(); 

        return view('langue.index', compact('langues'));
    }

    public function show($id) {
        $langue = Langue::findOrFail($id);
        return view('langue.show', compact('langue'));
    }

     // FORMULAIRE AJOUT
    public function create()
    {
        return view('langue.create');
    }
     // INSERTION
    public function store(Request $request)
    {
        $request->validate([
            'nom_langue' => 'required',
            'code_langue' => 'required|unique:langues',
        ]);

        Langue::create($request->all());

        return redirect()->route('langues.index')
                         ->with('success', 'Langue ajoutée avec succès !');
    }
    // FORMULAIRE EDIT
    public function edit($id)
    {
        $langue = Langue::findOrFail($id);
        return view('langue.edit', compact('langue'));
    }

    // MODIFICATION
    public function update(Request $request, $id)
    {
        $langue = Langue::findOrFail($id);

        $request->validate([
            'nom_langue' => 'required',
            'code_langue' => 'required|unique:langues,code_langue,' . $id . ',id_langue',
        ]);

        $langue->update($request->all());

        return redirect()->route('langues.index')
                         ->with('success', 'Langue modifiée avec succès !');
    }
    // SUPPRESSION
    public function destroy($id)
    {
        Langue::destroy($id);

        return redirect()->route('langues.index')
                         ->with('success', 'Langue supprimée avec succès !');
    }
}
