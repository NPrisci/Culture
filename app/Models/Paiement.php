<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'contenu_id',
        'transaction_id',
        'montant',
        'devise',
        'methode_paiement',
        'phone',
        'statut',
        'metadata',
        'date_paiement',
        'reference',
    ];

    /**
     * Les attributs qui devraient être castés.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'array',
        'montant' => 'float', // Changé de 'decimal:2' à 'float'
        'date_paiement' => 'datetime',
    ];

    /**
     * Les valeurs par défaut du modèle.
     *
     * @var array
     */
    protected $attributes = [
        'statut' => 'pending',
        'devise' => 'XOF',
        'montant' => 100.00,
    ];

    /**
     * Relation avec l'utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le contenu.
     */
    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }

    /**
     * Scope pour les paiements complétés.
     */
    public function scopeCompleted($query)
    {
        return $query->where('statut', 'completed');
    }

    /**
     * Scope pour les paiements en attente.
     */
    public function scopePending($query)
    {
        return $query->where('statut', 'pending');
    }

    /**
     * Scope pour les paiements échoués.
     */
    public function scopeFailed($query)
    {
        return $query->where('statut', 'failed');
    }

    /**
     * Vérifie si le paiement est complété.
     */
    public function isCompleted()
    {
        return $this->statut === 'completed';
    }

    /**
     * Vérifie si le paiement est en attente.
     */
    public function isPending()
    {
        return $this->statut === 'pending';
    }

    /**
     * Vérifie si le paiement a échoué.
     */
    public function isFailed()
    {
        return $this->statut === 'failed';
    }

    /**
     * Marquer le paiement comme complété.
     */
    public function markAsCompleted($transactionData = null)
    {
        $this->statut = 'completed';
        $this->date_paiement = now();
        
        if ($transactionData) {
            $this->metadata = array_merge($this->metadata ?? [], [
                'transaction_data' => $transactionData,
                'completed_at' => now()->toDateTimeString(),
            ]);
        }
        
        $this->save();
    }

    /**
     * Marquer le paiement comme échoué.
     */
    public function markAsFailed($reason = null)
    {
        $this->statut = 'failed';
        
        if ($reason) {
            $this->metadata = array_merge($this->metadata ?? [], [
                'failed_reason' => $reason,
                'failed_at' => now()->toDateTimeString(),
            ]);
        }
        
        $this->save();
    }

    /**
     * Générer une référence unique pour le paiement.
     */
    public static function generateReference()
    {
        do {
            $reference = 'PAY-' . strtoupper(uniqid());
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }

    /**
     * Boot du modèle.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($paiement) {
            if (empty($paiement->reference)) {
                $paiement->reference = self::generateReference();
            }
        });
    }

    /**
     * Récupérer les informations de transaction FedaPay.
     */
    public function getFedaPayTransactionUrl()
    {
        if (isset($this->metadata['token_url'])) {
            return $this->metadata['token_url'];
        }
        
        return null;
    }

    /**
     * Formater le montant pour l'affichage.
     */
    public function getFormattedAmountAttribute()
    {
        // S'assurer que le montant est un float
        $montant = (float) $this->montant;
        return number_format($montant, 0, ',', ' ') . ' ' . $this->devise;
    }

    /**
     * Obtenir le montant sous forme de float.
     */
    public function getMontantFloatAttribute()
    {
        return (float) $this->montant;
    }

    /**
     * Obtenir le statut avec une couleur Bootstrap.
     */
    public function getStatusColorAttribute()
    {
        return match($this->statut) {
            'completed' => 'success',
            'pending' => 'warning',
            'failed' => 'danger',
            'cancelled' => 'secondary',
            default => 'info',
        };
    }

    /**
     * Obtenir le statut en français.
     */
    public function getStatusFrAttribute()
    {
        return match($this->statut) {
            'completed' => 'Complété',
            'pending' => 'En attente',
            'failed' => 'Échoué',
            'cancelled' => 'Annulé',
            default => $this->statut,
        };
    }

    /**
     * Obtenir la méthode de paiement en français.
     */
    public function getMethodePaiementFrAttribute()
    {
        return match($this->methode_paiement) {
            'mtn' => 'MTN Mobile Money',
            'moov' => 'Moov Money',
            'card' => 'Carte bancaire',
            default => $this->methode_paiement,
        };
    }

    /**
     * Obtenir une description courte du paiement.
     */
    public function getDescriptionAttribute()
    {
        return "Paiement de {$this->formatted_amount} pour {$this->contenu->titre}";
    }
}