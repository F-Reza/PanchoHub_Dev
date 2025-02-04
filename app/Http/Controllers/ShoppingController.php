<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ShoppingController extends Controller
{
    public function index()
    {
        $shoppings = Shopping::with('user')->latest()->paginate(25);
        return view('modules.Shoppings.ShoppingList',[
            'shoppings' => $shoppings
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'category' => 'required|not_in:null,',
            'details' => 'required|min:4|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new Shopping.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $shopping = new Shopping();
        $shopping->user_id = Auth::user()->id;
        $shopping-> title = $request->title;
        $shopping-> category = $request->category;
        $shopping-> details = $request->details;
        $shopping-> price = $request->price?? null;
        $shopping-> contact = $request->contact?? null;
        $shopping-> upazila = $request->upazila;
        $shopping-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/shoppings');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($shopping->image) {
                $oldImagePath = public_path('uploads/shoppings/' . $shopping->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/shoppings/' . $imageName);

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
            $shopping->image = $imageName;
        }

        $shopping->save();

        flash()->success('New Shopping added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Shopping $shopping)
    {
        $shopping = Shopping::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'category' => 'required|not_in:null,',
            'details' => 'required|min:4|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            dd ($validator->errors());
            flash()->error('Failed to update Shopping.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $shopping-> title = $request->title;
        $shopping-> category = $request->category;
        $shopping-> details = $request->details;
        $shopping-> price = $request->price?? null;
        $shopping-> contact = $request->contact?? null;
        $shopping-> upazila = $request->upazila;
        $shopping-> address = $request->address;
        $shopping->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/shoppings');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($shopping->image) {
                $oldImagePath = public_path('uploads/shoppings/' . $shopping->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/shoppings/' . $imageName);

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
            $shopping->image = $imageName;
        }

        $shopping->save();
        flash()->success('Shopping updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Shopping $shopping)
    {
        $id = $request->id;
        $shopping = Shopping::find($id);

        if (!$shopping) {
            return response()->json([
                'status' => false,
                'message' => 'Shopping not found.',
            ], 404);
        }

        if ($shopping->image) {
            $imagePath = public_path('uploads/shoppings/' . $shopping->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $shopping->delete();
        flash()->success('Shopping deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Shopping deleted successfully.',
        ], 200);
    }
}
