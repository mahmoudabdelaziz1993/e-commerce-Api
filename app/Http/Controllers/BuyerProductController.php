<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;

class BuyerProductController extends Controller
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
        return response()->json(['the tarnsaction '=>$buyer->tarnsaction()->with('product')->get()],200);

    }
}
