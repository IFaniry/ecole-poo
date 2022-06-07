<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
// public function register(Request $request) {
//     $fields = $request->validate([
//         'name' => 'required|string',
//         'email' => 'required|string|unique:users,email',
//         'password' => 'required|string|confirmed', // besoin de password_confirmation
//     ]);

//     $user = User::create([
//         'name' => $fields['name'],
//         'email' => $fields['email'],
//         'password' => bcrypt($fields['password']),
//     ]);

//     // TODO: generate KEY
//     $token = $user->createToken('MY_APP_TOKEN')->plainTextToken;

//     $response = [
//         'user' => $user,
//         'token' => $token
//     ];

//     return response($response, 201);
// }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        // TODO: generate KEY
        $token = $user->createToken('MY_APP_TOKEN')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response);
    }


    // public function logout(Request $request) {
    //     // TODO: find user by email for example
    //     auth()->user()->tokens()->delete();

    //     return [
    //         'message' => 'Logged out'
    //     ];
    // }
}
