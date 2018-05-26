<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();
        return response()->json(['category list'=>$category,200]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'description'=>'required',

        ]);

         // then, if it fails, return the error messages in JSON format
         if ($validator->fails()) {    
              return response()->json($validator->messages(), 200);
            }



        $category =  Category::create($request->all());
        return response()->json(['category saved '=>$category,201]);
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
        $category = Category::findOrFail($id);
        return response()->json(['category'=>$category,200]);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
          $category = Category::findOrFail($id);
        
        if ($request->has('name')) {
            # code...
            $category['name'] = $request->name;

        }
        if ($request->has('description')) {
            # code...
            $category['description'] = $request->description;

        }
         if (!$category->isDirty()) {
            # code...
            return  response()->json(['error'=>'you need to specify a different values '],422);
        }

        $category->save();
        return response()->json(['data'=> $category],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $category = Category::findOrFail($id);
         $category->delete();
        return response()->json(['category delete success'=>$category,200]);
    }
}
