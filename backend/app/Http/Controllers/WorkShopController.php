<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkShopRequest;
use App\Http\Resources\ShowWorkShopResource;
use App\Models\WorkShop;
use Illuminate\Http\Request;

class WorkShopController extends Controller
{
    public function getworkShops()
    {
        $workShops = workShop::orderBy('id', 'DESC')->get();

        $workShops = ShowWorkShopResource::collection($workShops);
        return response()->json(['success' => true, 'data' => $workShops], 200);
    }
    public function getworkShopsInSchool($id)
    {
        $workShops = workShop::where('school_id','=',$id)->orderBy('id', 'DESC')->get();
        if($workShops!=null){
            $workShops = ShowWorkShopResource::collection($workShops);
            return response()->json(['success' => true, 'data' => $workShops], 200);
        }
        return response()->json(['success' => true, 'message' => "No data!"], 200);
    }

    public function getWorkShopById(string $id)
    {
        $workShop = workShop::find($id);
        if (!$workShop) {
            return response()->json(['message' => 'WorkShop id not found'], 404);
        }
        $workShop = new ShowWorkShopResource($workShop);
        return response()->json(['success' => true, 'data' => $workShop], 200);
    }

    public function createworkShop(Request $request)
    {
        $workShop = workShop::store($request);
        if ($workShop) {
            return response()->json(['Workshop have been created' => true, 'data' => $workShop], 200);
        }
        return response()->json(['message' => "workShop cannot create"], 200);

    }
    public function editeWorkShop(WorkShopRequest $request, string $id)
    {
        $workShop  = workShop::find($id);
        if ($workShop) {
            $workShop  = workShop::store($request, $id);
            return response()->json(['Update workShop  success' => true, 'data' => $workShop], 200);
        }
        return response()->json(['message' => "workShop id not found"], 200);
    }

    public function deleteWorkShop(string $id)
    {
        $workShop = workShop::find($id);
        if (!$workShop) {
            return response()->json(['message' => 'WorkShop id not found'], 404);
        }
        $workShop->delete();
        return response()->json(['Delete workShop successfully' => true, 'data' => $workShop], 201);
    }
}
