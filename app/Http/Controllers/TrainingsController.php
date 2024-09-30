<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(['message' => 'All Trainings']);
    }
    public function calendar(Request $request)
    {
        $training = [
            'name'=>'Thought Leadership Webinar Series',
            'date'=>'Friday, 18th',
            'mode'=>'Virtual',
            'points'=>3.0
        ];
        $data=array_fill(0, 12, $training);
        return response()->json($data);
    }
    public function resources(Request $request)
    {
        $data = [
            [
                'name'=>'Intro.docx',
                'link'=>'#'
            ],
            [
                'name'=>'Mobility.ppt',
                'link'=>'#'
            ]
        ];
        return response()->json($data);
    }
    public function training(Request $request)
    {
        $session =[
            'name'=>'Lorem ipsum deor',
            'url'=>'https://www.youtube.com/embed/jCZ9KcSr1NM?list=PLeAdgxgTgf96XOFiZDo0V8X0Ud7NO8zUs',
        ];
        $data = [
            'trainer'=>'Jane Doe',
            'rating'=>4.5,
            'reviews'=>38,
            'sessions'=>array_fill(0, 12, $session),
            'progress'=>[
                'session'=>4,
                'timestamp'=>0
            ]
        ];
        return response()->json($data);
    }
    public function info(Request $request)
    {
        $training = [
            'image'=>'/Training2.jpeg',
            'name'=>'Thought Leadership Webinar Series',
            'message'=>'Members 20% discount',
            'category'=>'Business',
            'price'=>27000,
        ];
        $data = [
            'trainer'=>'Jane Doe',
            'rating'=>4.5,
            'reviews'=>38,
            'media'=>[''],
            'description'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptate earum ut, aperiam consectetur exercitationem placeat corporis iure molestias? Accusantium at repellat neque officiis facilis assumenda eum repudiandae commodi dolorem! Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptate earum ut, aperiam consectetur exercitationem placeat corporis iure molestias? Accusantium at repellat neque officiis facilis assumenda eum repudiandae commodi dolorem!",
            'sessions'=>12,
            'cost'=>[
                [
                    'type'=>"member",
                    'amount'=>9600
                ],
                [
                    'type'=>"student",
                    'amount'=>10000
                ],
                [
                    'type'=>"non-member",
                    'amount'=>12000
                ]
            ],
            'related'=>array_fill(0, 4, $training)
        ];
        return response()->json($data);
    }
    public function user(Request $request)
    {
        $training = [
            'image'=>'/Training1.jpeg',
            'name'=>'Thought Leadership Webinar Series',
            'message'=>'Members 20% discount',
            'category'=>'Business',
            'price'=>27000,
            'purchased'=> true
        ];
        $data = [
            'stats'=>[
                'CPD'=>18,
                'hours'=>29,
                'purchased'=>7,
                'complete'=>5,
            ],
            'trainings'=>array_fill(0, 5, $training)
        ];
        return response()->json($data);
    }
}
