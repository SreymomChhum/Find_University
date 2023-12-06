<?php

namespace App\Http\Controllers;

use App\Models\SchoolSkill;
use Illuminate\Http\Request;

class SchoolSkillController extends Controller
{
    //
    public function store(Request $request){
        if($request!=null){
            $schoolSkill = SchoolSkill::create([
                 'school_id'=>$request->input('school_id'),
                 'skill_id'=>$request->input("skill_id")
            ]);
            return response()->json(['success' => true, "data"=>$schoolSkill], 200);
        }
        return response()->json(['success' => true, 'message'=>"No data!"], 200);
    }
}
