<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use FedaPay\FedaPay;
use FedaPay\Customer;
use FedaPay\Transaction;
use FedaPay\Error\Authentication as FedaPayAuthenticationError;
use FedaPay\Error\ApiConnection as FedaPayApiConnectionError;
use FedaPay\Error\InvalidRequest as FedaPayInvalidRequestError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// class AbonnementController extends Controller
// {

//     public function __construct()
//     {
//         // Initialisation FedaPay avec les bonnes clés
//         FedaPay::setApiKey(config('services.fedapay.secret'));
//         // FedaPay::setEnvironment(config('services.fedapay.mode'));
        
//             \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret'));
//             \FedaPay\FedaPay::setEnvironment(config('services.fedapay.env'));
//     }

//     public function createPayment(Request $request)
//     {
//         try {
//             Log::info('Début de createPayment', ['input' => $request->all()]);

//             // Validation
//             $validated = $request->validate([
//                 'email' => 'required|email',
//                 'plan' => 'required|in:monthly,yearly',
//                 'phone' => 'required|string', // Ajoutez le téléphone
//             ]);

//             Log::info('Validation OK', ['data' => $validated]);

//             // Déterminer le montant
//             $amount = $validated['plan'] === 'monthly' ? 5000 : 50000; // En centimes
//             Log::info('Montant déterminé', ['plan' => $validated['plan'], 'amount' => $amount]);

//             // Créer l'abonnement en base de données
//             $subscription = Abonnement::create([
//                 'email' => $validated['email'],
//                 'plan' => $validated['plan'],
//                 'amount' => $amount / 100, // En unités monétaires
//                 'status' => 'pending',
//             ]);

//             Log::info('Subscription créée en DB', ['subscription_id' => $subscription->id]);

//             // Créer le client FedaPay
//             try {
//                 $customer = Customer::create([
//                     'firstname' => 'Client', // Fournissez un prénom
//                     'lastname' => substr($validated['email'], 0, strpos($validated['email'], '@')), // Utilisez partie avant @ comme nom
//                     'email' => $validated['email'],
//                     'phone_number' => [
//                         'number' => $validated['phone'],
//                         'country' => 'BJ', // Benin par défaut
//                     ],
//                 ]);

//                 Log::info('Client FedaPay créé', ['customer_id' => $customer->id]);

//                 // Créer la transaction
//                 $transaction = Transaction::create([
//                     'description' => 'Abonnement ' . $validated['plan'],
//                     'amount' => $amount,
//                     'currency' => ['iso' => 'XOF'],
//                     'callback_url' => route('payment.callback'),
//                     'customer' => $customer->id,
//                 ]);

//                 Log::info('Transaction créée', ['transaction_id' => $transaction->id]);

//                 // Générer le token de paiement
//                 $token = $transaction->generateToken();

//                 // Mettre à jour l'abonnement
//                 $subscription->update([
//                     'transaction_id' => $transaction->id,
//                     'customer_id' => $customer->id,
//                 ]);

//                 // Rediriger vers la page de paiement
//                 return redirect()->away($token->url);

//             } catch (\FedaPay\Error\ApiConnection $e) {
//                 Log::error('Erreur FedaPay API', [
//                     'exception' => $e->getMessage(),
//                     'subscription_id' => $subscription->id,
//                 ]);

//                 // Option 1: Retourner à la page avec erreur
//                 return back()->withErrors(['payment' => 'Erreur lors de la création du paiement: ' . $e->getMessage()]);

//                 // Option 2: Marquer comme échoué et rediriger
//                 $subscription->update(['status' => 'failed']);
//                 return redirect()->route('payment.failed')->with('error', 'Erreur de paiement');
//             }

//         } catch (\Exception $e) {
//             Log::error('Erreur générale dans createPayment', [
//                 'exception' => $e->getMessage(),
//                 'trace' => $e->getTraceAsString(),
//             ]);

//             return back()->withErrors(['general' => 'Une erreur est survenue: ' . $e->getMessage()]);
//         }
//     }

//     // Callback pour FedaPay
//     public function paymentCallback(Request $request)
//     {
//         Log::info('Callback FedaPay', ['input' => $request->all()]);

//         $transactionId = $request->input('id');
        
//         try {
//             // Récupérer la transaction
//             $transaction = Transaction::retrieve($transactionId);
            
//             // Trouver l'abonnement
//             $subscription = Abonnement::where('transaction_id', $transactionId)->first();
            
//             if ($subscription) {
//                 if ($transaction->status === 'approved') {
//                     $subscription->update([
//                         'status' => 'completed',
//                         'paid_at' => now(),
//                     ]);
                    
//                     return redirect()->route('payment.success')
//                         ->with('success', 'Paiement réussi !');
//                 } else {
//                     $subscription->update(['status' => 'failed']);
                    
//                     return redirect()->route('payment.failed')
//                         ->with('error', 'Paiement échoué');
//                 }
//             }
            
//             return redirect()->route('home')->with('error', 'Abonnement non trouvé');
            
//         } catch (\Exception $e) {
//             Log::error('Erreur callback', ['exception' => $e->getMessage()]);
//             return redirect()->route('home')->with('error', 'Erreur de traitement');
//         }
//     }


//     public function showForm()
//     {
//         return view('abonnement'); // vue fournie plus bas
//     }

//     // public function createPayment(Request $request)
//     // {
//     //     Log::info('Début de createPayment', ['input' => $request->all()]);

//     //     try {
//     //         $data = $request->validate([
//     //             'email' => 'required|email',
//     //             'plan' => 'required|string',
//     //         ]);
//     //         Log::info('Validation OK', ['data' => $data]);

//     //         // Plans
//     //         $plans = [
//     //             'monthly' => 5000,
//     //             'yearly' => 50000,
//     //         ];

//     //         $amount = $plans[$data['plan']] ?? 5000;
//     //         Log::info('Montant déterminé', ['plan' => $data['plan'], 'amount' => $amount]);

//     //         // Enregistrement en DB
//     //         $subscription = Abonnement::create([
//     //             'email' => $data['email'],
//     //             'plan' => $data['plan'],
//     //             'amount' => $amount,
//     //             'currency' => 'XOF',
//     //             'status' => 'pending',
//     //         ]);
//     //         Log::info('Subscription créée en DB', ['subscription_id' => $subscription->id]);

//     //         // Initialisation API
//     //         \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret'));
//     //         \FedaPay\FedaPay::setEnvironment(config('services.fedapay.env'));

//     //         Log::info('FedaPay initialisé');

//     //         // Client FedaPay
//     //         $customer = \FedaPay\Customer::create([
//     //             'firstname' => '',
//     //             'lastname' => '',
//     //             'email' => $data['email'],
//     //         ]);
//     //         Log::info('Customer créé sur FedaPay', ['customer_id' => $customer->id]);

//     //         // Transaction
//     //         $transaction = \FedaPay\Transaction::create([
//     //             'description' => "Abonnement {$data['plan']} pour {$data['email']}",
//     //             'amount' => $amount,
//     //             'currency' => ['iso' => 'XOF'],
//     //             'callback_url' => route('subscribe.form'),
//     //             'customer' => ['id' => $customer->id],
//     //         ]);
//     //         Log::info('Transaction FedaPay créée', ['transaction_id' => $transaction->id]);

//     //         // Token
//     //         $tokenObj = $transaction->generateToken();
//     //         $token = $tokenObj->token;
//     //         Log::info('Token généré', ['token' => $token]);

//     //         // MAJ DB
//     //         $subscription->update(['fedapay_transaction_id' => $transaction->id]);
//     //         Log::info('Subscription mise à jour avec Fedapay ID', [
//     //             'subscription_id' => $subscription->id,
//     //             'fedapay_id' => $transaction->id,
//     //         ]);

//     //         return view('checkout', [
//     //             'transaction' => $transaction,
//     //             'token' => $token,
//     //             'subscription' => $subscription,
//     //         ]);

//     //     } catch (\Exception $e) {

//     //         Log::error('Erreur dans createPayment', [
//     //             'exception_type' => get_class($e),
//     //             'message' => $e->getMessage(),
//     //             'file' => $e->getFile(),
//     //             'line' => $e->getLine(),
//     //             'stack_trace' => $e->getTraceAsString(),

//     //             // Utile pour debug FedaPay
//     //             'fedapay_env' => config('services.fedapay.env'),
//     //             'fedapay_key_set' => config('services.fedapay.secret') ? true : false,

//     //             // Données d'entrée
//     //             'request_data' => $request->all(),
//     //         ]);

//     //         return back()->with('error', 'Une erreur est survenue pendant la création du paiement.');
//     //     }
//     // }

//     /**
//      * Webhook endpoint pour recevoir notifications de paiement
//      */
//     public function webhook(Request $request)
//     {
//         $payload = $request->getContent();
//         $sig = $request->header('X-FEDAPAY-SIGNATURE');
//         $endpointSecret = config('services.fedapay.webhook_secret');

//         try {
//             // Utilise la librairie officielle pour vérifier la signature
//             $event = \FedaPay\Webhook::constructEvent($payload, $sig, $endpointSecret);
//         } catch (\Exception $e) {
//             Log::error('Fedapay webhook verification failed: '.$e->getMessage());

//             return response('Invalid signature', 400);
//         }

//         // Exemple : traiter event de transaction
//         $type = $event['type'] ?? null; // vérifier la structure selon la doc
//         $data = $event['data'] ?? null;

//         // Exemple basique : mettre à jour subscription par transaction id
//         if ($type === 'transaction.updated' || $type === 'transaction.created' || true) {
//             $transactionId = data_get($data, 'id');
//             $status = data_get($data, 'status');

//             $sub = Abonnement::where('fedapay_transaction_id', $transactionId)->first();
//             if ($sub) {
//                 // map statuses FedaPay -> notre app
//                 $sub->status = $status; // pending, approved, declined...
//                 $sub->save();
//             }
//         }

//         return response('OK', 200);
//     }

//     public function success($id)
// {
//     $sub = Abonnement::findOrFail($id);

//     $sub->update([
//         'status' => 'paid'
//     ]);

//     return view('payments.success', compact('sub'));
// }

// }





// class AbonnementController extends Controller
// {
//     public function __construct()
//     {
//         $this->initializeFedaPay();
//     }

//     private function initializeFedaPay()
//     {
//         try {
//             $secretKey = config('services.fedapay.secret');
//             $mode = config('services.fedapay.env', 'test');
            
//             if (empty($secretKey)) {
//                 throw new \Exception('Clé FedaPay non configurée dans .env');
//             }
            
//             // Vérifier le format de la clé
//             if (!str_starts_with($secretKey, 'sk_test_') && !str_starts_with($secretKey, 'sk_live_')) {
//                 Log::warning('Format clé FedaPay suspect', ['key_prefix' => substr($secretKey, 0, 10)]);
//             }
            
//             FedaPay::setApiKey($secretKey);
//             FedaPay::setEnvironment($mode);
            
//             // Désactiver SSL verification pour développement
//             if ($mode === 'test' || app()->environment('local')) {
//                 FedaPay::setVerifySslCerts(false);
//             }
            
//             Log::info('FedaPay initialisé', [
//                 'mode' => $mode,
//                 'env' => app()->environment(),
//                 'version' => '0.4.7'
//             ]);
            
//         } catch (\Exception $e) {
//             Log::error('Erreur initialisation FedaPay', ['error' => $e->getMessage()]);
//             throw $e;
//         }
//     }

//     public function createPayment(Request $request)
//     {
//         try {
//             Log::info('Début création paiement', $request->all());

//             // Validation
//             $validated = $request->validate([
//                 'name' => 'required|string|min:3',
//                 'email' => 'required|email',
//                 'phone' => 'required|string|min:8',
//                 'plan' => 'required|in:monthly,yearly',
//             ]);

//             // Formater téléphone
//             $phone = $this->formatPhone($validated['phone']);
            
//             // Montant en centimes
//             $amount = $validated['plan'] === 'monthly' ? 5000 : 50000;
            
//             // Extraire prénom et nom
//             $nameParts = explode(' ', $validated['name'], 2);
//             $firstname = $nameParts[0];
//             $lastname = $nameParts[1] ?? $firstname;

//             // Créer l'abonnement
//             $subscription = Abonnement::create([
//                 'name' => $validated['name'],
//                 'email' => $validated['email'],
//                 'phone' => $phone,
//                 'plan' => $validated['plan'],
//                 'amount' => $amount / 100,
//                 'status' => 'pending',
//             ]);

//             Log::info('Abonnement créé', [
//                 'id' => $subscription->id,
//                 'email' => $validated['email'],
//                 'phone' => $phone
//             ]);

//             // Tester la connexion d'abord
//             if (!$this->testFedaPayConnection()) {
//                 return $this->handleConnectionFailure($subscription);
//             }

//             // Essayer FedaPay
//             return $this->processFedaPayPayment($validated, $firstname, $lastname, $phone, $amount, $subscription);

//         } catch (\Exception $e) {
//             Log::error('Erreur création paiement', [
//                 'error' => $e->getMessage(),
//                 'trace' => $e->getTraceAsString(),
//             ]);
            
//             return back()->withErrors(['error' => 'Erreur: ' . $e->getMessage()]);
//         }
//     }

//     private function processFedaPayPayment($data, $firstname, $lastname, $phone, $amount, $subscription)
//     {
//         try {
//             Log::info('Tentative paiement FedaPay', [
//                 'email' => $data['email'],
//                 'plan' => $data['plan']
//             ]);

//             // Créer le client
//             $customer = Customer::create([
//                 'firstname' => $firstname,
//                 'lastname' => $lastname,
//                 'email' => $data['email'],
//                 'phone_number' => [
//                     'number' => $phone,
//                     'country' => 'BJ',
//                 ],
//             ]);

//             Log::info('✅ Client FedaPay créé', ['customer_id' => $customer->id]);

//             // Créer la transaction
//             $transaction = Transaction::create([
//                 'description' => 'Abonnement ' . $data['plan'],
//                 'amount' => $amount,
//                 'currency' => ['iso' => 'XOF'],
//                 'callback_url' => route('payment.callback'),
//                 'customer' => $customer->id,
//             ]);

//             Log::info('✅ Transaction créée', ['transaction_id' => $transaction->id]);

//             // Générer le token
//             $token = $transaction->generateToken();

//             // Mettre à jour l'abonnement
//             $subscription->update([
//                 'transaction_id' => $transaction->id,
//                 'customer_id' => $customer->id,
//                 'status' => 'processing',
//             ]);

//             // Rediriger vers FedaPay
//             return redirect()->away($token->url);

//         } catch (\Exception $e) {
//             // Gestion générique des erreurs FedaPay
//             Log::error('❌ Erreur FedaPay', [
//                 'error' => $e->getMessage(),
//                 'type' => get_class($e),
//                 'subscription_id' => $subscription->id,
//             ]);
            
//             // Détecter le type d'erreur par le message
//             $errorMessage = $e->getMessage();
            
//             if (str_contains($errorMessage, 'authentication') || str_contains($errorMessage, 'Unauthorized')) {
//                 $subscription->update([
//                     'status' => 'auth_failed',
//                     'error' => 'Authentication error'
//                 ]);
                
//                 return back()->withErrors([
//                     'payment' => 'Erreur d\'authentification FedaPay. Vérifiez vos clés API dans .env'
//                 ]);
//             }
            
//             if (str_contains($errorMessage, 'connection') || str_contains($errorMessage, 'Could not connect')) {
//                 $subscription->update([
//                     'status' => 'connection_failed',
//                     'error' => 'Connection error'
//                 ]);
                
//                 return $this->handleConnectionFailure($subscription);
//             }
            
//             if (str_contains($errorMessage, 'customer') || str_contains($errorMessage, 'client')) {
//                 $subscription->update([
//                     'status' => 'customer_error',
//                     'error' => $errorMessage
//                 ]);
                
//                 return back()->withErrors([
//                     'payment' => 'Erreur création client: ' . $e->getMessage()
//                 ]);
//             }
            
//             // Erreur générique
//             $subscription->update([
//                 'status' => 'fedaPay_error',
//                 'error' => $errorMessage
//             ]);
            
//             return back()->withErrors([
//                 'payment' => 'Erreur FedaPay: ' . $e->getMessage()
//             ]);
//         }
//     }

//     private function testFedaPayConnection()
//     {
//         try {
//             // Test simple de connexion
//             $ch = curl_init('https://sandbox-api.fedapay.com/v1/customers');
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//             curl_setopt($ch, CURLOPT_TIMEOUT, 10);
//             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//             curl_setopt($ch, CURLOPT_HTTPHEADER, [
//                 'Authorization: Bearer ' . config('services.fedapay.secret')
//             ]);
            
//             $response = curl_exec($ch);
//             $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//             curl_close($ch);
            
//             $connected = $httpCode === 200 || $httpCode === 401;
            
//             Log::info('Test connexion FedaPay', [
//                 'http_code' => $httpCode,
//                 'connected' => $connected
//             ]);
            
//             return $connected;
            
//         } catch (\Exception $e) {
//             Log::warning('Test connexion échoué', ['error' => $e->getMessage()]);
//             return false;
//         }
//     }

//     private function handleConnectionFailure($subscription)
//     {
//         $subscription->update(['status' => 'connection_failed']);
        
//         // En développement, simulation
//         if (app()->environment('local', 'development')) {
//             Log::info('Mode développement - Simulation');
            
//             $simulationUrl = route('payment.simulation', [
//                 'subscription_id' => $subscription->id,
//                 'status' => 'success'
//             ]);
            
//             return redirect($simulationUrl);
//         }
        
//         // En production, paiement manuel
//         Log::warning('Connexion FedaPay échouée - Fallback manuel');
        
//         return redirect()->route('payment.manual')
//             ->with([
//                 'subscription' => $subscription,
//                 'warning' => 'Service de paiement indisponible. Méthode alternative.',
//             ]);
//     }

//     private function formatPhone($phone)
//     {
//         // Nettoyer
//         $phone = preg_replace('/[^0-9]/', '', $phone);
        
//         // Format Bénin standard
//         if (strlen($phone) === 8) {
//             // Numéro local 8 chiffres
//             if (str_starts_with($phone, '9')) {
//                 // Mobile: 9XXXXXXX -> 2299XXXXXXX
//                 return '229' . $phone;
//             } else {
//                 // Fixe: XXXXXXXX -> 2299XXXXXXX (convertir en mobile)
//                 return '2299' . $phone;
//             }
//         }
        
//         // Commence par 0
//         if (str_starts_with($phone, '0')) {
//             $phone = substr($phone, 1);
//             if (strlen($phone) === 8) {
//                 if (str_starts_with($phone, '9')) {
//                     return '229' . $phone;
//                 } else {
//                     return '2299' . $phone;
//                 }
//             }
//         }
        
//         // Autre format - utiliser un numéro de test
//         Log::warning('Format téléphone non standard', ['phone' => $phone]);
//         return '22997000000'; // Numéro de test FedaPay
//     }

//     public function paymentCallback(Request $request)
//     {
//         Log::info('Callback FedaPay', $request->all());
        
//         $transactionId = $request->input('id');
        
//         if (!$transactionId) {
//             Log::error('Callback sans transaction ID');
//             return redirect()->route('payment.failed')->with('error', 'Transaction ID manquant');
//         }
        
//         try {
//             // Récupérer la transaction
//             $transaction = Transaction::retrieve($transactionId);
            
//             // Trouver l'abonnement
//             $subscription = Abonnement::where('transaction_id', $transactionId)->first();
            
//             if (!$subscription) {
//                 Log::error('Abonnement non trouvé', ['transaction_id' => $transactionId]);
//                 return redirect()->route('home')->with('error', 'Abonnement non trouvé');
//             }
            
//             Log::info('Transaction récupérée', [
//                 'id' => $transaction->id,
//                 'status' => $transaction->status,
//                 'amount' => $transaction->amount,
//             ]);
            
//             // Traiter selon le statut
//             if ($transaction->status === 'approved') {
//                 $subscription->update([
//                     'status' => 'completed',
//                     'paid_at' => now(),
//                     'transaction_status' => $transaction->status,
//                 ]);
                
//                 Log::info('✅ Paiement approuvé', ['subscription_id' => $subscription->id]);
                
//                 return redirect()->route('payment.success')
//                     ->with('success', 'Paiement réussi !');
                    
//             } else {
//                 $subscription->update([
//                     'status' => 'failed',
//                     'transaction_status' => $transaction->status,
//                 ]);
                
//                 Log::warning('Paiement non approuvé', [
//                     'subscription_id' => $subscription->id,
//                     'status' => $transaction->status
//                 ]);
                
//                 return redirect()->route('payment.failed')
//                     ->with('error', 'Paiement échoué. Statut: ' . $transaction->status);
//             }
            
//         } catch (\Exception $e) {
//             Log::error('Erreur callback', [
//                 'error' => $e->getMessage(),
//                 'transaction_id' => $transactionId,
//             ]);
            
//             return redirect()->route('payment.failed')
//                 ->with('error', 'Erreur traitement paiement');
//         }
//     }

//      public function showForm()
//     {
//         return view('abonnement'); // vue fournie plus bas
//     }

//     // public function createPayment(Request $request)
//     // {
//     //     Log::info('Début de createPayment', ['input' => $request->all()]);

//     //     try {
//     //         $data = $request->validate([
//     //             'email' => 'required|email',
//     //             'plan' => 'required|string',
//     //         ]);
//     //         Log::info('Validation OK', ['data' => $data]);

//     //         // Plans
//     //         $plans = [
//     //             'monthly' => 5000,
//     //             'yearly' => 50000,
//     //         ];

//     //         $amount = $plans[$data['plan']] ?? 5000;
//     //         Log::info('Montant déterminé', ['plan' => $data['plan'], 'amount' => $amount]);

//     //         // Enregistrement en DB
//     //         $subscription = Abonnement::create([
//     //             'email' => $data['email'],
//     //             'plan' => $data['plan'],
//     //             'amount' => $amount,
//     //             'currency' => 'XOF',
//     //             'status' => 'pending',
//     //         ]);
//     //         Log::info('Subscription créée en DB', ['subscription_id' => $subscription->id]);

//     //         // Initialisation API
//     //         \FedaPay\FedaPay::setApiKey(config('services.fedapay.secret'));
//     //         \FedaPay\FedaPay::setEnvironment(config('services.fedapay.env'));

//     //         Log::info('FedaPay initialisé');

//     //         // Client FedaPay
//     //         $customer = \FedaPay\Customer::create([
//     //             'firstname' => '',
//     //             'lastname' => '',
//     //             'email' => $data['email'],
//     //         ]);
//     //         Log::info('Customer créé sur FedaPay', ['customer_id' => $customer->id]);

//     //         // Transaction
//     //         $transaction = \FedaPay\Transaction::create([
//     //             'description' => "Abonnement {$data['plan']} pour {$data['email']}",
//     //             'amount' => $amount,
//     //             'currency' => ['iso' => 'XOF'],
//     //             'callback_url' => route('subscribe.form'),
//     //             'customer' => ['id' => $customer->id],
//     //         ]);
//     //         Log::info('Transaction FedaPay créée', ['transaction_id' => $transaction->id]);

//     //         // Token
//     //         $tokenObj = $transaction->generateToken();
//     //         $token = $tokenObj->token;
//     //         Log::info('Token généré', ['token' => $token]);

//     //         // MAJ DB
//     //         $subscription->update(['fedapay_transaction_id' => $transaction->id]);
//     //         Log::info('Subscription mise à jour avec Fedapay ID', [
//     //             'subscription_id' => $subscription->id,
//     //             'fedapay_id' => $transaction->id,
//     //         ]);

//     //         return view('checkout', [
//     //             'transaction' => $transaction,
//     //             'token' => $token,
//     //             'subscription' => $subscription,
//     //         ]);

//     //     } catch (\Exception $e) {

//     //         Log::error('Erreur dans createPayment', [
//     //             'exception_type' => get_class($e),
//     //             'message' => $e->getMessage(),
//     //             'file' => $e->getFile(),
//     //             'line' => $e->getLine(),
//     //             'stack_trace' => $e->getTraceAsString(),

//     //             // Utile pour debug FedaPay
//     //             'fedapay_env' => config('services.fedapay.env'),
//     //             'fedapay_key_set' => config('services.fedapay.secret') ? true : false,

//     //             // Données d'entrée
//     //             'request_data' => $request->all(),
//     //         ]);

//     //         return back()->with('error', 'Une erreur est survenue pendant la création du paiement.');
//     //     }
//     // }

//     /**
//      * Webhook endpoint pour recevoir notifications de paiement
//      */
//     public function webhook(Request $request)
//     {
//         $payload = $request->getContent();
//         $sig = $request->header('X-FEDAPAY-SIGNATURE');
//         $endpointSecret = config('services.fedapay.webhook_secret');

//         try {
//             // Utilise la librairie officielle pour vérifier la signature
//             $event = \FedaPay\Webhook::constructEvent($payload, $sig, $endpointSecret);
//         } catch (\Exception $e) {
//             Log::error('Fedapay webhook verification failed: '.$e->getMessage());

//             return response('Invalid signature', 400);
//         }

//         // Exemple : traiter event de transaction
//         $type = $event['type'] ?? null; // vérifier la structure selon la doc
//         $data = $event['data'] ?? null;

//         // Exemple basique : mettre à jour subscription par transaction id
//         if ($type === 'transaction.updated' || $type === 'transaction.created' || true) {
//             $transactionId = data_get($data, 'id');
//             $status = data_get($data, 'status');

//             $sub = Abonnement::where('fedapay_transaction_id', $transactionId)->first();
//             if ($sub) {
//                 // map statuses FedaPay -> notre app
//                 $sub->status = $status; // pending, approved, declined...
//                 $sub->save();
//             }
//         }

//         return response('OK', 200);
//     }

//     public function success($id)
// {
//     $sub = Abonnement::findOrFail($id);

//     $sub->update([
//         'status' => 'paid'
//     ]);

//     return view('payments.success', compact('sub'));
// }


// }



class AbonnementController extends Controller
{
    private $fedaPayMode;
    private $fedaPayEnabled = true;
    
    public function __construct()
    {
        $this->initializeFedaPay();
    }
    public function showForm()
      {
         return view('abonnement'); // vue fournie plus bas
     }
    
    private function initializeFedaPay()
    {
        try {
            $this->fedaPayMode = config('services.fedapay.env', 'live');
            $secretKey = config('services.fedapay.secret');
            
            if (empty($secretKey)) {
                throw new \Exception('Clé FedaPay LIVE non configurée');
            }
            
            // VÉRIFICATION STRICTE pour le mode LIVE
            if ($this->fedaPayMode === 'live') {
                if (!str_starts_with($secretKey, 'sk_live_')) {
                    throw new \Exception(
                        '❌ CLÉ LIVE INVALIDE. En mode LIVE, la clé doit commencer par "sk_live_". ' .
                        'Obtenez une clé LIVE sur https://fedapay.com'
                    );
                }
                
                // Vérifier que nous sommes en production
                if (app()->environment('local', 'development')) {
                    Log::warning('⚠️ ATTENTION : Mode LIVE détecté en environnement de développement');
                    // Vous pouvez choisir de forcer le mode test en dev :
                    // $this->fedaPayMode = 'test';
                    // $secretKey = str_replace('sk_live_', 'sk_test_', $secretKey);
                }
            }
            
            // Initialisation FedaPay
            FedaPay::setApiKey($secretKey);
            FedaPay::setEnvironment($this->fedaPayMode);
            
            // En LIVE, on laisse SSL activé (production)
            if ($this->fedaPayMode === 'test') {
                FedaPay::setVerifySslCerts(false);
            }
            
            Log::info('🚀 FedaPay LIVE initialisé', [
                'mode' => $this->fedaPayMode,
                'env' => app()->environment(),
                'key_type' => str_starts_with($secretKey, 'sk_live_') ? 'LIVE' : 'TEST'
            ]);
            
        } catch (\Exception $e) {
            Log::error('❌ Initialisation FedaPay LIVE échouée', ['error' => $e->getMessage()]);
            $this->fedaPayEnabled = false;
            $this->fedaPayMode = 'disabled';
        }
    }
    
    public function createPayment(Request $request)
    {
        try {
            Log::info('💰 Création paiement LIVE', $request->all());
            
            // Validation stricte pour production
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:3|max:100',
                'email' => 'required|email|max:100',
                'phone' => 'required|string|min:8|max:15',
                'plan' => 'required|in:monthly,yearly',
            ], [
                'name.required' => 'Votre nom complet est requis',
                'email.required' => 'Votre email est requis',
                'email.email' => 'Email invalide',
                'phone.required' => 'Votre numéro de téléphone est requis',
                'phone.min' => 'Numéro de téléphone trop court',
            ]);
            
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            
            $validated = $validator->validated();
            
            // Formater téléphone pour le Bénin (LIVE)
            $phone = $this->formatPhoneForBenin($validated['phone']);
            
            
            // Montant en centimes (FCFA)
            $amount = $validated['plan'] === 'monthly' ? 5000 : 50000; // 5000 FCFA = 50.00 FCFA en centimes
            
            // Extraire nom
            $nameParts = explode(' ', $validated['name'], 2);
            $firstname = $nameParts[0];
            $lastname = $nameParts[1] ?? $firstname;
            
            // Créer abonnement en base
            $subscription = Abonnement::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $phone,
                'plan' => $validated['plan'],
                'amount' => $amount / 100, // Stocker en unités
                'currency' => 'XOF',
                'status' => 'pending',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            
            Log::info('📋 Abonnement créé (LIVE)', [
                'id' => $subscription->id,
                'email' => $validated['email'],
                'phone' => $phone,
                'amount' => $amount,
                'plan' => $validated['plan']
            ]);
            
            // Vérifier si FedaPay LIVE est disponible
            if (!$this->fedaPayEnabled || $this->fedaPayMode !== 'live') {
                return $this->handlePaymentFallback($subscription, 'FedaPay LIVE non disponible');
            }
            
            // Tester la connexion à l'API LIVE
            if (!$this->testFedaPayLiveConnection()) {
                return $this->handlePaymentFallback($subscription, 'Connexion FedaPay LIVE échouée');
            }
            
            // Traitement avec FedaPay LIVE
            return $this->processLivePayment(
                $firstname,
                $lastname,
                $validated['email'],
                $phone,
                $amount,
                $validated['plan'],
                $subscription,
                $request
            );
            
        } catch (\Exception $e) {
            Log::error('💥 Erreur création paiement LIVE', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return back()->withErrors([
                'error' => 'Une erreur est survenue. Veuillez réessayer ou contactez-nous.'
            ])->withInput();
        }
    }
    
    private function processLivePayment($firstname, $lastname, $email, $phone, $amount, $plan, $subscription, $request)
    {
        try {
            Log::info('🔄 Traitement paiement LIVE', [
                'email' => $email,
                'phone' => $phone,
                'amount' => $amount
            ]);
            
            // Créer le client FedaPay LIVE
            $customer = Customer::create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'phone_number' => [
                    'number' => $phone,
                    'country' => 'BJ',
                ],
            ]);
            
            Log::info('✅ Client FedaPay LIVE créé', ['customer_id' => $customer->id]);
            
            // URL de callback pour production
            $callbackUrl = route('payment.callback');
            $webhookUrl = route('payment.webhook'); // Pour les webhooks asynchrones
            
            // Créer la transaction LIVE
            $transaction = Transaction::create([
                'description' => 'Abonnement ' . ($plan === 'monthly' ? 'Mensuel' : 'Annuel') . ' - ' . $email,
                'amount' => $amount,
                'currency' => ['iso' => 'XOF'],
                'callback_url' => $callbackUrl,
                'callback_url' => $webhookUrl, // Webhook pour notifications
                'customer' => $customer->id,
                'metadata' => [
                    'subscription_id' => $subscription->id,
                    'plan' => $plan,
                    'website' => config('app.url'),
                ],
            ]);
            
            Log::info('✅ Transaction LIVE créée', [
                'transaction_id' => $transaction->id,
                'amount' => $amount,
                'currency' => 'XOF'
            ]);
            
            // Générer le token de paiement
            $token = $transaction->generateToken();
            
            // Mettre à jour l'abonnement
            $subscription->update([
                'transaction_id' => $transaction->id,
                'customer_id' => $customer->id,
                'status' => 'processing',
                'payment_mode' => 'fedaPay_live',
                'fedaPay_url' => $token->url,
            ]);
            
            // Enregistrer l'activité
            $this->logPaymentActivity($subscription, 'REDIRECTION_FEDAPAY', [
                'transaction_id' => $transaction->id,
                'customer_id' => $customer->id,
                'redirect_url' => $token->url,
            ]);
            
            // Redirection vers FedaPay LIVE
            return redirect()->away($token->url);
            
        } catch (\Exception $e) {
            Log::error('❌ Erreur paiement LIVE', [
                'error' => $e->getMessage(),
                'subscription_id' => $subscription->id,
                'type' => get_class($e),
            ]);
            
            $subscription->update([
                'status' => 'payment_error',
                'error' => $e->getMessage(),
            ]);
            
            $this->logPaymentActivity($subscription, 'FEDAPAY_ERROR', [
                'error' => $e->getMessage(),
                'error_type' => get_class($e),
            ]);
            
            // Fallback sécurisé
            return $this->handlePaymentFallback(
                $subscription,
                'Erreur système FedaPay: ' . $e->getMessage()
            );
        }
    }
    
    private function testFedaPayLiveConnection()
    {
        try {
            $url = 'https://api.fedapay.com/v1/customers';
            $secretKey = config('services.fedapay.secret');
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // SSL activé en production
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $secretKey,
                'Content-Type: application/json',
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            $connected = $httpCode === 200 || $httpCode === 401;
            
            Log::info('🔗 Test connexion FedaPay LIVE', [
                'http_code' => $httpCode,
                'connected' => $connected,
                'error' => $error ?: 'none'
            ]);
            
            return $connected;
            
        } catch (\Exception $e) {
            Log::error('Test connexion LIVE échoué', ['error' => $e->getMessage()]);
            return false;
        }
    }
    
    private function formatPhoneForBenin($phone)
    {
        // Nettoyer
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Format international pour le Bénin: 229XXXXXXXXX
        if (strlen($phone) === 8) {
            // Numéro local 8 chiffres
            return '229' . $phone;
        }
        
        if (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
            if (strlen($phone) === 8) {
                return '229' . $phone;
            }
        }
        
        if (str_starts_with($phone, '229') && strlen($phone) === 11) {
            return $phone;
        }
        
        // Si format inconnu, retourner tel quel (sera validé après)
        return $phone;
    }
    
    private function isValidBeninPhone($phone)
    {
        // Format: 229XXXXXXXXX où XXXXXXXXX = 8 chiffres
        if (strlen($phone) !== 11) {
            return false;
        }
        
        if (!str_starts_with($phone, '229')) {
            return false;
        }
        
        $numberPart = substr($phone, 3);
        if (!ctype_digit($numberPart) || strlen($numberPart) !== 8) {
            return false;
        }
        
        // Vérifier que c'est un mobile béninois (commence par 9, 6, ou 5)
        $firstDigit = substr($numberPart, 0, 1);
        return in_array($firstDigit, ['9', '6', '5']);
    }
    
    private function handlePaymentFallback($subscription, $reason)
    {
        Log::warning('Fallback paiement', [
            'subscription_id' => $subscription->id,
            'reason' => $reason,
            'mode' => $this->fedaPayMode
        ]);
        
        $subscription->update([
            'status' => 'manual_required',
            'fallback_reason' => $reason,
        ]);
        
        $this->logPaymentActivity($subscription, 'FALLBACK_TRIGGERED', ['reason' => $reason]);
        
        // Redirection vers page de paiement manuel
        return redirect()->route('payment.manual')
            ->with([
                'subscription' => $subscription,
                'warning' => 'Service de paiement en ligne temporairement indisponible. ' .
                           'Veuillez utiliser le paiement manuel.',
                'instructions' => $this->getManualPaymentInstructions(),
            ]);
    }
    
    private function getManualPaymentInstructions()
    {
        return [
            'title' => 'Paiement Manuel - Instructions',
            'methods' => [
                'transfert_bancaire' => [
                    'banque' => 'BANQUE INTERNATIONALE DU BENIN (BIBE)',
                    'titulaire' => 'VOTRE ENTREPRISE SARL',
                    'numero_compte' => 'CI011 01010 12345678901 12',
                    'rib' => 'BJ061 BIBE 0101 0123 4567 8901 12',
                    'swift' => 'BIBEBJXXX',
                ],
                'mobile_money' => [
                    'mtn' => [
                        'numero' => '+229 97 00 00 00',
                        'nom' => 'VOTRE ENTREPRISE',
                        'reference' => 'ABONNEMENT',
                    ],
                    'moov' => [
                        'numero' => '+229 96 00 00 00',
                        'nom' => 'VOTRE ENTREPRISE',
                        'reference' => 'ABONNEMENT',
                    ],
                ],
            ],
            'instructions' => [
                '1. Effectuez le virement ou le paiement mobile money',
                '2. Envoyez le reçu à: contact@votredomaine.com',
                '3. Indiquez dans l\'email votre numéro d\'abonnement',
                '4. Votre abonnement sera activé sous 24h',
            ],
        ];
    }
    
    private function logPaymentActivity($subscription, $action, $data = [])
    {
        // Vous pouvez créer une table 'payment_activities' pour logger
        // Pour l'instant, on log dans les logs Laravel
        Log::info('📋 Activity: ' . $action, array_merge([
            'subscription_id' => $subscription->id,
            'email' => $subscription->email,
            'status' => $subscription->status,
        ], $data));
    }
    
    /**
     * Callback FedaPay LIVE
     */
    public function paymentCallback(Request $request)
    {
        Log::info('📞 Callback FedaPay LIVE reçu', $request->all());
        
        $transactionId = $request->input('id');
        
        if (!$transactionId) {
            Log::error('Callback sans transaction ID');
            return redirect()->route('payment.failed')
                ->with('error', 'Transaction ID manquant');
        }
        
        try {
            // Récupérer la transaction depuis FedaPay LIVE
            $transaction = Transaction::retrieve($transactionId);
            
            // Trouver l'abonnement
            $subscription = Abonnement::where('transaction_id', $transactionId)->first();
            
            if (!$subscription) {
                Log::error('Abonnement non trouvé', ['transaction_id' => $transactionId]);
                return redirect()->route('home')
                    ->with('error', 'Abonnement non trouvé');
            }
            
            Log::info('Transaction LIVE récupérée', [
                'id' => $transaction->id,
                'status' => $transaction->status,
                'amount' => $transaction->amount,
                'currency' => $transaction->currency['iso'] ?? 'XOF',
                'subscription_id' => $subscription->id,
            ]);
            
            // Traiter selon le statut
            switch ($transaction->status) {
                case 'approved':
                    $subscription->update([
                        'status' => 'completed',
                        'paid_at' => now(),
                        'transaction_status' => 'approved',
                        'fedaPay_response' => json_encode($transaction->toArray()),
                    ]);
                    
                    $this->logPaymentActivity($subscription, 'PAYMENT_APPROVED', [
                        'transaction_id' => $transactionId,
                        'amount' => $transaction->amount,
                    ]);
                    
                    // Ici vous pouvez:
                    // 1. Envoyer un email de confirmation
                    // 2. Activer l'accès utilisateur
                    // 3. Créer une facture
                    
                    Log::info('🎉 Paiement LIVE approuvé', ['subscription_id' => $subscription->id]);
                    
                    return redirect()->route('payment.success')
                        ->with([
                            'success' => 'Paiement réussi ! Votre abonnement est maintenant actif.',
                            'subscription' => $subscription,
                        ]);
                    
                case 'canceled':
                    $subscription->update([
                        'status' => 'canceled',
                        'transaction_status' => 'canceled',
                    ]);
                    
                    Log::info('Paiement annulé', ['subscription_id' => $subscription->id]);
                    
                    return redirect()->route('payment.canceled')
                        ->with('info', 'Paiement annulé.');
                    
                default:
                    $subscription->update([
                        'status' => 'failed',
                        'transaction_status' => $transaction->status,
                        'error' => 'Statut: ' . $transaction->status,
                    ]);
                    
                    Log::warning('Paiement échoué', [
                        'subscription_id' => $subscription->id,
                        'status' => $transaction->status
                    ]);
                    
                    return redirect()->route('payment.failed')
                        ->with('error', 'Paiement échoué. Statut: ' . $transaction->status);
            }
            
        } catch (\Exception $e) {
            Log::error('❌ Erreur callback LIVE', [
                'error' => $e->getMessage(),
                'transaction_id' => $transactionId,
                'trace' => $e->getTraceAsString(),
            ]);
            
            return redirect()->route('payment.failed')
                ->with('error', 'Erreur de traitement du paiement');
        }
    }
    
    /**
     * Webhook FedaPay LIVE (pour notifications asynchrones)
     */
    public function paymentWebhook(Request $request)
    {
        Log::info('🌐 Webhook FedaPay LIVE reçu', $request->all());
        
        // Vérifier la signature du webhook (important en production)
        $signature = $request->header('X-FedaPay-Signature');
        $payload = $request->getContent();
        
        // Valider la signature ici (implémentation dépend de FedaPay)
        
        $event = $request->input('event');
        $data = $request->input('data');
        
        switch ($event) {
            case 'transaction.approved':
                // Traiter transaction approuvée
                break;
            case 'transaction.canceled':
                // Traiter transaction annulée
                break;
            case 'transaction.declined':
                // Traiter transaction refusée
                break;
        }
        
        return response()->json(['status' => 'received']);
    }

    /**
 * Affiche la page de paiement manuel
 */
/**
 * Affiche la page de paiement manuel
 */
public function manualPayment(Request $request)
{
    // Récupérer l'ID depuis la session ou les paramètres
    $subscriptionId = $request->input('subscription_id') 
        ?? $request->session()->get('pending_subscription_id');
    
    // if (!$subscriptionId) {
    //     return redirect()->route('acceuil')->with('error', 'Aucun paiement en attente.');
    // }
    
    $abonnement = Abonnement::find($subscriptionId);
    
    // if (!$abonnement) {
    //     return redirect()->route('acceuil')->with('error', 'Abonnement non trouvé.');
    // }
    
    return view('manuel', [
        'abonnement' => $abonnement,
        'montant' => $abonnement->montant ?? 5000,
       
    ]);
}
}