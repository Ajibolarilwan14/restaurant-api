<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterValidation;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterValidation $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json([
            'data' => $user
        ],201);
    }
}