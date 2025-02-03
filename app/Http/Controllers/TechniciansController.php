<?php

namespace App\Http\Controllers;

use App\Models\Technicians;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TechniciansController extends Controller
{
    public function index()
    {
        $technicians = Technicians::with('user')->latest()->paginate(25);
        return view('modules.Technicians.TechnicianList',[
            'technicians' => $technicians
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|string',
            'type' => 'required|min:2|string',
            'experience' => 'required|min:2|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new Technician.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $technician = new Technicians();
        $technician->user_id = Auth::user()->id;
        $technician-> name = $request->name;
        $technician-> type = $request->type;
        $technician-> experience = $request->experience;
        $technician-> contact = $request->contact?? null;
        $technician-> upazila = $request->upazila;
        $technician-> address = $request->address?? null;
        $technician-> others_info = $request->others_info?? null;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/technicians');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($technician->image) {
                $oldImagePath = public_path('uploads/technicians/' . $technician->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/technicians/' . $imageName);

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
            $technician->image = $imageName;
        }

        $technician->save();

        flash()->success('New Technician added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, Technicians $technicians)
    {
        $technician = Technicians::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|string|max:255',
            'type' => 'required|min:2|string|max:255',
            'experience' => 'required|min:2|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Technician.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $technician-> name = $request->name;
        $technician-> type = $request->type;
        $technician-> experience = $request->experience;
        $technician-> contact = $request->contact?? null;
        $technician-> upazila = $request->upazila;
        $technician-> address = $request->address?? null;
        $technician-> others_info = $request->others_info?? null;
        $technician->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/technicians');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($technician->image) {
                $oldImagePath = public_path('uploads/technicians/' . $technician->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/technicians/' . $imageName);

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
            $technician->image = $imageName;
        }

        $technician->save();
        flash()->success('Technician updated successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, Technicians $technicians)
    {
        $id = $request->id;
        $technician = Technicians::find($id);

        if (!$technician) {
            return response()->json([
                'status' => false,
                'message' => 'Technician not found.',
            ], 404);
        }

        if ($technician->image) {
            $imagePath = public_path('uploads/technicians/' . $technician->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $technician->delete();
        flash()->success('Technician deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Technician deleted successfully.',
        ], 200);
    }
}
