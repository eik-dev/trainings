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
        $training = Training::updateOrCreate(
[
                'title' => $request->title,
            ],
    [
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'reference_id' => $request->reference_id,
                'start_date' => $request->start,
                'end_date' => $request->end,
            ]
        );
        return response()->json([
            'success' => true,
            'message' => 'Training created successfully',
            'data' => $training
        ]);
    }

    public function update(Request $request, Training $training)
    {
        $training->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Training updated successfully',
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
        $training = Training::with('pricing', 'media', 'modules.trainer')->find($training->id);
        return response()->json([
            'success' => true,
            'message' => 'Training fetched successfully',
            'data' => $training
        ]);
    }

    public function checkTraining(Request $request)
    {
        $training = Training::where('reference_id', $request->reference_id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Training fetched successfully',
            'data' => $training
        ]);
    }
    
    public function listTrainings(Request $request)
    {
        $query = Training::with('pricing', 'media', 'modules.trainer')->where('draft', false);
        
        if ($request->has('filter') && $request->filter === 'upcoming') {
            $query->where('start_date', '>', now());
        }
        
        $trainings = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Trainings fetched successfully',
            'data' => $trainings,
            'stats'=>[
                'students'=>120,
                'instructors'=>34,
                'approval'=>8,
            ]
        ]);
    }

    public function fromName(Request $request)
    {
        $training = Training::where('title', 'like', '%'.$request->title.'%')->with('pricing', 'media', 'modules.trainer')->first();
        return response()->json([
            'success' => true,
            'message' => 'Training fetched successfully',
            'data' => $training
        ]);
    }

    public function related(Request $request)
    {
        $training = Training::where('title', 'like', '%'.$request->title.'%')->get(['id', 'title', 'category'])->first();
        logger($training);
        $categories = json_decode($training['category']);
        logger($categories);
        $trainings = Training::whereIn('category', $categories)->with('pricing', 'media', 'modules.trainer')->get();
        return response()->json([
            'success' => true,
            'message' => 'Training fetched successfully',
            'data' => $trainings
        ]);
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
