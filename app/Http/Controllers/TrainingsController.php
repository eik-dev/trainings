<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Price;
use App\Models\Media;
use App\Models\Module;
use App\Models\ModuleMedia;
class TrainingsController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(['message' => 'All Trainings']);
    }

    public function draft(Request $request)
    {
        $trainings = Training::where('draft', true)->get();
        return response()->json([
            'success' => true,
            'message' => 'Draft trainings fetched successfully',
            'data' => $trainings
        ]);
    }

    public function create(Request $request)
    {
        $training = Training::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'reference_id' => $request->reference_id,
            'start_date' => $request->start,
            'end_date' => $request->end,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Training created successfully',
            'data' => $training
        ]);
    }

    public function pricing(Request $request)
    {
        logger($request->all());
        if (isset($request->membersPrice)) {
            Price::create([
                'training_id' => $request->training_id,
                'type' => 'members',
                'price' => $request->membersPrice,
            ]);
        }
        
        if (isset($request->nonMembersPrice)) {
            Price::create([
                'training_id' => $request->training_id,
                'type' => 'non-members',
                'price' => $request->nonMembersPrice,
            ]);
        }
        
        if (isset($request->studentPrice)) {
            Price::create([
                'training_id' => $request->training_id,
                'type' => 'student',
                'price' => $request->studentPrice,
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Pricing created successfully',
        ]);
    }

    public function media(Request $request)
    {
        $file = $request->file('file');
        $destinationPath = public_path("uploads/trainings/$request->training_id/$request->type");
        $name = $file->getClientOriginalName();
        $file->move($destinationPath, str_replace(' ', '_', $name));
        $url = url("uploads/trainings/$request->training_id/$request->type/" . str_replace(' ', '_', $name));

        Media::create([
            'training_id' => $request->training_id,
            'type' => $request->type,
            'url' => $url,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Media created successfully',
        ]);
    }

    public function modules(Request $request)
    {
        $module = Module::create([
            'training_id' => $request->training_id,
            'trainer_id' => $request->trainer_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'url' => $request->url,
            'status' => $request->status,
            'time' => $request->time,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Module created successfully',
            'data' => $module
        ]);
    }

    public function moduleMedia(Request $request)
    {
        $file = $request->file('file');
        $destinationPath = public_path("uploads/trainings/modules/$request->module_id");
        $name = $file->getClientOriginalName();
        $file->move($destinationPath, str_replace(' ', '_', $name));
        $url = url("uploads/trainings/modules/$request->module_id/" . str_replace(' ', '_', $name));
        logger($url);

        ModuleMedia::create([
            'training_id' => $request->training_id,
            'module_id' => $request->module_id,
            'url' => $url,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Media created successfully',
        ]);
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
    public function training(Training $training)
    {
        return response()->json([
            'success' => true,
            'message' => 'Training fetched successfully',
            'data' => $training
        ]);
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
