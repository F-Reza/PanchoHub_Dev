<?php

namespace App\Http\Controllers;

use App\Models\PlotSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PlotSalesController extends Controller
{

    public function index()
    {
        $plotSales = PlotSales::with('user')->latest()->paginate(25);
        return view('modules.PlotSales.PlotSaleList',[
            'plotSales' => $plotSales
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'title' => 'required|min:4|string',
            'area' => 'required|min:4|string',
            'sale_price' => 'required|min:1|string',
            'details' => 'required|min:4|string',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new PlotSale.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $plotSale = new PlotSales();
        $plotSale->user_id = Auth::user()->id;
        $plotSale-> category = $request->category;
        $plotSale-> title = $request->title;
        $plotSale-> area = $request->area;
        $plotSale-> sale_price = $request->sale_price;
        $plotSale-> details = $request->details;
        $plotSale-> contact = $request->contact;
        $plotSale-> upazila = $request->upazila;
        $plotSale-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/plotSales');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($plotSale->image) {
                $oldImagePath = public_path('uploads/plotSales/' . $plotSale->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/plotSales/' . $imageName);

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
            $plotSale->image = $imageName;
        }

        $plotSale->save();

        flash()->success('New PlotSale added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, PlotSales $plotSales)
    {
        $plotSale = PlotSales::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'title' => 'required|min:4|string',
            'area' => 'required|min:4|string',
            'sale_price' => 'required|min:1|string',
            'details' => 'required|min:4|string',
            'contact' => 'required|regex:/^[0-9]+$/',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:4|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update PlotSale.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $plotSale-> category = $request->category;
        $plotSale-> title = $request->title;
        $plotSale-> area = $request->area;
        $plotSale-> sale_price = $request->sale_price;
        $plotSale-> details = $request->details;
        $plotSale-> contact = $request->contact;
        $plotSale-> upazila = $request->upazila;
        $plotSale-> address = $request->address;
        $plotSale->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/plotSales');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($plotSale->image) {
                $oldImagePath = public_path('uploads/plotSales/' . $plotSale->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/plotSales/' . $imageName);

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
            $plotSale->image = $imageName;
        }

        $plotSale->save();
        flash()->success('PlotSale updated successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, PlotSales $plotSales)
    {
        $id = $request->id;
        $plotSale = PlotSales::find($id);

        if (!$plotSale) {
            return response()->json([
                'status' => false,
                'message' => 'PlotSale not found.',
            ], 404);
        }

        if ($plotSale->image) {
            $imagePath = public_path('uploads/plotSales/' . $plotSale->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $plotSale->delete();
        flash()->success('PlotSale deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'PlotSale deleted successfully.',
        ], 200);
    }
}
