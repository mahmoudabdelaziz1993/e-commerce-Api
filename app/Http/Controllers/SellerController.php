<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        //
         $seller = Seller::has('product')->get();
        return response()->json(['seller list'=>$seller]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $seller = Seller::has('product')->findOrFail($id);
        return response()->json(['seller info '=>$seller]);
    }

   
}
