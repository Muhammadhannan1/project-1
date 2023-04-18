<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class VendorController extends Controller

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
            //'password'=>['required','min:4',],
             'number'=>['required',],
             'address'=>['required'],
             //'status'=>['required'],
             'cnic'=>['required'],
             'image'=>['required'],

        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $password = Str::random(8);
            $data=[
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($password),
                'role'=>"vendor",
                 'number'=>$request->number,
                 'address'=>$request->address,
                //'status'=>$request->status,
                 'cnic'=>$request->cnic,
                 'image'=>$request->image,

            ];
            DB::beginTransaction();
            try {
                $user = User::create($data);
                //$token= $user->createToken("auth_token")->accessToken;
                DB::commit();
                $vendor_validator = Validator::make($request->all(),[
                    'Company'=>['required']
                ]);
                if($vendor_validator->fails()){
                    return response()->json($vendor_validator->messages(),400);
                }
                else{
                    $vendor_data=['company'=>$request->Company,'userId'=>$user->id];
                    $vendor=Vendor::create($vendor_data);
                    DB::commit();
                }
            } catch (\Exception $e) {
                echo $e;
                DB::rollback();
                $user = null;
            };
            if ($user!=null) {
                $registeredUserCredentials  = ['name'=>$user->name, 'email'=>$user->email, 'password'=>$password];
                return response()->json(
                    ['message'=>'Vendor registered Successfully','status'=>true, 'credentials'=>$registeredUserCredentials],200

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
}
