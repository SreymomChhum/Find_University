<?php

namespace App\Http\Controllers;


use App\Http\Resources\SchoolUserResource;
use App\Mail\AcceptMail;
use App\Mail\RejectMail;
use App\Models\SchoolUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SchoolUserController extends Controller
{
    



    public function getSchoolUser(Request $request,$id){
        $schoolUsers = SchoolUser::where('accept', false)->where('school_id',$id)->orderBy('id', 'DESC')->get();
        $schoolUsers = SchoolUserResource::collection($schoolUsers);
        return response()->json(['success'=>"request successfully", 'data'=>$schoolUsers],200);
    }

    

    public function store(Request $request)
    {
       
        $schoolUser = SchoolUser::schoolUser($request);
        return response()->json(['success' =>true, 'data' => $schoolUser],200);
    }



    public function studentAccept(Request $request,$id){
        $student = SchoolUser::find($id);
        $student->update(['accept' => true]);
        $student->save();
        // find email address of student
        $user = SchoolUser::where('id', $id)->first();
        $userID = $student['user_id'];
        $user = User::find($userID);
        $email = $user->email;
        // send eamil to student
        $this->studentEmailAccept($email);
        return response()->json(['success'=>"request successfully", 'data'=>$student],200);
    }

    public function studentReject($id){
        $student = SchoolUser::find($id);
        $student->delete();
        // find email address of student
        $user = SchoolUser::where('id', $id)->first();
        $userID = $student['user_id'];
        $user = User::find($userID);
        $email = $user->email;
        // send eamil to student
        $this->studentEmailReject($email);
        return response()->json(['success'=>"request successfully", 'data'=>$student],200);
    }


    public function studentEmailAccept($email)
    {
        
        $data =[
            'subject' =>"Accept for students",
            'body' =>"Welcome to our School. you are selected to join for study in our school"
        ];
        try
        {
            Mail::to($email)->send(new AcceptMail($data));
            return response()->json("great check you mail box");
        }
        catch(Exception $th)
        {
            return response()->json("Sorry something went wrong"); 
        }
    }

    public function studentEmailReject($email)
    { 
        $data =[
            'subject' =>"Reject for study",
        ];
        try
        {
            Mail::to($email)->send(new RejectMail($data));
            return response()->json("great check you mail box");
        }
        catch(Exception $th)
        {
            return response()->json("Sorry something went wrong"); 
        }
    }
    
}
