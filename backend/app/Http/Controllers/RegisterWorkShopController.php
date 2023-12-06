<?php

namespace App\Http\Controllers;

use App\Models\WorkshopUser;
use Illuminate\Http\Request;

class RegisterWorkShopController extends Controller
{
    public function registerWorkShop(Request $request)
    {
        $joinWorkShop = WorkshopUser::create([
            'user_id' => $request->user_id,
            'workshop_id' => $request->workshop_id,
        ]);
        return response()->json(['message' => 'Workshop registration successful', 'data' => $joinWorkShop]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function index()
    {
        $workshops = WorkshopUser::all();
        return response()->json(['message' => "Your get data use is success", 'data' => $workshops], 200);
    }

    /**workshops
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
