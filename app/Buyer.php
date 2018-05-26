<?php

namespace App;

use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Buyer extends user
{
    //
    public function tarnsaction()
    {
    	# code...
    	return $this->hasMany(Transaction::class,'buyer_id');
    }
    
}
