<?php

namespace App\Http\Controllers;

use App\Models\Nursery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class NurseryController extends Controller
{
    public function index()
    {
        $nurseries = Nursery::with('user')->latest()->paginate(25);
        return view('modules.Nursery.NurseryList',[
            'nurseries' => $nurseries
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:2|string',
            'details' => 'required|min:2|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new Nursery.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $nursery = new Nursery();
        $nursery->user_id = Auth::user()->id;
        $nursery-> title = $request->title;
        $nursery-> details = $request->details;
        $nursery-> contact = $request->contact?? null;
        $nursery-> upazila = $request->upazila;
        $nursery-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/nurseries');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($nursery->image) {
                $oldImagePath = public_path('uploads/nurseries/' . $nursery->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/nurseries/' . $imageName);

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
            $nursery->image = $imageName;
        }

        $nursery->save();

        flash()->success('New Nursery added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Nursery $nursery)
    {
        $nursery = Nursery::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:2|string',
            'details' => 'required|min:2|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Nursery.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $nursery-> title = $request->title;
        $nursery-> details = $request->details;
        $nursery-> contact = $request->contact?? null;
        $nursery-> upazila = $request->upazila;
        $nursery-> address = $request->address;
        $nursery->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/nurseries');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($nursery->image) {
                $oldImagePath = public_path('uploads/nurseries/' . $nursery->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/nurseries/' . $imageName);

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
            $nursery->image = $imageName;
        }

        $nursery->save();
        flash()->success('Nursery updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Nursery $nursery)
    {
        $id = $request->id;
        $nursery = Nursery::find($id);

        if (!$nursery) {
            return response()->json([
                'status' => false,
                'message' => 'Nursery not found.',
            ], 404);
        }

        if ($nursery->image) {
            $imagePath = public_path('uploads/nurseries/' . $nursery->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $nursery->delete();
        flash()->success('Nursery deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Nursery deleted successfully.',
        ], 200);
    }
}
