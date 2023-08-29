<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    //
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => User::all(),
        ]);
    }
}
