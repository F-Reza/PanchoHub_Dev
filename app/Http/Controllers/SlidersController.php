<?php

namespace App\Http\Controllers;

use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SlidersController extends Controller
{
    public function index()
    {
        $sliders = Sliders::with('user')->latest()->paginate(25);
        return view('modules.Sliders.SliderList',[
            'sliders' => $sliders
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'upazila' => 'required|not_in:null,',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new slider.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $slider = new Sliders();
        $slider->user_id = Auth::user()->id;
        $slider-> category = $request->category;
        $slider-> description = $request->description?? null;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/sliders');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($slider->image) {
                $oldImagePath = public_path('uploads/sliders/' . $slider->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/sliders/' . $imageName);

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
            $slider->image = $imageName;
        }

        $slider->save();

        flash()->success('Slider added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Sliders $sliders)
    {
        $slider = Sliders::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'upazila' => 'required|not_in:null,',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update slider.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $slider-> category = $request->category;
        $slider-> description = $request->description?? null;
        $slider->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/sliders');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($slider->image) {
                $oldImagePath = public_path('uploads/sliders/' . $slider->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/sliders/' . $imageName);

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
            $slider->image = $imageName;
        }

        $slider->save();

        flash()->success('Slider added successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, Sliders $sliders)
    {
        $id = $request->id;
        $slider = Sliders::find($id);

        if (!$slider) {
            return response()->json([
                'status' => false,
                'message' => 'Slider not found.',
            ], 404);
        }

        if ($slider->image) {
            $imagePath = public_path('uploads/sliders/' . $slider->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $slider->delete();
        flash()->success('Slider deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Slider deleted successfully.',
        ], 200);
    }
}
