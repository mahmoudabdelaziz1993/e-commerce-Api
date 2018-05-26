<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;

class BuyerSellerController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index($id)
    {
        //
        $buyer= Buyer::findOrFail($id);
        return response()->json(['sellers on a products of this buyer '=>$buyer->tarnsaction()->with('product.seller')->get()->pluck('product.seller')],200);

    }
}
