<?php

namespace App\Http\Controllers;

use App\Models\TrainSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TrainScheduleController extends Controller
{
    public function index()
    {
        $trainSchedules = TrainSchedule::latest()->paginate(5);
        return view('modules.TrainSchedule.TrainSchedule',[
            'trainSchedules' => $trainSchedules
        ]);
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $directory = public_path('uploads/trainSchedules');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);

            $filePath = public_path('uploads/trainSchedules/' . $fileName);
            $img->resize(1360, null);
            $quality = 90;
            do {
                $img->save($filePath, $quality);
                $imageSize = filesize($filePath);
                $quality -= 5;
            } while ($imageSize > 2 * 1024 * 1024 && $quality > 10);

            // Return the URL for CKEditor
            $url = asset('uploads/trainSchedules/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'No file uploaded.']]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required|min:2|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add Train Schedule.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $trainSchedule = new TrainSchedule();
        $trainSchedule-> description = $request->description;

        $trainSchedule->save();

        flash()->success('Train Schedule added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, TrainSchedule $trainSchedule)
    {
        $trainSchedule = TrainSchedule::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'description' => 'required|min:2|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Train Schedule.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $trainSchedule-> description = $request->description;

        $trainSchedule->save();
        flash()->success('Train Schedule updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, TrainSchedule $trainSchedule)
    {
        $id = $request->id;
        $trainSchedule = TrainSchedule::find($id);

        if (!$trainSchedule) {
            return response()->json([
                'status' => false,
                'message' => 'Train Schedule not found.',
            ], 404);
        }

        $trainSchedule->delete();
        flash()->success('Train Schedule deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Train Schedule deleted successfully.',
        ], 200);
    }
}
