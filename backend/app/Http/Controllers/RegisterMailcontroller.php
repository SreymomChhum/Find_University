<?php

namespace App\Http\Controllers;

use App\Mail\Register;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class RegisterMailcontroller extends Controller
{
    //

    
    public function sendEmail(Request $request)
    {

       
        $data =[
            'subject' =>"Register university director",
            'email'=>$request->email,
            'link'=>'http://localhost:8080/signUp'

        ];
        try
        {
            Mail::to($data['email'])->send(new Register($data));
            return response()->json("great check you mail box");
        }
        catch(Exception $th)
        {
            return response()->json("Sorry something went wrong");

        }

    }
}
