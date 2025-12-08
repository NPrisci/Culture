<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    //
     protected $fillable = [
      'user_id','email','plan','amount','currency','fedapay_transaction_id','status'
    ];
}

