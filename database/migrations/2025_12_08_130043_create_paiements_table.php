<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            
            // IMPORTANT : Spécifier la colonne personnalisée
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('contenu_id');
            
            $table->string('transaction_id')->unique()->comment('ID de transaction FedaPay');
            $table->decimal('montant', 10, 2)->default(100.00);
            $table->string('devise')->default('XOF');
            $table->string('methode_paiement');
            $table->string('phone')->nullable();
            $table->enum('statut', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->json('metadata')->nullable()->comment('Données supplémentaires');
            $table->string('reference')->unique()->comment('Référence interne du paiement');
            $table->timestamp('date_paiement')->nullable();
            $table->timestamps();

            // Clés étrangères avec colonnes personnalisées
            $table->foreign('user_id')
                  ->references('id_utilisateur')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->foreign('contenu_id')
                  ->references('id_contenu')
                  ->on('contenus')
                  ->onDelete('cascade');

            // Index
            $table->index(['user_id', 'contenu_id']);
            $table->index('statut');
            $table->index('reference');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}