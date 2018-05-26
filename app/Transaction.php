<?php

namespace App;

use App\Buyer;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable=[
    	'quantity',
    	'buyer_id',
    	'product_id',


    ];
     public function buyer()
    {
    	# code...
    	return $this->belongsTo(Buyer::class,'buyer_id');
    }
    public function product()
    {
    	# code...
    	return $this->belongsTo(Product::class,'product_id');

    }
}
