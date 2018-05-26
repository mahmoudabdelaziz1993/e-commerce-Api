<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Transaction;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $buyers = Buyer::has('tarnsaction')->get();
        return response()->json(['buyers list'=>$buyers]);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //yer 
        $buyers = Buyer::has('tarnsaction')->findOrFail($id);
        return response()->json(['buyers list'=>$buyers]);
    }

}
