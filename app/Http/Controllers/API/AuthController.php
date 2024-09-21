<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => ['required', Password::min(8)->letters()->numbers(), "max:20"],
            'confirm_password' => 'required|same:password'
        ]);
        if ($validator->fails()){
            return $this->jsonData(false, "Validation error", [], $validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($request->password);
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->plainTextToken;

        return $this->jsonData(true, "Registration successful", (['user' => $user, 'access_token' => $accessToken]));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if($validator->fails())
            return $this->jsonData(false, "Validation error", [], $validator->errors(), 400);

        $loginData = $validator->validated();
        if (!auth()->attempt($loginData)) {
            return $this->jsonData(false, "Invalid login details", [], [], 401);
        }
        $accessToken = auth()->user()->createToken('authToken')->plainTextToken;
        return $this->jsonData(true, "Login successful", ['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return $this->jsonData(true, "User logged out successfully");
    }
}
