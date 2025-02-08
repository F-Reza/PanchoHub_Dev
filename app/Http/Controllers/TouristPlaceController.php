<?php

namespace App\Http\Controllers;

use App\Models\TouristPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TouristPlaceController extends Controller
{
    public function index()
    {
        $touristPlaces = TouristPlace::latest()->paginate(25);
        return view('modules.TouristPlace.TouristPlace',[
            'touristPlaces' => $touristPlaces
        ]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $directory = public_path('uploads/touristPlaces');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $file = $request->file('upload');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);

            $filePath = public_path('uploads/touristPlaces/' . $fileName);
            $img->resize(450, 250);
            $quality = 90;
            do {
                $img->save($filePath, $quality);
                $imageSize = filesize($filePath);
                $quality -= 5;
            } while ($imageSize > 2 * 1024 * 1024 && $quality > 10);

            // Return the URL for CKEditor
            $url = asset('uploads/touristPlaces/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'No file uploaded.']]);
    }

    public function store(Request $request)
    {
        $touristPlace = new TouristPlace();
        $touristPlace-> place_name = $request->place_name;
        $touristPlace-> place_details = $request->place_details;
        $touristPlace-> upazila = $request->upazila;
        $touristPlace-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/touristPlaces');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($touristPlace->image) {
                $oldImagePath = public_path('uploads/touristPlaces/' . $touristPlace->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/touristPlaces/' . $imageName);

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
            $touristPlace->image = $imageName;
        }

        $touristPlace->save();

        flash()->success('Tourist Place added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, TouristPlace $touristPlace)
    {
        $touristPlace = TouristPlace::findOrFail($id);
        $touristPlace-> place_name = $request->place_name;
        $touristPlace-> place_details = $request->place_details;
        $touristPlace-> upazila = $request->upazila;
        $touristPlace-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/touristPlaces');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($touristPlace->image) {
                $oldImagePath = public_path('uploads/touristPlaces/' . $touristPlace->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/touristPlaces/' . $imageName);

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
            $touristPlace->image = $imageName;
        }

        $touristPlace->save();

        flash()->success('Tourist Place updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, TouristPlace $touristPlace)
    {
        $id = $request->id;
        $touristPlace = TouristPlace::find($id);

        if (!$touristPlace) {
            return response()->json([
                'status' => false,
                'message' => 'Tourist Place not found.',
            ], 404);
        }

        if ($touristPlace->image) {
            $imagePath = public_path('uploads/touristPlaces/' . $touristPlace->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $touristPlace->delete();
        flash()->success('Tourist Place deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Tourist Place deleted successfully.',
        ], 200);
    }
}
