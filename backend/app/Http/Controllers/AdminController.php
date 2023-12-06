<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::orderBy('id', 'DESC')->where('role_id',"!=",3)->get();
        return response()->json(['message' => "Your get user is success", 'data' => $users], 200);

    }

    // get all student register
    
    public function getStudents()
    {
        //
        $role = Role::where('name', 'student')->first();
        $students = User::where('role_id', $role->id)->orderBy('id', 'DESC')->get();
    
        return response()->json(['message' => "Your get data request is successful", 'data' => $students], 200);
    }



    // get all manager register
    public function getUniversityDirectors()
    {
        $role = Role::where('name', 'university_manager')->first();
        $universityDirectors = User::where('role_id', $role->id)->orderBy('id', 'DESC')->get();

        return response()->json(['message' => "Your get data request is successful", 'data' => $universityDirectors], 200);
    }

    // get student by id
    public function getUser($id)
    {
        $user = User::find($id);
        if($user!=''){
            return response()->json(['success'=>true,'data'=>$user],200);
        } 
        return response()->json(['success'=>true,'data'=>'No data !'],200);

    }

    // update user
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Update other fields as needed
        $user->save();
    
        return response()->json(['message' => 'User updated successfully']);
    }

    // Delete User
    public function destroy(Request $request,$id)
    {
        
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => true, 'message' => `user id:{$id} has been deleted`], 200);
    }
}
