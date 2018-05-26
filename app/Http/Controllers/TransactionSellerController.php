<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionSellerController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth:api');
    }
       public function index($id)
    {
        //
        $transaction = Transaction::findOrFail($id);


        return response()->json(['the seller '=>$transaction->product->seller],200);

    }

}
