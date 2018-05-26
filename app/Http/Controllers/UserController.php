<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $users = User::all();
        return response()->json(['data'=> $users],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:100',
            'email'=>'required|email|unique:users|max:500',
            'password'=>'required|min:6|confirmed',

        ]);

         // then, if it fails, return the error messages in JSON format
         if ($validator->fails()) {    
              return response()->json($validator->messages(), 200);
            }
        $data = $request->all();
        $data['password']= bcrypt($request->password);
        $data['varified']= User::UNVARIFIED_USER;
        $data['varified_token']=User::generateVarificationCode();
        //
        $data['admin']=User::REGULAR_USER;
        $users = User::create($data);
        return response()->json(['data'=> $users],201);

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
        $users = User::findOrFail($id);
        return response()->json(['data'=> $users],200);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $users = User::findOrFail($id);

        
         $validator = Validator::make($request->all(), [
            'name'=>'max:100',
            'email'=>'email|unique:users|max:500',
            'password'=>'min:6|confirmed',

        ]);

         // then, if it fails, return the error messages in JSON format
         if ($validator->fails()) {    
              return response()->json($validator->messages(), 200);
            }


        if ($request->has('name')) {
            # code...
            $users->name = $request->name;
        }
         if ($request->has('password')) {
            # code...
            $users->password = bcrypt($request->password);
        }
         if ($request->has('admin')) {
            # code...
            if (!$users->isvarified()) {
                # code...
                return response()->json(['error'=>'only varified users could preform this change '],409);
            }
            $users->admin = $request->admin;
        }
         if ($request->has('email')) {
            # code...
             $users->varified = User::UNVARIFIED_USER;
            $users->varified_token = User::generateVarificationCode();
            $users->email= $request->email;
        }
        if (!$users->isDirty()) {
            # code...
            return  response()->json(['error'=>'you need to specify a different values '],422);
        }
        $users->save();
        return response()->json(['data'=> $users],200);

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
        $users = User::findOrFail($id);
        if ($users) {
            # code...
            $users->delete();
        return response()->json(['message'=>'delete success','data'=> $users],200);

        }
        
        return response()->json(['message'=>'not found'],404);

    }
    public function varify($token)
    {
        # code...
        $user = User::where('varified_token',$token)->firstOrFail();
        $user->varified_token = null;
        $user->varified =User::VARIFIED_USER;
        $user->save();
       // return $this->showMessage(' acount has been varified');
        return response()->json(['message'=>'acount has been varified'],200);


    }
}
