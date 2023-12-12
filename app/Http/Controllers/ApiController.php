<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function Register(Request $request)
    {
        $data = $request->only('name','email','password');
        $validator = Validator::make($data,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->messages()],200);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        if($user)
        {
            return response()->json([
                'success' => true ,
                'message' => 'user Created Success',
                'data' => $user
            ],Response::HTTP_OK);
        }
    }
}
