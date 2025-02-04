<?php

namespace App\Http\Controllers;

use App\Models\Restaurants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class RestaurantsController extends Controller
{
    public function index()
    {
        $restaurants = Restaurants::with('user')->latest()->paginate(25);
        return view('modules.Restaurants.RestaurantList',[
            'restaurants' => $restaurants
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'menus' => 'required|min:4|string',
            'servies' => 'required|min:4|string',
            'timetable' => 'required|min:4|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new Restaurant.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $restaurant = new Restaurants();
        $restaurant->user_id = Auth::user()->id;
        $restaurant-> title = $request->title;
        $restaurant-> menus = $request->menus;
        $restaurant-> servies = $request->servies;
        $restaurant-> timetable = $request->timetable;
        $restaurant-> contact = $request->contact?? null;
        $restaurant-> upazila = $request->upazila;
        $restaurant-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/restaurants');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($restaurant->image) {
                $oldImagePath = public_path('uploads/restaurants/' . $restaurant->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/restaurants/' . $imageName);

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
            $restaurant->image = $imageName;
        }

        $restaurant->save();

        flash()->success('New Restaurant added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Restaurants $restaurants)
    {
        $restaurant = Restaurants::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'menus' => 'required|min:4|string',
            'servies' => 'required|min:4|string',
            'timetable' => 'required|min:4|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update restaurant.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $restaurant-> title = $request->title;
        $restaurant-> menus = $request->menus;
        $restaurant-> servies = $request->servies;
        $restaurant-> timetable = $request->timetable;
        $restaurant-> contact = $request->contact?? null;
        $restaurant-> upazila = $request->upazila;
        $restaurant-> address = $request->address;
        $restaurant->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/restaurants');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($restaurant->image) {
                $oldImagePath = public_path('uploads/restaurants/' . $restaurant->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/restaurants/' . $imageName);

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
            $restaurant->image = $imageName;
        }

        $restaurant->save();
        flash()->success('Restaurant updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Restaurants $restaurants)
    {
        $id = $request->id;
        $restaurant = Restaurants::find($id);

        if (!$restaurant) {
            return response()->json([
                'status' => false,
                'message' => 'restaurant not found.',
            ], 404);
        }

        if ($restaurant->image) {
            $imagePath = public_path('uploads/restaurants/' . $restaurant->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $restaurant->delete();
        flash()->success('Restaurant deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'restaurant deleted successfully.',
        ], 200);
    }
}
