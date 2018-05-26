<?php

namespace App;

use App\Category;
use App\Seller;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //define const for avilable item 
    const AVAILABLE_PRO='avilable';
    const UNAVAILABLE_PRO='unavilable';

     protected $fillable = [
        'name', 'description', 'quantity','status','image','seller_id','category_id',
    ];
    public function isAvailable()
    {
    	# code...
    	return $this->status==Product::AVAILABLE_PRO;
    }
    public function category()
    {
        # code...
        return $this->belongsTo(Category::class,'category_id');
    }
    public function seller()
    {
        # code...
        return $this->belongsTo(Seller::class,'seller_id');
    }
     public function tarsaction()
    {
        # code...
        return $this->hasMany(Transaction::class);
    }

}
