<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>['required'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','min:4',],
            'number'=>['required'],
            'address'=>['required'],
            'status'=>['required'],
            'cnic'=>['required'],
            'image'=>['required'],

        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $data=[
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'role'=>$request->role,
                'number'=>$request->number,
                'address'=>$request->address,
               'status'=>$request->status,
                'cnic'=>$request->cnic,
                'image'=>$request->image,

            ];
            DB::beginTransaction();
            try {
                $user = User::create($data);
                $token= $user->createToken("auth_token")->accessToken;
                DB::commit();
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $user = null;
            }
            if ($user!=null) {
                return response()->json(
                    ['message'=>'User registered Successfully','token'=>$token],200
                    //['message'=>'error',],500
                );
            }
            else{
                return response()->json([

                     'message'=>'Internal server error'
                ],500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $data=[
                'email'=>$request->email,
                'password'=>$request->password
            ];
            try {
                $user = User::where(['email'=>$data['email'],'password'=>Hash::check($data['password'],'password')])->first();

                $token = $user->createToken("auth_token")->accessToken;
                return response()->json(
                   ['message'=>'Logged in Successfully','token'=>$token,'user'=>$user],200
               );

                return response()->json(['messgae'=>'user is null']);

            }
            catch (\Exception $e) {
                echo $e;
                return response()->json(['messgae'=>'Internal Server Error'],500);
            }
        }

    }



}
