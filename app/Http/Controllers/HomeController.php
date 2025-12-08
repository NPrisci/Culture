<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
      public function inde()
    {
        // Récupérer les utilisateurs avec id_role = 1 ou 2
        $membresEquipe = User::whereIn('id_role', [1, 2])
            ->get(['id_utilisateur', 'nom', 'prenom', 'photo', 'statut']);
        
        return view('welcome', compact('membresEquipe'));
    }

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

    //  public function indexuser()
    // {
    //     return view('user');
    // }
 
    // public function indexmoderateur()
    // {
    //     return view('moderateur');
    // }

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
    // public function accueil()
    // {
    //     return view('pages.accueil');
    // }

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


    //user
     public function indexModerateur()
    {
        $user = auth()->user();
        
        // Vérifier si l'utilisateur est modérateur
        if ($user->id_role != 2) { // Supposons que 2 = modérateur
            return redirect('/')->with('error', 'Accès non autorisé');
        }
        
        $stats = $this->getModeratorStats();
        $recentActivities = $this->getRecentActivities();
        $chartData = $this->getChartData();
        
        return view('moderateur', compact('user', 'stats', 'recentActivities', 'chartData'));
    }
    
    /**
     * Dashboard utilisateur
     */
    public function indexUser()
    {
        $user = auth()->user();
        
        $stats = [
            'total_contenus' => DB::table('contenus')
                ->where('id_auteur', $user->id_utilisateur)
                ->count(),
            'contenus_valides' => DB::table('contenus')
                ->where('id_auteur', $user->id_utilisateur)
                ->where('statut', 'validé')
                ->count(),
            'contenus_en_attente' => DB::table('contenus')
                ->where('id_auteur', $user->id_utilisateur)
                ->where('statut', 'en attente')
                ->count(),
            'total_commentaires' => DB::table('commentaires')
                ->where('id_utilisateur', $user->id_utilisateur)
                ->count(),
        ];
        
        $recentContenus = DB::table('contenus')
            ->where('id_auteur', $user->id_utilisateur)
            ->orderBy('date_creation', 'desc')
            ->take(5)
            ->get();
            
        $recentCommentaires = DB::table('commentaires')
            ->where('id_utilisateur', $user->id_utilisateur)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
            
        return view('user', compact('user', 'stats', 'recentContenus', 'recentCommentaires'));
    }
    
    /**
     * Récupérer les statistiques du modérateur
     */
    private function getModeratorStats()
    {
        $today = now()->toDateString();
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        return [
            // Statistiques utilisateurs
            'total_utilisateurs' => DB::table('users')->count(),
            'utilisateurs_aujourdhui' => DB::table('users')
                ->whereDate('date_inscription', $today)
                ->count(),
            'utilisateurs_mois' => DB::table('users')
                ->whereMonth('date_inscription', $currentMonth)
                ->whereYear('date_inscription', $currentYear)
                ->count(),
            'utilisateurs_actifs' => DB::table('users')
                ->where('statut', 'actif')
                ->count(),
            
            // Statistiques contenus
            'total_contenus' => DB::table('contenus')->count(),
            'contenus_aujourdhui' => DB::table('contenus')
                ->whereDate('date_creation', $today)
                ->count(),
            'contenus_valides' => DB::table('contenus')
                ->where('statut', 'validé')
                ->count(),
            'contenus_en_attente' => DB::table('contenus')
                ->where('statut', 'en attente')
                ->count(),
            'contenus_rejetes' => DB::table('contenus')
                ->where('statut', 'rejeté')
                ->count(),
            
            // Statistiques commentaires
            'total_commentaires' => DB::table('commentaires')->count(),
            'commentaires_aujourdhui' => DB::table('commentaires')
                ->whereDate('date', $today)
                ->count(),
            
            // Statistiques modération
            'contenus_moderes_par_moi' => DB::table('contenus')
                ->where('id_moderateur', auth()->id())
                ->count(),
            'contenus_a_moderer' => DB::table('contenus')
                ->whereNull('date_validation')
                ->where('statut', 'en attente')
                ->count(),
        ];
    }
    
    /**
     * Récupérer les activités récentes
     */
    private function getRecentActivities()
    {
        $activities = collect();
        
        // Derniers utilisateurs inscrits
        $recentUsers = DB::table('users')
            ->select(
                DB::raw("CONCAT(prenom, ' ', nom) as nom_complet"),
                'email',
                'date_inscription as created_at',
                DB::raw("'Nouvel utilisateur' as type")
            )
            ->orderBy('date_inscription', 'desc')
            ->take(5)
            ->get();
        $activities = $activities->merge($recentUsers);
        
        // Derniers contenus créés
        $recentContenus = DB::table('contenus')
            ->select(
                'titre',
                'date_creation as created_at',
                'statut',
                DB::raw("'Nouveau contenu' as type")
            )
            ->orderBy('date_creation', 'desc')
            ->take(5)
            ->get();
        $activities = $activities->merge($recentContenus);
        
        // Derniers commentaires
        $recentCommentaires = DB::table('commentaires')
            ->select(
                DB::raw("SUBSTRING(texte, 1, 50) as description"),
                'date as created_at',
                DB::raw("'Nouveau commentaire' as type")
            )
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
        $activities = $activities->merge($recentCommentaires);
        
        // Trier par date décroissante
        return $activities->sortByDesc('created_at')->take(10);
    }
    
    /**
     * Données pour les graphiques
     */
    private function getChartData()
    {
        // Contenus par jour (7 derniers jours)
        $contenusParJour = DB::table('contenus')
            ->select(DB::raw('DATE(date_creation) as date'), DB::raw('COUNT(*) as count'))
            ->where('date_creation', '>=', now()->subDays(7))
            ->groupBy(DB::raw('DATE(date_creation)'))
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');
        
        // Utilisateurs par mois
        $utilisateursParMois = DB::table('users')
            ->select(
                DB::raw('MONTH(date_inscription) as mois'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('date_inscription', now()->year)
            ->groupBy(DB::raw('MONTH(date_inscription)'))
            ->orderBy('mois')
            ->get()
            ->pluck('count', 'mois');
        
        // Statut des contenus
        $statutContenus = DB::table('contenus')
            ->select('statut', DB::raw('COUNT(*) as count'))
            ->groupBy('statut')
            ->get()
            ->pluck('count', 'statut');
        
        return [
            'contenus_par_jour' => $contenusParJour,
            'utilisateurs_par_mois' => $utilisateursParMois,
            'statut_contenus' => $statutContenus,
        ];
    }
    
    /**
     * Profil modérateur
     */
    public function profileModerateur()
    {
        $user = auth()->user();
        
        // Récupérer les langues pour le select
        $langues = DB::table('langues')->get();
        
        return view('moderateur.profile', compact('user', 'langues'));
    }
    
    /**
     * Mise à jour du profil modérateur
     */
    public function updateProfileModerateur(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id_utilisateur . ',id_utilisateur',
            'date_naissance' => 'nullable|date',
            'sexe' => 'nullable|in:H,F',
            'photo' => 'nullable|image|max:2048',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);
        
        // Mise à jour des informations de base
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->date_naissance = $request->date_naissance;
        $user->sexe = $request->sexe;
        $user->id_langue = $request->id_langue;
        
        // Gestion de la photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }
        
        // Mise à jour du mot de passe
        if ($request->filled('current_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect']);
            }
        }
        
        $user->save();
        
        return back()->with('success', 'Profil mis à jour avec succès');
    }

    public function favorites()
    {
        $user = auth()->user();
        $favorites = Favorite::where('user_id', $user->id)
            ->with('item')
            ->latest()
            ->paginate(10);

        return view('user.favorites', compact('favorites'));
    }

}