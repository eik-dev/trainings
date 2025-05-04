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
        foreach ($request->trainers as $trainer) {
            Trainer::create([
                'name' => $trainer['name'],
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Trainer created successfully',
        ]);
    }
}
