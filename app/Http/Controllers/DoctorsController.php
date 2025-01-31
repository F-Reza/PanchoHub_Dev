<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctors::with('user')->latest()->paginate(25);
        return view('modules.Doctors.DoctorList',[
            'doctors' => $doctors
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'dr_name' => 'required|min:4|string|max:255',
            'category' => 'required|not_in:null,',
            'education_qualify' => 'required|min:4|string|max:255',
            'current_servise' => 'required|min:4|string|max:255',
            'spacialist' => 'required|min:4|string|max:255',

            'chambers' => 'array|min:1',
            'chambers.*.chamber_name' => 'string|max:255',
            'chambers.*.chamber_address' => 'string|max:255',
            'chambers.*.chamber_contact' => 'string|max:255',
            'chambers.*.chamber_date' => 'string|max:255',
            'chambers.*.chamber_time' => 'string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            dd ($validator->errors());
            flash()->error('Failed to add new doctor.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $doctor = new Doctors();
        $doctor->user_id = Auth::user()->id;
        $doctor-> dr_name = $request->dr_name;
        $doctor-> category = $request->category;
        $doctor-> education_qualify = $request->education_qualify;
        $doctor-> current_servise = $request->current_servise;
        $doctor-> spacialist = $request->spacialist;
        // $doctor->chambers = json_encode($request->chambers, JSON_UNESCAPED_UNICODE);
        $doctor->chambers = json_encode($request->chambers, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);


        if ($request->hasFile('image')) {

            $directory = public_path('uploads/doctors');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($doctor->image) {
                $oldImagePath = public_path('uploads/doctors/' . $doctor->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/doctors/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(450, 550);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $doctor->image = $imageName;
        }

        $doctor->save();

        flash()->success('New doctor added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Doctors $doctors)
    {
        $doctor = Doctors::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'dr_name' => 'required|min:4|string|max:255',
            'category' => 'required|not_in:null,',
            'education_qualify' => 'required|min:4|string|max:255',
            'current_servise' => 'required|min:4|string|max:255',
            'spacialist' => 'required|min:4|string|max:255',

            'chambers' => 'array|min:1',
            'chambers.*.chamber_name' => 'string|max:255',
            'chambers.*.chamber_address' => 'string|max:255',
            'chambers.*.chamber_contact' => 'string|max:255',
            'chambers.*.chamber_date' => 'string|max:255',
            'chambers.*.chamber_time' => 'string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update doctor.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $doctor-> dr_name = $request->dr_name;
        $doctor-> category = $request->category;
        $doctor-> education_qualify = $request->education_qualify;
        $doctor-> current_servise = $request->current_servise;
        $doctor-> spacialist = $request->spacialist;
        $doctor->chambers = json_encode($request->chambers, JSON_UNESCAPED_UNICODE);

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/doctors');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($doctor->image) {
                $oldImagePath = public_path('uploads/doctors/' . $doctor->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/doctors/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(600, 480);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $doctor->image = $imageName;
        }

        $doctor->save();

        flash()->success('New doctor updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Doctors $doctors)
    {
        $id = $request->id;
        $doctor = Doctors::find($id);

        if (!$doctor) {
            return response()->json([
                'status' => false,
                'message' => 'Doctor not found.',
            ], 404);
        }

        if ($doctor->image) {
            $imagePath = public_path('uploads/doctors/' . $doctor->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $doctor->delete();
        flash()->success('Doctor deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Doctor deleted successfully.',
        ], 200);
    }
}
