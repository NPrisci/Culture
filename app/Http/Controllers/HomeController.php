<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function edit($id) {
        $langue = Langue::findOrFail($id);
        return view('langue.show', compact('langue'));
    }

    // public function index()
    // {
    //     return view('langue.lang');
    // }
    public function index()
    {
         $utilisateurs = User::with(['role', 'langue'])->get();
        return view('dashboard', compact('utilisateurs'));
     }

     public function indexuser()
    {
        return view('user');
    }
 
    public function indexmoderateur()
    {
        return view('moderateur');
    }

    public function datatable()
    {
        $langues = Langue::withCount(['utilisateurs', 'contenus', 'regions']);

        return DataTables::of($langues)
            ->addColumn('action', function($langue) {
                return view('langue.actions', compact('langue'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function accueil()
    {
        return view('pages.accueil');
    }

    public function aPropos()
    {
        return view('pages.about');
    }

    public function patrimoine()
    {
        return view('pages.patrimoine');
    }

    public function patrimoineDetails($slug)
    {
        return view('pages.patrimoine-details', compact('slug'));
    }

    public function galerie()
    {
        return view('pages.services');
    }

    public function communaute()
    {
        return view('pages.team');
    }

    public function contact()
    {
        return view('pages.contact');
    }

}