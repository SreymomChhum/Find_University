<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\ShowSkillResource;
use App\Http\Resources\SkillNameResource;
use App\Http\Resources\SkillResource;
use App\Http\Resources\SkillSchoolResource;
use App\Http\Resources\SubjectResource;
use App\Models\School;
use App\Models\SchoolSkill;
use App\Models\Skill;
use App\Models\Subject;
use Database\Seeders\SchoolSkillSeeder;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function getSkills()
    {
        $skills = Skill::all();
        $skills = ShowSkillResource::collection($skills);
        return response()->json(['success' => true, 'data' => $skills], 200);
    }
    public function SkillsInSchool(string $id)
    {
        $schoolSkills = Skill::whereHas('schools', function ($query) use ($id) {
            $query->where('school_id', $id);})->orderBy('id', 'DESC')->get();
            if ($schoolSkills->count() === 0) {
                return response()->json(['message' => 'Skill id not found'], 404);
            }
        $schoolSkills = SkillResource::collection($schoolSkills);
        return response()->json(['success' => true, 'data' => $schoolSkills], 200);
    }

    public function getSkillById(string $id)
    {
        $skills = Skill::find($id);
        if (!$skills) {
            return response()->json(['message' => 'Skill id not found'], 404);
        }
        $skills = new ShowSkillResource($skills);
        return response()->json(['success' => true, 'data' => $skills], 200);
    }

    public function getSubjects()
    {
        $skills = Subject::orderBy('id', 'DESC')->get();
        $skills = SubjectResource::collection($skills);
        return response()->json(['success' => true, 'data' => $skills], 200);
    }

    public function createSkill(SkillRequest $request)
    {

        $skills = Skill::skill($request);
        $skills = new ShowSkillResource($skills);
        return response()->json(['message' => "Create skills success", 'data' => $skills], 201);
    }
    public function store(Request $request)
    {
        $skill = Skill::store($request);
        if ($skill) {
            return response()->json(['skill have been created' => true, 'data' => $skill], 200);
        }
        return response()->json(['message' => "skill cannot create"], 404);

    }

    public function editeSkill(SkillRequest $request, string $id)
    {
        $skill  = Skill::find($id);
        if ($skill) {
            $skill  = Skill::skill($request, $id);
            return response()->json(['Update skill  success' => true, 'data' => $skill], 200);
        }
        return response()->json(['message' => "Skill id not found"], 404);
    }

    public function deleteSkill(string $id)
    {
        $skill = Skill::find($id);
        if (!$skill) {
            return response()->json(['message' => 'Skill id not found'], 404);
        }
        $skill->delete();
        return response()->json(['Delete skill successfully' => true, 'data' => $skill], 201);
    }


}
