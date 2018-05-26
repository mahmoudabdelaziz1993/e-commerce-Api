<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction = Transaction::all();

        return response()->json(['list of transactions'=>$transaction],200);
    }

       public function show($id)
    {
        //
        $transaction = Transaction::findOrFail($id);

        return response()->json(['list of transactions'=>$transaction],200);

    }

   
}
