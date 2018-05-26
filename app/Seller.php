<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    //
     public function product()
    {
    	# code...
    	return $this->hasMany(Product::class);
    }
}
