<?php

namespace App\Http\Controllers;

use App\Models\Entrepreneurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EntrepreneursController extends Controller
{
    public function index()
    {
        $entrepreneurs = Entrepreneurs::with('user')->latest()->paginate(25);
        return view('modules.Entrepreneurs.EntrepreneurList',[
            'entrepreneurs' => $entrepreneurs
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'services' => 'required|min:4|string',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new Entrepreneur.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $entrepreneur = new Entrepreneurs();
        $entrepreneur->user_id = Auth::user()->id;
        $entrepreneur-> name = $request->name;
        $entrepreneur-> contact = $request->contact?? null;
        $entrepreneur-> email = $request->email?? null;
        $entrepreneur-> fb_page_name = $request->fb_page_name?? null;
        $entrepreneur-> page_link = $request->page_link?? null;
        $entrepreneur-> services = $request->services;
        $entrepreneur-> upazila = $request->upazila;
        $entrepreneur-> address = $request->address?? null;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/entrepreneurs');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($entrepreneur->image) {
                $oldImagePath = public_path('uploads/entrepreneurs/' . $entrepreneur->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/entrepreneurs/' . $imageName);

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
            $entrepreneur->image = $imageName;
        }

        $entrepreneur->save();

        flash()->success('New Entrepreneur added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, Entrepreneurs $entrepreneurs)
    {
        $entrepreneur = Entrepreneurs::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|string',
            'contact' => 'nullable|regex:/^[0-9]+$/',
            'services' => 'required|min:4|string',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Entrepreneur.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $entrepreneur-> name = $request->name;
        $entrepreneur-> contact = $request->contact?? null;
        $entrepreneur-> email = $request->email?? null;
        $entrepreneur-> fb_page_name = $request->fb_page_name?? null;
        $entrepreneur-> page_link = $request->page_link?? null;
        $entrepreneur-> services = $request->services;
        $entrepreneur-> upazila = $request->upazila;
        $entrepreneur-> address = $request->address?? null;
        $entrepreneur->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/entrepreneurs');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($entrepreneur->image) {
                $oldImagePath = public_path('uploads/entrepreneurs/' . $entrepreneur->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/entrepreneurs/' . $imageName);

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
            $entrepreneur->image = $imageName;
        }

        $entrepreneur->save();
        flash()->success('Entrepreneur updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Entrepreneurs $entrepreneurs)
    {
        $id = $request->id;
        $entrepreneur = Entrepreneurs::find($id);

        if (!$entrepreneur) {
            return response()->json([
                'status' => false,
                'message' => 'Entrepreneur not found.',
            ], 404);
        }

        if ($entrepreneur->image) {
            $imagePath = public_path('uploads/entrepreneurs/' . $entrepreneur->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $entrepreneur->delete();
        flash()->success('Entrepreneur deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Entrepreneur deleted successfully.',
        ], 200);
    }
}
