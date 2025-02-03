<?php

namespace App\Http\Controllers;

use App\Models\VehicleRent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VehicleRentController extends Controller
{
    public function index()
    {
        $vehicleRents = VehicleRent::with('user')->latest()->paginate(25);
        return view('modules.VehicleRent.VehicleRentList',[
            'vehicleRents' => $vehicleRents
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'category' => 'required|not_in:null,',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new VehicleRent.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $vehicleRent = new VehicleRent();
        $vehicleRent->user_id = Auth::user()->id;
        $vehicleRent-> title = $request->title;
        $vehicleRent-> category = $request->category;
        $vehicleRent-> capacity = $request->capacity?? null;
        $vehicleRent-> facilities = $request->facilities?? null;
        $vehicleRent-> driver_name = $request->driver_name?? null;
        $vehicleRent-> contact = $request->contact?? null;
        $vehicleRent-> upazila = $request->upazila;
        $vehicleRent-> address = $request->address?? null;
        $vehicleRent-> others_info = $request->others_info?? null;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/vehicleRents');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($vehicleRent->image) {
                $oldImagePath = public_path('uploads/vehicleRents/' . $vehicleRent->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/vehicleRents/' . $imageName);

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
            $vehicleRent->image = $imageName;
        }

        $vehicleRent->save();

        flash()->success('New VehicleRent added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, VehicleRent $vehicleRent)
    {
        $vehicleRent = VehicleRent::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string',
            'category' => 'required|not_in:null,',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update VehicleRent.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $vehicleRent-> title = $request->title;
        $vehicleRent-> category = $request->category;
        $vehicleRent-> capacity = $request->capacity?? null;
        $vehicleRent-> facilities = $request->facilities?? null;
        $vehicleRent-> driver_name = $request->driver_name?? null;
        $vehicleRent-> contact = $request->contact?? null;
        $vehicleRent-> upazila = $request->upazila;
        $vehicleRent-> address = $request->address?? null;
        $vehicleRent-> others_info = $request->others_info?? null;
        $vehicleRent->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/vehicleRents');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($vehicleRent->image) {
                $oldImagePath = public_path('uploads/vehicleRents/' . $vehicleRent->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/vehicleRents/' . $imageName);

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
            $vehicleRent->image = $imageName;
        }

        $vehicleRent->save();
        flash()->success('VehicleRent updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, VehicleRent $vehicleRent)
    {
        $id = $request->id;
        $vehicleRent = VehicleRent::find($id);

        if (!$vehicleRent) {
            return response()->json([
                'status' => false,
                'message' => 'VehicleRent not found.',
            ], 404);
        }

        if ($vehicleRent->image) {
            $imagePath = public_path('uploads/vehicleRents/' . $vehicleRent->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $vehicleRent->delete();
        flash()->success('VehicleRent deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'VehicleRent deleted successfully.',
        ], 200);
    }
}
