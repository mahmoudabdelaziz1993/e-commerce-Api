<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;

class SellerTransactionController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index($id)
    {
        //
        $seller= Seller::findOrFail($id);
        return response()->json(['the tarnsactions of '.$seller->name=>$seller->product()->with('tarsaction')->get()->pluck('tarsaction')],200);

    }
}
