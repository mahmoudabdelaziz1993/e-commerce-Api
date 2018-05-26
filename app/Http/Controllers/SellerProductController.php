<?php

namespace App\Http\Controllers;


use App\Product;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SellerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $seller=Seller::findOrFail($id);
        return response()->json(['the products of '.$seller->name=>$seller->product],200);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$seller)
    {
        //
         $validator = Validator::make($request->all(), [
            'name'=>'required|min:6',
             'description'=>'required|min:6',
              'quantity'=>'required',
              
              'image'=>'required',
              
              'category_id'=>'required',

        ]);

         // then, if it fails, return the error messages in JSON format
         if ($validator->fails()) {    
              return response()->json($validator->messages(), 200);
            }

            $data = $request->all();
            $data['status']=Product::AVAILABLE_PRO;
            $data['seller_id']= $seller;
            $data['image']=$request->image->store('');
             $product= Product::create($data);
             return response()->json(['product saved '=>$product,201]);


    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$seller,$product)
    {
        //
        $product = Product::findOrFail($product);
        if($product->seller_id != $seller){
            return response()->json(['error'=>'this is not the seller of the product'],404);

        }
        
        $validator = Validator::make($request->all(), [
            'name'=>'min:6',
             'description'=>'min:20',
              

        ]);

         // then, if it fails, return the error messages in JSON format
         if ($validator->fails()) {    
              return response()->json($validator->messages(), 200);
            }

             if ($request->has('name')) {
            # code...
            $product['name'] = $request->name;

        }
        if ($request->has('description')) {
            # code...
            $product['description'] = $request->description;

        }
        if ($request->has('image')) {
            # code...
            $product['image'] = $request->image;}

            if ($request->has('quantity')) {
            # code...
            $product['quantity'] = $request->quantity;}
          
         if (!$product->isDirty()) {
            # code...
            return  response()->json(['error'=>'you need to specify a different values '],422);
        }


        $product->save();
        return response()->json(['data'=> $product],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$seller,$product)
    {
        //
         $product = Product::findOrFail($product);
        if($product->seller_id != $seller){
            return response()->json(['error'=>'this is not the seller of the product'],404);

        }
        $product->delete();
        Storage::delete($product->image);
         return response()->json(['product deleted','data'=> $product],200);

    }
}
