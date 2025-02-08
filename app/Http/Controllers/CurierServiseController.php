<?php

namespace App\Http\Controllers;

use App\Models\CurierServise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CurierServiseController extends Controller
{
    public function index()
    {
        $curierServises = CurierServise::latest()->paginate(25);
        return view('modules.CurierServise.CurierServise',[
            'curierServises' => $curierServises
        ]);
    }

    public function store(Request $request)
    {
        $curierServise = new CurierServise();
        $curierServise-> title = $request->title;
        $curierServise-> contact = $request->contact;
        $curierServise-> upazila = $request->upazila;
        $curierServise-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/curierServises');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($curierServise->image) {
                $oldImagePath = public_path('uploads/curierServises/' . $curierServise->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/curierServises/' . $imageName);

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
            $curierServise->image = $imageName;
        }

        $curierServise->save();

        flash()->success('Curier Servise added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, CurierServise $curierServise)
    {
        $curierServise = CurierServise::findOrFail($id);
        $curierServise-> title = $request->title;
        $curierServise-> contact = $request->contact;
        $curierServise-> upazila = $request->upazila;
        $curierServise-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/curierServises');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($curierServise->image) {
                $oldImagePath = public_path('uploads/curierServises/' . $curierServise->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/curierServises/' . $imageName);

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
            $curierServise->image = $imageName;
        }

        $curierServise->save();

        flash()->success('Curier Servise updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, CurierServise $curierServise)
    {
        $id = $request->id;
        $curierServise = CurierServise::find($id);

        if (!$curierServise) {
            return response()->json([
                'status' => false,
                'message' => 'Curier Servise not found.',
            ], 404);
        }

        if ($curierServise->image) {
            $imagePath = public_path('uploads/curierServises/' . $curierServise->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $curierServise->delete();
        flash()->success('Curier Servise deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Curier Servise deleted successfully.',
        ], 200);
    }
}
