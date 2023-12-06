<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first(); 
        

        if(!$user){
            return response()->json([
                'message' => 'Not found this user Email please try again',
                'status_code' => 500
            ], 500);
        }else{

            $request->validate([
                'password'=> 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            ]);
    
            $password = $request->password;
            $user->update([
                'password' =>  bcrypt($password),
            ]);
            if ($user->save()) {
                return response()->json([
                    'message' => 'Password changed successfully',
                    'status_code' => 200,
                    "data" => $user
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Some error occurred, Please try again',
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function SendMail(Request $request)
    {
        $data =[
            'subject' =>"Reset Password",
            'body' =>"Please click link below to reset your password",
            'email' =>$request->email
        ];
        try
        {
            $user = User::where('email',$data['email'])->first();
            Mail::to($data['email'])->send(new UserMail($data));
            return response()->json("great check you mail box");
        }
        catch(Exception $th)
        {
            return response()->json("Sorry something went wrong"); 
        }
    }


}
