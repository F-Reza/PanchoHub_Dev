<?php

namespace App\Http\Controllers;

use App\Models\Institutions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class InstitutionsController extends Controller
{
    public function index()
    {
        $institutions = Institutions::with('user')->latest()->paginate(25);
        return view('modules.Institutions.InstitutionList',[
            'institutions' => $institutions
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'title' => 'required|min:4|string',
            'est_year' => 'required|min:2|string',
            'details' => 'required|min:4|string',
            'type' => 'required|not_in:null,',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new Institutions.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $institution = new Institutions();
        $institution->user_id = Auth::user()->id;
        $institution-> category = $request->category;
        $institution-> title = $request->title;
        $institution-> est_year = $request->est_year;
        $institution-> details = $request->details;
        $institution-> type = $request->type;
        $institution-> contact = $request->contact;
        $institution-> email = $request->email?? null;
        $institution-> upazila = $request->upazila;
        $institution-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/institutions');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($institution->image) {
                $oldImagePath = public_path('uploads/institutions/' . $institution->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/institutions/' . $imageName);

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
            $institution->image = $imageName;
        }

        $institution->save();

        flash()->success('New Institutions added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, Institutions $institutions)
    {
        $institution = Institutions::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'title' => 'required|min:4|string',
            'est_year' => 'required|min:2|string',
            'details' => 'required|min:4|string',
            'type' => 'required|not_in:null,',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Institutions.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $institution-> category = $request->category;
        $institution-> title = $request->title;
        $institution-> est_year = $request->est_year;
        $institution-> details = $request->details;
        $institution-> type = $request->type;
        $institution-> contact = $request->contact;
        $institution-> email = $request->email?? null;
        $institution-> upazila = $request->upazila;
        $institution-> address = $request->address;
        $institution->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/institutions');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($institution->image) {
                $oldImagePath = public_path('uploads/institutions/' . $institution->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/institutions/' . $imageName);

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
            $institution->image = $imageName;
        }

        $institution->save();
        flash()->success('Institutions updated successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, Institutions $institutions)
    {
        $id = $request->id;
        $institution = Institutions::find($id);

        if (!$institution) {
            return response()->json([
                'status' => false,
                'message' => 'Institutions not found.',
            ], 404);
        }

        if ($institution->image) {
            $imagePath = public_path('uploads/institutions/' . $institution->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $institution->delete();
        flash()->success('Institutions deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Institutions deleted successfully.',
        ], 200);
    }
}
