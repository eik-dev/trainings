<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainer;
class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::all();
        return response()->json($trainers);
    }

    public function create(Request $request)
    {
        $trainer = Trainer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return response()->json($trainer);
    }
}
