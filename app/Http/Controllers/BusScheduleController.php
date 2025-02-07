<?php

namespace App\Http\Controllers;

use App\Models\BusSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BusScheduleController extends Controller
{
    public function index()
    {
        $busSchedules = BusSchedule::latest()->paginate(5);
        return view('modules.BusSchedule.BusSchedule',[
            'busSchedules' => $busSchedules
        ]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $directory = public_path('uploads/busSchedules');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);

            $filePath = public_path('uploads/busSchedules/' . $fileName);
            $img->resize(1360, null);
            $quality = 90;
            do {
                $img->save($filePath, $quality);
                $imageSize = filesize($filePath);
                $quality -= 5;
            } while ($imageSize > 2 * 1024 * 1024 && $quality > 10);

            // Return the URL for CKEditor
            $url = asset('uploads/busSchedules/' . $fileName);
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
            flash()->error('Failed to add Bus Schedule.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $terms = new BusSchedule();
        $terms-> description = $request->description;

        $terms->save();

        flash()->success('Bus Schedule added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, BusSchedule $busSchedule)
    {
        $terms = BusSchedule::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'description' => 'required|min:2|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Bus Schedule.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $terms-> description = $request->description;

        $terms->save();
        flash()->success('Bus Schedule updated successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, BusSchedule $busSchedule)
    {
        $id = $request->id;
        $busSchedule = BusSchedule::find($id);

        if (!$busSchedule) {
            return response()->json([
                'status' => false,
                'message' => 'Bus Schedule not found.',
            ], 404);
        }

        $busSchedule->delete();
        flash()->success('Bus Schedule deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Bus Schedule deleted successfully.',
        ], 200);
    }
}
