<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // echo User::all();
        $user = User::where('email',$request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['No such user.'],
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Incorrect password.'],
            ]);
        }

        return response()->json(['token' => $user->createToken($request->email)->plainTextToken]);
    }
}
