<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    //
    public function index(Request $request)
    {
        $training = [
            'image'=>'/Training3.jpeg',
            'name'=>'Thought Leadership Webinar Series',
            'message'=>'Members 20% discount',
            'category'=>'Business',
            'price'=>27000,
        ];
        $data = [
            'stats'=>[
                'students'=>120,
                'instructors'=>34,
                'approval'=>8,
            ],
            'trainings'=>array_fill(0, 4, $training)
        ];
        return response()->json($data);
    }
    public function all(Request $request)
    {
        $training = [
            'image'=>'/Training3.jpeg',
            'name'=>'Thought Leadership Webinar Series',
            'message'=>'Members 20% discount',
            'category'=>'Business',
            'price'=>27000,
        ];
        $carousel = [
            'image'=>'/Training3.jpeg',
            'name'=>'Thought Leadership Webinar Series',
            'description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veritatis delectus laborum, accusantium, autem culpa atque maxime, animi omnis provident nisi possimus rerum non voluptate? Iste soluta ratione et ipsum alias.',
        ];
        $data = [
            'recommended'=>array_fill(0, 4, $training),
            'carousel'=>array_fill(0, 3, $carousel),
            'popular'=>array_fill(0, 4, $training),
            'trending'=>array_fill(0, 4, $training)
        ];
        return response()->json($data);
    }
    public function dashboard(Request $request)
    {
        $data = [];
        return response()->json($data);
    }
}
