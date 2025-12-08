<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Contenu;
use App\Models\Paiement;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Exception;

class PaiementController extends Controller
{
    /**
     * Afficher le formulaire de paiement
     */
    public function showPaiementForm(Contenu $contenu)
    {
        Log::info('===== DEBUT showPaiementForm =====');
        Log::info('Contenu ID: ' . $contenu->id);
        Log::info('Contenu Titre: ' . $contenu->titre);
        
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            Log::warning('Utilisateur non connecté, redirection vers login');
            return redirect()->route('login')
                ->with('error', 'Vous devez vous connecter pour accéder à cette page.');
        }
        
        $user = Auth::user();
        Log::info('Utilisateur connecté: ID=' . $user->id . ', Email=' . $user->email);
        
        // Vérifier si l'utilisateur a déjà payé
        $hasPaid = Paiement::where('contenu_id', $contenu->id)
            ->where('user_id', $user->id)
            ->where('statut', 'completed')
            ->exists();
            
        if ($hasPaid) {
            Log::info('Utilisateur a déjà payé pour ce contenu');
            return redirect()->route('contenus.show.public', $contenu)
                ->with('info', 'Vous avez déjà accès à ce contenu.');
        }
        
        Log::info('===== FIN showPaiementForm =====');
        return view('visiteur.paiement', compact('contenu'));
    }
    
    /**
     * Traiter le paiement
     */
    public function processPaiement(Request $request, Contenu $contenu)
    {
        Log::info('===== DEBUT processPaiement =====');
        Log::info('Données reçues:', $request->all());
        Log::info('Contenu ID: ' . $contenu->id);
        Log::info('URL: ' . $request->fullUrl());
        
        // Validation
        Log::info('Début validation...');
        $validated = $request->validate([
            'phone' => 'required|string|regex:/^229[0-9]{8}$/',
            'payment_method' => 'required|in:mtn,moov,card',
        ]);
        Log::info('Validation réussie:', $validated);
        
        // Vérifier l'authentification
        Log::info('Vérification authentification...');
        if (!Auth::check()) {
            Log::error('Auth::check() = FALSE - Utilisateur non connecté');
            Log::info('Session ID: ' . session()->getId());
            Log::info('Toutes les données session:', session()->all());
            return redirect()->route('login')
                ->with('error', 'Session expirée. Veuillez vous reconnecter.');
        }
        
        // Récupérer l'utilisateur
        Log::info('Récupération utilisateur...');
        $user = Auth::user();
        Log::info('Utilisateur trouvé: ID=' . $user->id_utilisateur . ', Name=' . $user->nom . ', Email=' . $user->email);
        
        if (!$user) {
            Log::error('Auth::user() retourne NULL');
            return redirect()->route('login')
                ->with('error', 'Utilisateur non trouvé. Veuillez vous reconnecter.');
        }
        
        if (!$contenu) {
            Log::error('Contenu est NULL');
            return redirect()->route('contenus.index.public')
                ->with('error', 'Contenu non trouvé.');
        }
        
        Log::info('Vérification paiement existant...');
        // Vérifier si l'utilisateur a déjà un paiement en cours
        $existingPayment = Paiement::where('contenu_id', $contenu->id_contenu)
            ->where('user_id', $user->id_utilisateur)
            ->whereIn('statut', ['pending', 'completed'])
            ->first();
            
        if ($existingPayment) {
            Log::info('Paiement existant trouvé: ID=' . $existingPayment->id . ', Statut=' . $existingPayment->statut);
            if ($existingPayment->statut === 'completed') {
                Log::info('Paiement déjà complété, redirection vers le contenu');
                return redirect()->route('contenus.show.public', $contenu)
                    ->with('success', 'Vous avez déjà accès à ce contenu.');
            }
            
            // Si pending, rediriger vers l'URL de paiement existante
            if ($existingPayment->metadata && isset($existingPayment->metadata['token_url'])) {
                Log::info('Redirection vers URL de paiement existante');
                return redirect($existingPayment->metadata['token_url']);
            }
        }
        
        try {
            Log::info('Configuration FedaPay...');
            Log::info('API Key: ' . substr(config('services.fedapay.secret'), 0, 15) . '...');
            Log::info('Environment: ' . config('services.fedapay.environment'));
            
            // Configuration FedaPay
            FedaPay::setApiKey(config('services.fedapay.secret'));
            FedaPay::setEnvironment(config('services.fedapay.environment'));
            
            // Prix fixe de 100 FCFA
            $prix = 100;
            Log::info('Montant: ' . $prix . ' FCFA');
            
            // Déterminer le mode de paiement
            $mode = 'mobile';
            if ($request->payment_method === 'card') {
                $mode = 'card';
            }
            Log::info('Mode paiement: ' . $mode);
            
            // Créer le client
            $customer = [
                'firstname' => $user->nom ?? 'Client',
                'lastname' => '',
                'email' => $user->email,
                'phone_number' => [
                    'number' => $request->phone,
                    'country' => 'bj'
                ]
            ];
            
            Log::info('Création transaction FedaPay...');
            // Créer la transaction
            $transaction = Transaction::create([
                'description' => 'Accès au contenu: ' . $contenu->titre,
                'amount' => $prix,
                'currency' => ['iso' => 'XOF'],
                'callback_url' => route('paiement.callback'),
                'customer' => $customer
            ]);
            
            Log::info('Transaction FedaPay créée: ID=' . $transaction->id);
            
            // Sauvegarder le paiement en base de données
            Log::info('Création enregistrement paiement en DB...');
            Log::info('Données paiement:', [
                'user_id' => $user->id_utilisateur,
                'contenu_id' => $contenu->id_contenu,
                'transaction_id' => $transaction->id,
                'montant' => $prix,
                'methode_paiement' => $request->payment_method,
                'phone' => $request->phone,
            ]);
            
            $paiement = new Paiement();
            $paiement->user_id = $user->id_utilisateur;
            $paiement->contenu_id = $contenu->id_contenu;
            $paiement->transaction_id = $transaction->id;
            $paiement->montant = $prix;
            $paiement->devise = 'XOF';
            $paiement->methode_paiement = $request->payment_method;
            $paiement->phone = $request->phone;
            $paiement->statut = 'pending';
            $paiement->metadata = [
                'fedapay_transaction_id' => $transaction->id,
                'mode' => $mode,
            ];
            
            Log::info('Sauvegarde paiement...');
            $paiement->save();
            Log::info('Paiement sauvegardé avec ID: ' . $paiement->id);
            
            Log::info('Génération token FedaPay...');
            // Générer le token pour le paiement
            $callbackUrl = route('paiement.callback') . '?paiement_id=' . $paiement->id;
            Log::info('Callback URL: ' . $callbackUrl);
            
            $token = $transaction->generateToken([
                'callback_url' => $callbackUrl,
                'cancel_url' => route('contenus.paiement.form', $contenu),
                'locale' => 'fr',
            ]);
            
            Log::info('Token généré, URL: ' . $token->url);
            
            // Mettre à jour le paiement avec l'URL du token
            $paiement->metadata = array_merge($paiement->metadata ?? [], [
                'token_url' => $token->url,
            ]);
            $paiement->save();
            
            Log::info('Redirection vers FedaPay...');
            Log::info('===== FIN processPaiement - Succès =====');
            
            // Rediriger vers la page de paiement FedaPay
            return redirect($token->url);
            
        } catch (Exception $e) {
            Log::error('Erreur générale processus paiement: ' . $e->getMessage());
            Log::error('Type exception: ' . get_class($e));
            Log::error('Fichier: ' . $e->getFile());
            Log::error('Ligne: ' . $e->getLine());
            Log::error('Trace complète:', ['trace' => $e->getTraceAsString()]);
            Log::error('Données utilisateur:', [
                'user_id' => $user->id_utilisateur ?? 'null',
                'contenu_id' => $contenu->id_contenu ?? 'null',
                'phone' => $request->phone,
            ]);
            
            // Message d'erreur plus spécifique selon le type d'erreur
            $errorMessage = $this->getErrorMessage($e);
            
            return back()
                ->with('error', $errorMessage)
                ->withInput();
        }
    }
    
    /**
     * Callback après paiement
     */
    public function callback(Request $request)
    {
        Log::info('===== DEBUT callback =====');
        Log::info('Données callback:', $request->all());
        Log::info('URL complète: ' . $request->fullUrl());
        
        try {
            // Récupérer l'ID du paiement
            $paiementId = $request->get('paiement_id');
            Log::info('Paiement ID reçu: ' . ($paiementId ?? 'NULL'));
            
            if (!$paiementId) {
                Log::warning('Callback FedaPay sans paiement_id');
                return redirect()->route('contenus.index.public')
                    ->with('error', 'Référence de paiement manquante.');
            }
            
            // Trouver le paiement
            $paiement = Paiement::find($paiementId);
            
            if (!$paiement) {
                Log::error('Paiement non trouvé pour callback', ['paiement_id' => $paiementId]);
                return redirect()->route('contenus.index.public')
                    ->with('error', 'Paiement non trouvé.');
            }
            
            Log::info('Paiement trouvé: ID=' . $paiement->id . ', Statut=' . $paiement->statut);
            
            // Configuration FedaPay
            FedaPay::setApiKey(config('services.fedapay.secret'));
            FedaPay::setEnvironment(config('services.fedapay.environment'));
            
            Log::info('Récupération transaction FedaPay: ' . $paiement->transaction_id);
            // Récupérer la transaction FedaPay
            $transaction = Transaction::retrieve($paiement->transaction_id);
            
            if (!$transaction) {
                Log::error('Transaction FedaPay non trouvée', [
                    'transaction_id' => $paiement->transaction_id,
                    'paiement_id' => $paiement->id
                ]);
                
                $paiement->statut = 'failed';
                $paiement->save();
                
                return redirect()->route('contenus.paiement.form', $paiement->contenu_id)
                    ->with('error', 'Transaction non trouvée chez le processeur de paiement.');
            }
            
            Log::info('Transaction FedaPay récupérée: ID=' . $transaction->id . ', Statut=' . $transaction->status);
            
            // Mettre à jour le statut du paiement
            $oldStatus = $paiement->statut;
            $paiement->statut = $transaction->status;
            Log::info('Changement statut: ' . $oldStatus . ' -> ' . $transaction->status);
            
            if ($transaction->status === 'approved') {
                $paiement->date_paiement = now();
                $paiement->metadata = array_merge($paiement->metadata ?? [], [
                    'approved_at' => now()->toDateTimeString(),
                    'transaction_data' => $transaction->toArray(),
                ]);
                
                $paiement->save();
                
                // Connecter l'utilisateur s'il ne l'est pas
                if (!Auth::check() && $paiement->user_id) {
                    Auth::loginUsingId($paiement->user_id);
                    Log::info('Utilisateur connecté via callback: ID=' . $paiement->user_id);
                }
                
                Log::info('Paiement approuvé avec succès', [
                    'paiement_id' => $paiement->id,
                    'user_id' => $paiement->user_id,
                    'contenu_id' => $paiement->contenu_id,
                ]);
                
                Log::info('===== FIN callback - Succès =====');
                return redirect()->route('contenus.show.public', $paiement->contenu_id)
                    ->with('success', 'Paiement effectué avec succès ! Vous pouvez maintenant accéder au contenu.');
                    
            } else {
                $paiement->metadata = array_merge($paiement->metadata ?? [], [
                    'failed_at' => now()->toDateTimeString(),
                    'transaction_status' => $transaction->status,
                ]);
                $paiement->save();
                
                Log::warning('Paiement non approuvé', [
                    'paiement_id' => $paiement->id,
                    'status' => $transaction->status,
                ]);
                
                Log::info('===== FIN callback - Échec =====');
                return redirect()->route('contenus.paiement.form', $paiement->contenu_id)
                    ->with('error', 'Le paiement n\'a pas abouti. Statut: ' . $transaction->status);
            }
            
        } catch (Exception $e) {
            Log::error('Erreur callback FedaPay: ' . $e->getMessage());
            Log::error('Type exception: ' . get_class($e));
            Log::error('Trace:', ['trace' => $e->getTraceAsString()]);
            
            Log::info('===== FIN callback - Erreur =====');
            return redirect()->route('contenus.index.public')
                ->with('error', 'Erreur lors du traitement du paiement. Notre équipe a été notifiée.');
        }
    }
    
    /**
     * Obtenir un message d'erreur lisible
     */
    private function getErrorMessage(Exception $e): string
    {
        $errorMessage = $e->getMessage();
        
        // Messages d'erreur plus conviviaux
        if (str_contains($errorMessage, 'SQLSTATE') || str_contains($errorMessage, 'Integrity constraint')) {
            return 'Erreur de base de données. Veuillez réessayer ou contacter le support.';
        }
        
        if (str_contains($errorMessage, 'API key') || str_contains($errorMessage, 'authentication')) {
            return 'Erreur de configuration du service de paiement. Veuillez contacter l\'administrateur.';
        }
        
        if (str_contains($errorMessage, 'connection') || str_contains($errorMessage, 'timeout')) {
            return 'Erreur de connexion au service de paiement. Veuillez vérifier votre connexion internet.';
        }
        
        if (str_contains($errorMessage, 'Invalid') || str_contains($errorMessage, 'validation')) {
            return 'Données de paiement invalides. Veuillez vérifier les informations saisies.';
        }
        
        return 'Erreur lors de la création du paiement: ' . substr($errorMessage, 0, 100);
    }
    
    /**
     * Webhook FedaPay (pour les mises à jour en temps réel)
     */
    public function webhook(Request $request)
    {
        try {
            $payload = $request->all();
            
            Log::info('Webhook FedaPay reçu', $payload);
            
            // Vérifier la signature du webhook (optionnel mais recommandé)
            
            if (isset($payload['data']['transaction']['id'])) {
                $transactionId = $payload['data']['transaction']['id'];
                $transactionStatus = $payload['data']['transaction']['status'];
                
                // Trouver le paiement correspondant
                $paiement = Paiement::where('transaction_id', $transactionId)->first();
                
                if ($paiement) {
                    $oldStatus = $paiement->statut;
                    $paiement->statut = $transactionStatus;
                    
                    if ($transactionStatus === 'approved') {
                        $paiement->date_paiement = now();
                    }
                    
                    $paiement->metadata = array_merge($paiement->metadata ?? [], [
                        'webhook_received_at' => now()->toDateTimeString(),
                        'webhook_payload' => $payload,
                    ]);
                    
                    $paiement->save();
                    
                    Log::info('Statut paiement mis à jour via webhook', [
                        'paiement_id' => $paiement->id,
                        'ancien_statut' => $oldStatus,
                        'nouveau_statut' => $transactionStatus,
                        'transaction_id' => $transactionId,
                    ]);
                }
            }
            
            return response()->json(['status' => 'received']);
            
        } catch (Exception $e) {
            Log::error('Erreur webhook FedaPay: ' . $e->getMessage(), [
                'payload' => $request->all(),
            ]);
            
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Voir l'historique des paiements de l'utilisateur
     */
    public function historique()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez vous connecter pour voir votre historique.');
        }
        
        $user = Auth::user();
        $paiements = Paiement::where('user_id', $user->id_utilisateur)
            ->with('contenu')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('paiements.historique', compact('paiements'));
    }
    
    /**
     * Voir les détails d'un paiement
     */
    public function show(Paiement $paiement)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        
        // Vérifier que l'utilisateur peut voir ce paiement
        if ($paiement->user_id !== $user->id_utilisateur && $user->role_id !== 1) {
            abort(403, 'Accès non autorisé.');
        }
        
        return view('paiements.show', compact('paiement'));
    }
    
    /**
     * Test de débogage
     */
    public function testDebug(Request $request)
    {
        Log::info('===== TEST DEBOGAGE =====');
        Log::info('Session ID: ' . session()->getId());
        Log::info('Auth check: ' . (Auth::check() ? 'true' : 'false'));
        Log::info('Auth ID: ' . Auth::id());
        Log::info('User agent: ' . $request->header('User-Agent'));
        Log::info('Toutes les données session:', session()->all());
        Log::info('Cookies:', $request->cookies->all());
        
        return response()->json([
            'session_id' => session()->getId(),
            'auth_check' => Auth::check(),
            'auth_id' => Auth::id(),
            'user' => Auth::check() ? Auth::user() : null,
            'session_data' => session()->all(),
        ]);
    }
}