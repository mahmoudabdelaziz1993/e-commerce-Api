<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;

class BuyerTransactionController extends Controller
{
    //
       public function index($id)
    {
        //
        $buyer= Buyer::findOrFail($id);
        return response()->json(['the tarnsaction '=>$buyer->tarnsaction],200);

    }

}
