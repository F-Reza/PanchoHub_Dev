<?php

namespace App\Http\Controllers;

use App\Models\SalonParlour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SalonParlourController extends Controller
{
    public function index()
    {
        $salonParlours = SalonParlour::with('user')->latest()->paginate(25);
        return view('modules.SalonParlour.SalonParlourList',[
            'salonParlours' => $salonParlours
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'category' => 'required|not_in:null,',
            'servies' => 'required|min:4|string',
            'timetable' => 'required|min:4|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new SalonParlour.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $salonParlour = new SalonParlour();
        $salonParlour->user_id = Auth::user()->id;
        $salonParlour-> title = $request->title;
        $salonParlour-> category = $request->category;
        $salonParlour-> servies = $request->servies;
        $salonParlour-> timetable = $request->timetable;
        $salonParlour-> contact = $request->contact?? null;
        $salonParlour-> upazila = $request->upazila;
        $salonParlour-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/salonParlours');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($salonParlour->image) {
                $oldImagePath = public_path('uploads/salonParlours/' . $salonParlour->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/salonParlours/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(450, 250);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $salonParlour->image = $imageName;
        }

        $salonParlour->save();

        flash()->success('New SalonParlour added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, SalonParlour $salonParlour)
    {
        $salonParlour = SalonParlour::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'category' => 'required|not_in:null,',
            'servies' => 'required|min:4|string',
            'timetable' => 'required|min:4|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update SalonParlour.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $salonParlour-> title = $request->title;
        $salonParlour-> category = $request->category;
        $salonParlour-> servies = $request->servies;
        $salonParlour-> timetable = $request->timetable;
        $salonParlour-> contact = $request->contact?? null;
        $salonParlour-> upazila = $request->upazila;
        $salonParlour-> address = $request->address;
        $salonParlour->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/salonParlours');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($salonParlour->image) {
                $oldImagePath = public_path('uploads/salonParlours/' . $salonParlour->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/salonParlours/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(450, 250);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $salonParlour->image = $imageName;
        }

        $salonParlour->save();
        flash()->success('SalonParlour updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, SalonParlour $salonParlour)
    {
        $id = $request->id;
        $salonParlour = SalonParlour::find($id);

        if (!$salonParlour) {
            return response()->json([
                'status' => false,
                'message' => 'SalonParlour not found.',
            ], 404);
        }

        if ($salonParlour->image) {
            $imagePath = public_path('uploads/salonParlours/' . $salonParlour->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $salonParlour->delete();
        flash()->success('SalonParlour deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'SalonParlour deleted successfully.',
        ], 200);
    }
}
