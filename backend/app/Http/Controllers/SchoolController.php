<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Http\Resources\ShowSchoolResource;
// use App\Models\Address;
use App\Models\School;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    //
    public function getschool($id){
        $school = School::find($id);
        if($school!=''){
            $school = new ShowSchoolResource($school);
            return  response()->json(['success'=>true,'data'=>$school],200);
        }
        return response()->json(['success'=>true,'data'=>"No data !"],200);
    }

    public function getschools(){
        $school = School::all();
        if($school!='' && $school!=null){
            $school = ShowSchoolResource::collection($school);
            return response()->json(['Get success'=>true, 'data'=>$school],200);
        }
        return response()->json(['Get success'=>false, 'data'=>'No data !'],200);

    }
    
    public function createSchool(SchoolRequest $request)
    {
        $school = School::school($request);
        return response()->json(['message'=>"Create school successfully", 'data'=>$school], 201);
    }

    public function editeSchool(SchoolRequest $request, string $id)
    {
        $school  = School::find($id);
        if ($school) {
            $school  = school::school($request, $id);
            return response()->json(['Update school  success' => true, 'data' => $school], 200);
        }
        return response()->json(['message' => "School id not found"], 404);
    }

    public function deleteSchool(string $id)
    {
        $school = School::find($id);
        if (!$school) {
            return response()->json(['message' => 'School id not found'], 404);
        }
        $school->delete();
        return response()->json(['Delete school successfully' => true, 'data' => $school], 201);
    }

    public function search($name){
        $result = School::whereHas('address', function ($query) use ($name) {
            $query->where('name', 'like', "%$name%");
        })->get();
        if(count($result)){
            $result = ShowSchoolResource::collection($result);
            return response()->json(['success'=>true, 'data'=>$result],200);
        } 
        return response()->json(['success'=>true, 'data'=>[]],200);
    }

    
    public function getSchoolIdByName($name){

        $schoolId = DB::table('schools')->where('name', $name)->first()->id;
        if ($schoolId){
            return response()->json([ 'message' => "Request successfull", 'data' => $schoolId], 200);
        }else{
            return response()->json([ 'message' => "Request fail"], 400);
        }
    }

}


