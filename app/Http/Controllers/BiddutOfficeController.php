<?php

namespace App\Http\Controllers;

use App\Models\BiddutOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BiddutOfficeController extends Controller
{
    public function index()
    {
        $biddutOffices = BiddutOffice::latest()->paginate(25);
        return view('modules.BiddutOffice.BiddutOffice',[
            'biddutOffices' => $biddutOffices
        ]);
    }

    public function store(Request $request)
    {
        $biddutOffice = new BiddutOffice();
        $biddutOffice-> title = $request->title;
        $biddutOffice-> contact = $request->contact;
        $biddutOffice-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/biddutOffices');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($biddutOffice->image) {
                $oldImagePath = public_path('uploads/biddutOffices/' . $biddutOffice->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/biddutOffice/' . $imageName);

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
            $biddutOffice->image = $imageName;
        }

        $biddutOffice->save();

        flash()->success('Biddut Office added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, BiddutOffice $biddutOffice)
    {
        $biddutOffice = BiddutOffice::findOrFail($id);
        $biddutOffice-> title = $request->title;
        $biddutOffice-> contact = $request->contact;
        $biddutOffice-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/biddutOffices');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($biddutOffice->image) {
                $oldImagePath = public_path('uploads/biddutOffices/' . $biddutOffice->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/biddutOffices/' . $imageName);

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
            $biddutOffice->image = $imageName;
        }

        $biddutOffice->save();

        flash()->success('Biddut Office updated successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, BiddutOffice $biddutOffice)
    {
        $id = $request->id;
        $biddutOffice = BiddutOffice::find($id);

        if (!$biddutOffice) {
            return response()->json([
                'status' => false,
                'message' => 'Biddut Office not found.',
            ], 404);
        }

        if ($biddutOffice->image) {
            $imagePath = public_path('uploads/biddutOffices/' . $biddutOffice->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $biddutOffice->delete();
        flash()->success('Biddut Office deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Biddut Office deleted successfully.',
        ], 200);
    }
}
