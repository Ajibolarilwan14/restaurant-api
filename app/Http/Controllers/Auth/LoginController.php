<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginValidation;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(LoginValidation $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if(!($user) || (!(Hash::check($request->password, $user->password))))
        {
            // return response()->json([
            //     'message' => 'Whoops! those credentials does not match any of our records'
            // ], 422);
            throw ValidationException::withMessages([
                'message' => 'Whoops! those credentials does not match any of our records'
            ]);
        }

        return response()->json([
            'message' => 'Login Successfull',
            'token' => $user->createToken('jfjfjkkfddfjkfdrioi49493')->plainTextToken
        ]);
    }
}
