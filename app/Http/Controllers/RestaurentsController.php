<?php

namespace App\Http\Controllers;

use App\Models\Restaurents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class RestaurentsController extends Controller
{
    public function index()
    {
        $restaurents = Restaurents::with('user')->latest()->paginate(25);
        return view('modules.Restaurents.RestaurentList',[
            'restaurents' => $restaurents
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
            flash()->error('Failed to add new Restaurent.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $restaurent = new Restaurents();
        $restaurent->user_id = Auth::user()->id;
        $restaurent-> title = $request->title;
        $restaurent-> menus = $request->menus;
        $restaurent-> servies = $request->servies;
        $restaurent-> timetable = $request->timetable;
        $restaurent-> contact = $request->contact?? null;
        $restaurent-> upazila = $request->upazila;
        $restaurent-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/restaurents');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($restaurent->image) {
                $oldImagePath = public_path('uploads/restaurents/' . $restaurent->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/restaurents/' . $imageName);

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
            $restaurent->image = $imageName;
        }

        $restaurent->save();

        flash()->success('New Restaurent added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Restaurents $restaurents)
    {
        $restaurent = Restaurents::findOrFail($id);

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
            flash()->error('Failed to update restaurent.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $restaurent-> title = $request->title;
        $restaurent-> menus = $request->menus;
        $restaurent-> servies = $request->servies;
        $restaurent-> timetable = $request->timetable;
        $restaurent-> contact = $request->contact?? null;
        $restaurent-> upazila = $request->upazila;
        $restaurent-> address = $request->address;
        $restaurent->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/restaurents');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($restaurent->image) {
                $oldImagePath = public_path('uploads/restaurents/' . $restaurent->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/restaurents/' . $imageName);

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
            $restaurent->image = $imageName;
        }

        $restaurent->save();
        flash()->success('Restaurent updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Restaurents $restaurents)
    {
        $id = $request->id;
        $restaurent = Restaurents::find($id);

        if (!$restaurent) {
            return response()->json([
                'status' => false,
                'message' => 'restaurent not found.',
            ], 404);
        }

        if ($restaurent->image) {
            $imagePath = public_path('uploads/restaurents/' . $restaurent->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $restaurent->delete();
        flash()->success('Restaurent deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'restaurent deleted successfully.',
        ], 200);
    }
}
