<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use App\Models\Region;
use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    public function accueil()
    {
        // Langues populaires (celles avec le plus de contenus)
        $languesPopulaires = Langue::withCount(['contenus'])
            ->orderBy('contenus_count', 'desc')
            ->take(4)
            ->get();
            
        // Régions avec statistiques
        $regions = Region::withCount(['contenus', 'langues'])
            ->whereNotNull('population')
            ->orderBy('population', 'desc')
            ->take(6)
            ->get();
            
        // Contenus récents publiés
        $contenusRecents = Contenu::with(['region', 'langue', 'medias'])
            ->where('statut', 'publié')
            ->orderBy('date_creation', 'desc')
            ->take(6)
            ->get();
            
        return view('visiteur.acceuil', compact('languesPopulaires', 'regions', 'contenusRecents'));
    }
    
    public function recherche(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return redirect()->route('accueil');
        }
        
        // Recherche dans les langues
        $langues = Langue::where('nom_langue', 'LIKE', "%{$query}%")
            ->orWhere('code_langue', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();
            
        // Recherche dans les régions
        $regions = Region::where('nom_region', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('localisation', 'LIKE', "%{$query}%")
            ->get();
            
        // Recherche dans les contenus publiés
        $contenus = Contenu::where('titre', 'LIKE', "%{$query}%")
            ->orWhere('texte', 'LIKE', "%{$query}%")
            ->where('statut', 'publié')
            ->with(['region', 'langue'])
            ->get();
            
        return view('visiteur.recherche', compact('query', 'langues', 'regions', 'contenus'));
    }
    
    public function aPropos()
    {
        // Statistiques pour la page à propos
        $totalLangues = Langue::count();
        $totalRegions = Region::count();
        $totalContenus = Contenu::where('statut', 'publié')->count();
        $totalCommentaires = Commentaire::count();
        
        return view('visiteur.apropos', compact(
            'totalLangues', 
            'totalRegions', 
            'totalContenus',
            'totalCommentaires'
        ));
    }
    
    public function contact()
    {
        return view('visiteur.contact');
    }
    
    public function soumettreContact(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);
        
        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès !');
    }
    
    public function politiqueConfidentialite()
    {
        return view('visiteur.politique-confidentialite');
    }
    
    public function conditionsUtilisation()
    {
        return view('visiteur.conditions-utilisation');
    }

    //region
    public function indexregion(Request $request)
    {
        $query = Region::withCount(['contenus', 'langues']);
        
        // Recherche
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nom_region', 'LIKE', "%{$request->search}%")
                  ->orWhere('description', 'LIKE', "%{$request->search}%")
                  ->orWhere('localisation', 'LIKE', "%{$request->search}%");
            });
        }
        
        // Tri
        switch ($request->input('sort', 'nom')) {
            case 'population_desc':
                $query->orderBy('population', 'desc');
                break;
            case 'superficie_desc':
                $query->orderBy('superficie', 'desc');
                break;
            default:
                $query->orderBy('nom_region');
                break;
        }
        
        // Filtre par localisation
        if ($request->has('localisation') && $request->localisation) {
            $query->where('localisation', $request->localisation);
        }
        
        $regions = $query->paginate(12);
        
        // Statistiques sans DB
        $allRegions = Region::all();
        
        $totalPopulation = $allRegions->sum('population') ?? 0;
        $totalSuperficie = $allRegions->sum('superficie') ?? 0;
        
        // Compter les langues uniques via les relations
        $languesUniques = collect();
        foreach ($allRegions as $region) {
            $languesUniques = $languesUniques->merge($region->langues);
        }
        $totalLangues = $languesUniques->unique('id_langue')->count();
        
        $regionPlusPeuplee = Region::orderBy('population', 'desc')->first();
        
        return view('visiteur.region', compact(
            'regions', 
            'totalPopulation', 
            'totalSuperficie', 
            'totalLangues',
            'regionPlusPeuplee'
        ));
    }
    
    public function showregion(Region $region)
    {
        $region->load(['contenus', 'langues', 'contenus.medias', 'contenus.langue', 'contenus.commentaires']);
        
        // Contenus populaires de cette région
        $contenusPopulaires = $region->contenus()
            ->withCount('commentaires')
            ->orderBy('commentaires_count', 'desc')
            ->take(5)
            ->get();
            
        // Régions voisines (même localisation)
        $regionsVoisines = Region::where('id_region', '!=', $region->id_region)
            ->when($region->localisation, function($query) use ($region) {
                return $query->where('localisation', $region->localisation);
            })
            ->take(3)
            ->get();
        
        // Navigation
        $previousRegion = Region::where('nom_region', '<', $region->nom_region)
            ->orderBy('nom_region', 'desc')
            ->first();
            
        $nextRegion = Region::where('nom_region', '>', $region->nom_region)
            ->orderBy('nom_region', 'asc')
            ->first();
        
        return view('visiteur.regionshow', compact(
            'region', 
            'contenusPopulaires', 
            'regionsVoisines',
            'previousRegion',
            'nextRegion'
        ));
    }

    //langue
     public function indexlangue(Request $request)
    {
        $query = Langue::withCount(['utilisateurs', 'contenus', 'regions']);
        
        // Recherche
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nom_langue', 'LIKE', "%{$request->search}%")
                  ->orWhere('code_langue', 'LIKE', "%{$request->search}%")
                  ->orWhere('description', 'LIKE', "%{$request->search}%");
            });
        }
        
        // Filtre par région
        if ($request->has('region') && $request->region) {
            $query->whereHas('regions', function($q) use ($request) {
                $q->where('id_region', $request->region);
            });
        }
        
        $langues = $query->orderBy('nom_langue')->paginate(12);
        $regions = Region::all();
        
        // Compter les régions avec des langues
        $regionsCount = Region::has('langues')->count();
        
        return view('visiteur.langue', compact('langues', 'regions', 'regionsCount'));
    }
    
    public function showlangue(Langue $langue)
    {
        $langue->load(['utilisateurs', 'contenus', 'regions', 'contenus.region', 'contenus.commentaires']);
        
        // Navigation
        $previousLangue = Langue::where('nom_langue', '<', $langue->nom_langue)
            ->orderBy('nom_langue', 'desc')
            ->first();
            
        $nextLangue = Langue::where('nom_langue', '>', $langue->nom_langue)
            ->orderBy('nom_langue', 'asc')
            ->first();
        
        return view('visiteur.langueshow', compact('langue', 'previousLangue', 'nextLangue'));
    }

    //contenu
    public function indexcontenu(Request $request)
    {
        $query = Contenu::with(['region', 'langue', 'typeContenu', 'medias'])
            ->where('statut', 'publié');
        
        // Recherche
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'LIKE', "%{$request->search}%")
                  ->orWhere('texte', 'LIKE', "%{$request->search}%");
            });
        }
        
        // Filtres
        if ($request->has('region') && $request->region) {
            $query->where('id_region', $request->region);
        }
        
        if ($request->has('langue') && $request->langue) {
            $query->where('id_langue', $request->langue);
        }
        
        if ($request->has('type_contenu') && $request->type_contenu) {
            $query->where('id_type_contenu', $request->type_contenu);
        }
        
        // Tri
        switch ($request->input('sort', 'recent')) {
            case 'ancien':
                $query->orderBy('date_creation', 'asc');
                break;
            case 'populaire':
                $query->withCount('commentaires')->orderBy('commentaires_count', 'desc');
                break;
            case 'commented':
                $query->withCount('commentaires')->orderBy('commentaires_count', 'desc');
                break;
            default:
                $query->orderBy('date_creation', 'desc');
                break;
        }
        
        $contenus = $query->paginate(12);
        
        // Données pour les filtres
        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();
        
        // Statistiques sans DB
        $languesCount = Langue::count();
        $regionsCount = Region::count();
        $totalCommentaires = Commentaire::count();
        
        // Contenu vedette (le plus commenté)
        $contenuVedette = Contenu::withCount('commentaires')
            ->where('statut', 'publié')
            ->orderBy('commentaires_count', 'desc')
            ->first();
        
        return view('visiteur.contenu', compact(
            'contenus',
            'regions',
            'langues',
            'typesContenu',
            'languesCount',
            'regionsCount',
            'totalCommentaires',
            'contenuVedette'
        ));
    }
    
    public function showcontenu(Contenu $contenu)
    {
        // Vérifier si le contenu est publié
        if ($contenu->statut !== 'publié') {
            abort(404);
        }
        
        $contenu->load([
            'region', 
            'langue', 
            'typeContenu', 
            'medias', 
            'medias.typeMedia', 
            'commentaires.utilisateur', 
            'auteur',
            'commentaires' => function($query) {
                $query->orderBy('date', 'desc');
            }
        ]);
        
        // Contenus similaires (même région et langue)
        $contenusSimilaires = Contenu::where('id_region', $contenu->id_region)
            ->where('id_langue', $contenu->id_langue)
            ->where('id_contenu', '!=', $contenu->id_contenu)
            ->where('statut', 'publié')
            ->with(['region', 'langue'])
            ->take(3)
            ->get();
            
        // Navigation
        $previousContenu = Contenu::where('date_creation', '<', $contenu->date_creation)
            ->where('statut', 'publié')
            ->orderBy('date_creation', 'desc')
            ->first();
            
        $nextContenu = Contenu::where('date_creation', '>', $contenu->date_creation)
            ->where('statut', 'publié')
            ->orderBy('date_creation', 'asc')
            ->first();
        
        return view('visiteur.contenushow', compact(
            'contenu',
            'contenusSimilaires',
            'previousContenu',
            'nextContenu'
        ));
    }
    
    public function storeCommentaire(Request $request)
    {
        $request->validate([
            'id_contentu' => 'required|exists:contenu,id_contenu',
            'texte' => 'required|string|min:3|max:1000',
            'note' => 'nullable|integer|min:1|max:5',
        ]);
        
   
        $commentaire = Commentaire::create([
            'texte' => $request->texte,
            'note' => $request->note,
            'date' => now(),
            'id_utilisateur' => 1, 
            'id_contentu' => $request->id_contentu,
        ]);
        
        return redirect()->route('contenushow.public', $request->id_contentu)
            ->with('success', 'Votre commentaire a été publié !');
    }
}

// class VisiteurController extends Controller
// {
//     public function accueil()
//     {
//         $languesPopulaires = Langue::withCount(['utilisateurs', 'contenus', 'regions'])
//             ->orderBy('contenus_count', 'desc')
//             ->take(4)
//             ->get();
            
//         $regions = Region::withCount(['contenus', 'langues'])
//             ->orderBy('population', 'desc')
//             ->take(6)
//             ->get();
            
//         $contenusRecents = Contenu::with(['region', 'langue', 'medias'])
//             ->where('statut', 'publié')
//             ->orderBy('date_creation', 'desc')
//             ->take(6)
//             ->get();
            
//         return view('visiteur.accueil', compact('languesPopulaires', 'regions', 'contenusRecents'));
//     }
    
//     public function recherche(Request $request)
//     {
//         $query = $request->input('q');
        
//         $langues = Langue::where('nom_langue', 'LIKE', "%{$query}%")
//             ->orWhere('code_langue', 'LIKE', "%{$query}%")
//             ->orWhere('description', 'LIKE', "%{$query}%")
//             ->get();
            
//         $regions = Region::where('nom_region', 'LIKE', "%{$query}%")
//             ->orWhere('description', 'LIKE', "%{$query}%")
//             ->orWhere('localisation', 'LIKE', "%{$query}%")
//             ->get();
            
//         $contenus = Contenu::where('titre', 'LIKE', "%{$query}%")
//             ->orWhere('texte', 'LIKE', "%{$query}%")
//             ->where('statut', 'publié')
//             ->get();
            
//         return view('visiteur.recherche', compact('query', 'langues', 'regions', 'contenus'));
//     }
// }

// Contrôleur pour Langues publiques
// class LangueController extends Controller
// {
//     // ... méthodes admin existantes ...
    
//     public function indexPublic(Request $request)
//     {
//         $query = Langue::withCount(['utilisateurs', 'contenus', 'regions']);
        
//         // Recherche
//         if ($request->has('search') && $request->search) {
//             $query->where('nom_langue', 'LIKE', "%{$request->search}%")
//                   ->orWhere('code_langue', 'LIKE', "%{$request->search}%")
//                   ->orWhere('description', 'LIKE', "%{$request->search}%");
//         }
        
//         // Filtre par région
//         if ($request->has('region') && $request->region) {
//             $query->whereHas('regions', function($q) use ($request) {
//                 $q->where('id_region', $request->region);
//             });
//         }
        
//         $langues = $query->paginate(12);
//         $regions = Region::all();
//         $regionsCount = Region::count();
        
//         return view('visiteur.langues.index', compact('langues', 'regions', 'regionsCount'));
//     }
    
//     public function showPublic(Langue $langue)
//     {
//         $langue->load(['utilisateurs', 'contenus', 'regions']);
        
//         // Langues précédente et suivante pour la navigation
//         $previousLangue = Langue::where('id_langue', '<', $langue->id_langue)
//             ->orderBy('id_langue', 'desc')
//             ->first();
            
//         $nextLangue = Langue::where('id_langue', '>', $langue->id_langue)
//             ->orderBy('id_langue', 'asc')
//             ->first();
        
//         return view('visiteur.langues.show', compact('langue', 'previousLangue', 'nextLangue'));
//     }
// }

// Contrôleur pour Régions publiques
// class RegionController extends Controller
// {
//     // ... méthodes admin existantes ...
    
//     public function indexPublic(Request $request)
//     {
//         $query = Region::withCount(['contenus', 'langues']);
        
//         // Recherche
//         if ($request->has('search') && $request->search) {
//             $query->where('nom_region', 'LIKE', "%{$request->search}%")
//                   ->orWhere('description', 'LIKE', "%{$request->search}%")
//                   ->orWhere('localisation', 'LIKE', "%{$request->search}%");
//         }
        
//         // Tri
//         if ($request->has('sort')) {
//             switch ($request->sort) {
//                 case 'nom':
//                     $query->orderBy('nom_region');
//                     break;
//                 case 'population_desc':
//                     $query->orderBy('population', 'desc');
//                     break;
//                 case 'superficie_desc':
//                     $query->orderBy('superficie', 'desc');
//                     break;
//             }
//         } else {
//             $query->orderBy('nom_region');
//         }
        
//         // Filtre par localisation
//         if ($request->has('localisation')) {
//             $query->where('localisation', $request->localisation);
//         }
        
//         $regions = $query->paginate(12);
        
//         // Statistiques
//         $totalPopulation = Region::sum('population');
//         $totalSuperficie = Region::sum('superficie');
//         $totalLangues = \DB::table('parler')->distinct('id_langue')->count('id_langue');
//         $regionPlusPeuplee = Region::orderBy('population', 'desc')->first();
        
//         return view('visiteur.regions.index', compact(
//             'regions', 
//             'totalPopulation', 
//             'totalSuperficie', 
//             'totalLangues',
//             'regionPlusPeuplee'
//         ));
//     }
    
//     public function showPublic(Region $region)
//     {
//         $region->load(['contenus', 'langues', 'contenus.medias', 'contenus.langue']);
        
//         // Contenus populaires
//         $contenusPopulaires = $region->contenus()
//             ->withCount('commentaires')
//             ->orderBy('commentaires_count', 'desc')
//             ->take(5)
//             ->get();
            
//         // Régions voisines
//         $regionsVoisines = Region::where('id_region', '!=', $region->id_region)
//             ->where('localisation', $region->localisation)
//             ->take(3)
//             ->get();
        
//         // Régions précédente et suivante pour la navigation
//         $previousRegion = Region::where('id_region', '<', $region->id_region)
//             ->orderBy('id_region', 'desc')
//             ->first();
            
//         $nextRegion = Region::where('id_region', '>', $region->id_region)
//             ->orderBy('id_region', 'asc')
//             ->first();
        
//         return view('visiteur.regions.show', compact(
//             'region', 
//             'contenusPopulaires', 
//             'regionsVoisines',
//             'previousRegion',
//             'nextRegion'
//         ));
//     }
// }

// // Contrôleur pour Contenus publics
// class ContenuController extends Controller
// {
//     // ... méthodes admin existantes ...
    
//     public function indexPublic(Request $request)
//     {
//         $query = Contenu::with(['region', 'langue', 'typeContenu', 'medias'])
//             ->where('statut', 'publié');
        
//         // Recherche
//         if ($request->has('search') && $request->search) {
//             $query->where('titre', 'LIKE', "%{$request->search}%")
//                   ->orWhere('texte', 'LIKE', "%{$request->search}%");
//         }
        
//         // Filtres
//         if ($request->has('region') && $request->region) {
//             $query->where('id_region', $request->region);
//         }
        
//         if ($request->has('langue') && $request->langue) {
//             $query->where('id_langue', $request->langue);
//         }
        
//         if ($request->has('type_contenu') && $request->type_contenu) {
//             $query->where('id_type_contenu', $request->type_contenu);
//         }
        
//         // Tri
//         if ($request->has('sort')) {
//             switch ($request->sort) {
//                 case 'recent':
//                     $query->orderBy('date_creation', 'desc');
//                     break;
//                 case 'ancien':
//                     $query->orderBy('date_creation', 'asc');
//                     break;
//                 case 'populaire':
//                     $query->withCount('commentaires')->orderBy('commentaires_count', 'desc');
//                     break;
//                 case 'commented':
//                     $query->withCount('commentaires')->orderBy('commentaires_count', 'desc');
//                     break;
//             }
//         } else {
//             $query->orderBy('date_creation', 'desc');
//         }
        
//         $contenus = $query->paginate(12);
        
//         // Données pour les filtres
//         $regions = Region::all();
//         $langues = Langue::all();
//         $typesContenu = TypeContenu::all();
        
//         // Statistiques
//         $languesCount = Langue::count();
//         $regionsCount = Region::count();
//         $totalCommentaires = \App\Models\Commentaire::count();
//         $contenuVedette = Contenu::withCount('commentaires')
//             ->orderBy('commentaires_count', 'desc')
//             ->first();
        
//         return view('visiteur.contenus.index', compact(
//             'contenus',
//             'regions',
//             'langues',
//             'typesContenu',
//             'languesCount',
//             'regionsCount',
//             'totalCommentaires',
//             'contenuVedette'
//         ));
//     }
    
//     public function showPublic(Contenu $contenu)
//     {
//         // Vérifier si le contenu est publié
//         if ($contenu->statut !== 'publié') {
//             abort(404);
//         }
        
//         $contenu->load(['region', 'langue', 'typeContenu', 'medias', 'medias.typeMedia', 'commentaires.utilisateur', 'auteur']);
        
//         // Contenus similaires
//         $contenusSimilaires = Contenu::where('id_region', $contenu->id_region)
//             ->where('id_contenu', '!=', $contenu->id_contenu)
//             ->where('statut', 'publié')
//             ->with(['region', 'langue'])
//             ->take(3)
//             ->get();
            
//         // Contenus précédent et suivant pour la navigation
//         $previousContenu = Contenu::where('id_contenu', '<', $contenu->id_contenu)
//             ->where('statut', 'publié')
//             ->orderBy('id_contenu', 'desc')
//             ->first();
            
//         $nextContenu = Contenu::where('id_contenu', '>', $contenu->id_contenu)
//             ->where('statut', 'publié')
//             ->orderBy('id_contenu', 'asc')
//             ->first();
        
//         return view('visiteur.contenus.show', compact(
//             'contenu',
//             'contenusSimilaires',
//             'previousContenu',
//             'nextContenu'
//         ));
//     }
// }