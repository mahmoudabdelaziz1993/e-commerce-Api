<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index($id)
    {
        //
        $category= Category::findOrFail($id);
        return response()->json(['the products of '.$category->name=>$category->product],200);

    }
}
