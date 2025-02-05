<?php

namespace App\Http\Controllers;

use App\Models\HouseRent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HouseRentController extends Controller
{
        public function index()
    {
        $houseRents = HouseRent::with('user')->latest()->paginate(25);
        return view('modules.HouseRents.HouseRentList',[
            'houseRents' => $houseRents
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'area' => 'required|min:1|string',
            'number_of_rooms' => 'required|min:1|string',
            'number_of_bath' => 'required|min:1|string',
            'rent_amount' => 'required|min:1|string',
            'facilities' => 'required|min:4|string',
            'rent_available' => 'required|min:1|string',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new HouseRent.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $houseRent = new HouseRent();
        $houseRent->user_id = Auth::user()->id;
        $houseRent-> category = $request->category;
        $houseRent-> area = $request->area;
        $houseRent-> number_of_rooms = $request->number_of_rooms;
        $houseRent-> number_of_bath = $request->number_of_bath;
        $houseRent-> rent_amount = $request->rent_amount;
        $houseRent-> facilities = $request->facilities;
        $houseRent-> rent_available = $request->rent_available;
        $houseRent-> contact = $request->contact;
        $houseRent-> upazila = $request->upazila;
        $houseRent-> address = $request->address;
        $houseRent-> others_info = $request->others_info?? null;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/houseRents');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($houseRent->image) {
                $oldImagePath = public_path('uploads/houseRents/' . $houseRent->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/houseRents/' . $imageName);

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
            $houseRent->image = $imageName;
        }

        $houseRent->save();

        flash()->success('New HouseRent added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, HouseRent $houseRent)
    {
        $houseRent = HouseRent::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'area' => 'required|min:1|string',
            'number_of_rooms' => 'required|min:1|string',
            'number_of_bath' => 'required|min:1|string',
            'rent_amount' => 'required|min:1|string',
            'facilities' => 'required|min:4|string',
            'rent_available' => 'required|min:1|string',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update HouseRent.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $houseRent-> category = $request->category;
        $houseRent-> area = $request->area;
        $houseRent-> number_of_rooms = $request->number_of_rooms;
        $houseRent-> number_of_bath = $request->number_of_bath;
        $houseRent-> rent_amount = $request->rent_amount;
        $houseRent-> facilities = $request->facilities;
        $houseRent-> rent_available = $request->rent_available;
        $houseRent-> contact = $request->contact;
        $houseRent-> upazila = $request->upazila;
        $houseRent-> address = $request->address;
        $houseRent-> others_info = $request->others_info?? null;
        $houseRent->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/houseRents');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($houseRent->image) {
                $oldImagePath = public_path('uploads/houseRents/' . $houseRent->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/houseRents/' . $imageName);

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
            $houseRent->image = $imageName;
        }

        $houseRent->save();
        flash()->success('HouseRent updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, HouseRent $houseRent)
    {
        $id = $request->id;
        $houseRent = HouseRent::find($id);

        if (!$houseRent) {
            return response()->json([
                'status' => false,
                'message' => 'HouseRent not found.',
            ], 404);
        }

        if ($houseRent->image) {
            $imagePath = public_path('uploads/houseRents/' . $houseRent->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $houseRent->delete();
        flash()->success('HouseRent deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'HouseRent deleted successfully.',
        ], 200);
    }
}
