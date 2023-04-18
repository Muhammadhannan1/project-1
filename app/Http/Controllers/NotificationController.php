<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Response;
use App\Models\Notifications;
use Laravel\Passport\Passport;

class NotificationController extends Controller
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
            'title'=>['required'],
            'description'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }
        else{
            $data=[
                'title'=>$request->title,
                'description'=>$request->description,
                'userId'=>auth()->user()->id
            ];

            DB::beginTransaction();
            try {
                $notification = Notifications::create($data);
                //auth()->user()->notifications()->save($notification);
                //$token= $user->createToken("auth_token")->accessToken;
                DB::commit();
            } catch (\Exception $e) {
                //echo $e;
                DB::rollback();
                return response()->json([
                    'message' => 'Error creating notification',
                    'error' => $e->getMessage()
                ], 500);
                //$user = null;
            }
            if ($notification!=null) {
                return response()->json(
                    ['message'=>'User registered Successfully'],200

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
