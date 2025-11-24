<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index(){
        return view('password.index');
    }
    public function generate(Request $request){
        $length = $request->input('length',12);

        $uppercase = $request->boolean('uppercase');
        $lowercase = $request->boolean('lowercase');
        $numbers = $request->boolean('numbers');
        $symbols = $request->boolean('symbols');

        $characters = '';

        if ($uppercase) $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($lowercase) $characters .= 'abcdefghijklmnopqrstuvwxyz';
        if ($numbers) $characters .= '0123456789';
        if ($symbols) $characters .= '!@#$%';

        if ($characters === '') {
            return response()->json(['password'=>''] ,400);
        }

        $password ='';
        for($i=0; $i < $length; $i++){
            $password .=$characters[rand(0, strlen($characters)-1)];
        }

        return response()->json(['password'=>$password]);

    }

    public function secure(){
        return view('password.secure-password');
    }

    public function securePassword(Request $request){
        $request->validate([
            'password' => 'required|min:4',
        ]);

        $hashedPassword = Hash::make($request->password);

        return view('password.secure-password', [
            'hashed' => $hashedPassword,
            'prefilled' => $request->password,
        ]);

    }
}
