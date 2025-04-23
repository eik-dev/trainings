<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
        return response()->json($user);
    }
}
