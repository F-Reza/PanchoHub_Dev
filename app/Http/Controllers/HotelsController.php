<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HotelsController extends Controller
{

    public function index()
    {
        $hotels = Hotels::with('user')->latest()->paginate(25);
        return view('modules.Hotels.HotellList',[
            'hotels' => $hotels
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'details' => 'required|min:4|string',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new hotel.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $hotel = new Hotels();
        $hotel->user_id = Auth::user()->id;
        $hotel-> title = $request->title;
        $hotel-> details = $request->details;
        $hotel-> contact = $request->contact;
        $hotel-> upazila = $request->upazila;
        $hotel-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/hotels');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($hotel->image) {
                $oldImagePath = public_path('uploads/hotels/' . $hotel->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/hotels/' . $imageName);

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
            $hotel->image = $imageName;
        }

        $hotel->save();

        flash()->success('New hotel added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Hotels $hotels)
    {
        $hotel = hotels::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'details' => 'required|min:4|string',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Hotel.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $hotel-> title = $request->title;
        $hotel-> details = $request->details;
        $hotel-> contact = $request->contact;
        $hotel-> upazila = $request->upazila;
        $hotel-> address = $request->address;
        $hotel->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/hotels');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($hotel->image) {
                $oldImagePath = public_path('uploads/hotels/' . $hotel->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/hotels/' . $imageName);

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
            $hotel->image = $imageName;
        }

        $hotel->save();
        flash()->success('Hotel updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Hotels $hotels)
    {
        $id = $request->id;
        $hotel = Hotels::find($id);

        if (!$hotel) {
            return response()->json([
                'status' => false,
                'message' => 'Hotel not found.',
            ], 404);
        }

        if ($hotel->image) {
            $imagePath = public_path('uploads/hotels/' . $hotel->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $hotel->delete();
        flash()->success('Hotel deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Hotel deleted successfully.',
        ], 200);
    }
}
