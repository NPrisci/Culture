<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contenu;
use App\Models\Commentaire;
use App\Models\Langue;
use App\Models\Region;
use App\Models\Media;
use App\Models\TypeContenu;
use App\Models\TypeMedia;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques principales
        $totalUsers = User::count();
        $activeContents = Contenu::where('statut', 'validé')->count();
        $pendingModeration = Contenu::where('statut', 'en attente')->count();
        $totalComments = Commentaire::count();
        
        // Statistiques supplémentaires
        $totalLangues = Langue::count();
        $totalRegions = Region::count();
        $totalMedias = Media::count();
        $totalTypeContenus = TypeContenu::count();
        $totalTypeMedias = TypeMedia::count();
        $totalRoles = Role::count();
        
        // Statuts des contenus
        $contentStats = [
            'validated' => Contenu::where('statut', 'validé')->count(),
            'pending' => Contenu::where('statut', 'en attente')->count(),
            'rejected' => Contenu::where('statut', 'rejeté')->count(),
        ];
        
        // Statistiques mensuelles
        $currentYear = date('Y');
        $monthlyStats = [
            'created' => [],
            'validated' => []
        ];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthlyStats['created'][] = Contenu::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $i)
                ->count();
            
            $monthlyStats['validated'][] = Contenu::where('statut', 'validé')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $i)
                ->count();
        }
        
        // Derniers utilisateurs
        $recentUsers = User::latest()->take(5)->get();
        
        // Activités récentes (vous pouvez personnaliser selon vos besoins)
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', compact(
            'totalUsers',
            'activeContents',
            'pendingModeration',
            'totalComments',
            'totalLangues',
            'totalRegions',
            'totalMedias',
            'totalTypeContenus',
            'totalTypeMedias',
            'totalRoles',
            'contentStats',
            'monthlyStats',
            'recentUsers',
            'recentActivities'
        ));
    }
    
    private function getRecentActivities()
    {
        $activities = [];
        
        // Derniers contenus créés
        $recentContents = Contenu::latest()->take(3)->get();
        foreach ($recentContents as $content) {
            $activities[] = [
                'title' => 'Nouveau contenu',
                'description' => $content->titre,
                'time' => $content->created_at->diffForHumans(),
                'user' => $content->user,
                'icon' => 'file-text',
                'color' => 'primary'
            ];
        }
        
        // Derniers commentaires
        $recentComments = Commentaire::latest()->take(2)->get();
        foreach ($recentComments as $comment) {
            $activities[] = [
                'title' => 'Nouveau commentaire',
                'description' => substr($comment->contenu, 0, 50) . '...',
                'time' => $comment->created_at->diffForHumans(),
                'user' => $comment->user,
                'icon' => 'chat-left-text',
                'color' => 'success'
            ];
        }
        
        // Derniers utilisateurs
        $recentUsers = User::latest()->take(2)->get();
        foreach ($recentUsers as $user) {
            $activities[] = [
                'title' => 'Nouvel utilisateur',
                'description' => $user->prenom . ' ' . $user->nom,
                'time' => $user->created_at->diffForHumans(),
                'user' => $user,
                'icon' => 'person-plus',
                'color' => 'info'
            ];
        }
        
        // Trier par date décroissante
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        
        return array_slice($activities, 0, 5);
    }
}
