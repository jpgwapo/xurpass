<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Save a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checkEmail = sizeOf(User::where('email', $request->email)->get()) === 1 ? true : false;

        if($checkEmail){
            $res = response()->json(["message" => "Email already taken"], 400);
        }else{
            User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
    
            $res = response()->json(["message" => "User successfully registered"], 201);
        }

        return $res;
    }
}
