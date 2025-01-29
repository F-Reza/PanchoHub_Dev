<?php

namespace App\Http\Controllers;

use App\Models\Hospitals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HospitalsController extends Controller
{
    public function index()
    {
        $hospitals = Hospitals::latest()->paginate(25);
        return view('modules.Hospitals.HospitalList',[
            'hospitals' => $hospitals
        ]);
        // return view('modules.Hospitals.HospitalList');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'hp_name' => 'required|min:4',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new hospital.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $hospital = new Hospitals();
        $hospital-> user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $hospital-> hp_name = $request->hp_name;
        $hospital-> contact = $request->contact;
        $hospital-> upazila = $request->upazila;
        $hospital-> address = $request->address;
        $hospital-> image = $request->image?? null;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/hospitals');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($hospital->image) {
                $oldImagePath = public_path('uploads/hospitals/' . $hospital->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/hospitals/' . $imageName);

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
            $hospital->image = $imageName;
        }

        $hospital->save();

        flash()->success('New hospital added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Hospitals $hospitals)
    {
        $hospital = Hospitals::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'hp_name' => 'required|min:4',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|not_in:null,',
            'status' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update hospital.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $hospital = new Hospitals();
        $hospital-> hp_name = $request->hp_name;
        $hospital-> contact = $request->contact;
        $hospital-> upazila = $request->upazila;
        $hospital-> address = $request->address;
        $hospital-> image = $request->image?? null;
        $hospital->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/hospitals');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($hospital->image) {
                $oldImagePath = public_path('uploads/hospitals/' . $hospital->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/hospitals/' . $imageName);

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
            $hospital->image = $imageName;
        }

        $hospital->save();
        flash()->success(' Hospital updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Hospitals $hospitals)
    {
        $id = $request->id;
        $hospital = Hospitals::find($id);

        if (!$hospital) {
            return response()->json([
                'status' => false,
                'message' => 'Hospital not found.',
            ], 404);
        }

        if ($hospital->image) {
            $imagePath = public_path('uploads/hospitals/' . $hospital->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $hospital->delete();

        return response()->json([
            'status' => true,
            'message' => 'Hospital deleted successfully.',
        ], 200);
    }
}
