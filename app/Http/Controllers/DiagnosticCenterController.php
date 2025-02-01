<?php

namespace App\Http\Controllers;

use App\Models\DiagnosticCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DiagnosticCenterController extends Controller
{
    public function index()
    {
        $diagnostics = DiagnosticCenter::with('user')->latest()->paginate(25);
        return view('modules.DiagnosticCenter.DiagnosticCenterList',[
            'diagnostics' => $diagnostics
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|not_in:null,',
            'facilities' => 'required|min:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new diagnostic center.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $diagnostic = new DiagnosticCenter();
        $diagnostic-> user_id = Auth::user()->id;
        $diagnostic-> title = $request->title;
        $diagnostic-> contact = $request->contact;
        $diagnostic-> upazila = $request->upazila;
        $diagnostic-> address = $request->address;
        $diagnostic-> facilities = $request->facilities;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/diagnostics');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($diagnostic->image) {
                $oldImagePath = public_path('uploads/diagnostics/' . $diagnostic->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/diagnostics/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(600, 480);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $diagnostic->image = $imageName;
        }

        $diagnostic->save();

        flash()->success('New diagnostic center added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, DiagnosticCenter $diagnosticCenter)
    {
        $diagnostic = DiagnosticCenter::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|not_in:null,',
            'facilities' => 'required|min:4',
            'status' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update diagnostic center.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $diagnostic-> title = $request->title;
        $diagnostic-> contact = $request->contact;
        $diagnostic-> upazila = $request->upazila;
        $diagnostic-> address = $request->address;
        $diagnostic-> facilities = $request->facilities;
        $diagnostic->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/diagnostics');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($diagnostic->image) {
                $oldImagePath = public_path('uploads/diagnostics/' . $diagnostic->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/diagnostics/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(600, 480);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $diagnostic->image = $imageName;
        }

        $diagnostic->save();
        flash()->success('Diagnostic Center updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, DiagnosticCenter $diagnosticCenter)
    {
        $id = $request->id;
        $diagnostic = DiagnosticCenter::find($id);

        if (!$diagnostic) {
            return response()->json([
                'status' => false,
                'message' => 'Hospital not found.',
            ], 404);
        }

        if ($diagnostic->image) {
            $imagePath = public_path('uploads/diagnostics/' . $diagnostic->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $diagnostic->delete();

        return response()->json([
            'status' => true,
            'message' => 'Diagnostic Center deleted successfully.',
        ], 200);
    }
}
