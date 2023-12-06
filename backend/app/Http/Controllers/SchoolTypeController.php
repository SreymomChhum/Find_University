<?php

namespace App\Http\Controllers;

use App\Models\TypeEducation;
use Illuminate\Http\Request;

class SchoolTypeController extends Controller
{
    //
    public function schoolType()
    {
        $types = TypeEducation::all();
        return response()->json(['success'=>true, 'data'=>$types],200);
    }
    
    public function getIdTypeOfSchool($request)
    {    
        $typeId = TypeEducation::where('name', $request)->first()->id;
        return response()->json(['success'=>true, 'data'=>$typeId],200);
    }

}
