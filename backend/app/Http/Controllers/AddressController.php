<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    //
    // public function addresses(){
    //     $addresses = Address::all()
    //     return response()->json(['message' => "Your get user is success", 'data' => $addresses], 200);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $address = Address::all();
        if($address!=''){
            return  response()->json(['success'=>true,'data'=>$address],200);
        }
        return response()->json(['success'=>true,'data'=>"Address not found !"],500);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $address = Address::address($request);
        // dd($address);
        return response()->json(['success' =>"create address successfully", 'data' => $address],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
