<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ]);

        $emailExists = User::where('email', $request->email)->exists();

        if ($emailExists) {
            return response()->json([
                'message' => 'The provided email already exists.',
            ], 400);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user->save()) {
            return response()->json([
                'message' => 'Successfully created user!'
            ], 201);
        } else {
            return response()->json(['error' => 'Provide proper details'], 400);
        }
    }


    public function login(Request $request)
    {

      $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean'
      ]);

      $credentials = request(['email', 'password']);
      if(!Auth::attempt($credentials)){
            return response()->json([
            'message' => 'Unauthorized'
            ], 401);
        }

      $user = $request->user();
      $tokenResult = $user->createToken('Personal Access Token');
      $token = $tokenResult->token;

      if ($request->remember_me){
        $token->expires_at = Carbon::now()->addWeeks(1);
      }

      $token->save();

      return response()->json([
        'access_token' => $tokenResult->accessToken,
        'token_type' => 'Bearer',
        'expires_at' => Carbon::parse(
          $tokenResult->token->expires_at
        )->toDateTimeString()
      ]);
    }

    public function logout(Request $request)
    {
      $request->user()->token()->revoke();
      return response()->json([
        'message' => 'Successfully logged out'
      ]);
    }
}
