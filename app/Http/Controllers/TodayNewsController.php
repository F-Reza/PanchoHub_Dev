<?php

namespace App\Http\Controllers;

use App\Models\TodayNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TodayNewsController extends Controller
{
    public function index()
    {
        $newsToday = TodayNews::with('user')->latest()->paginate(25);
        return view('modules.TodayNews.TodayNewsList',[
            'newsToday' => $newsToday
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string|max:255',
            'discription' => 'required|min:4|string|max:255',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new today news.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $todayNews = new TodayNews();
        $todayNews->user_id = Auth::user()->id;
        $todayNews-> title = $request->title;
        $todayNews-> discription = $request->discription;
        $todayNews-> upazila = $request->upazila;
        $todayNews-> address = $request->address?? null;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/todayNews');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($todayNews->image) {
                $oldImagePath = public_path('uploads/todayNews/' . $todayNews->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/todayNews/' . $imageName);

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
            $todayNews->image = $imageName;
        }

        $todayNews->save();

        flash()->success('TodayNews added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, TodayNews $todayNews)
    {
        $todayNews = TodayNews::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string|max:255',
            'discription' => 'required|min:4|string|max:255',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update today news.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $todayNews->user_id = Auth::user()->id;
        $todayNews-> title = $request->title;
        $todayNews-> discription = $request->discription;
        $todayNews-> upazila = $request->upazila;
        $todayNews-> address = $request->address?? null;
        $todayNews->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/todayNews');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($todayNews->image) {
                $oldImagePath = public_path('uploads/todayNews/' . $todayNews->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/todayNews/' . $imageName);

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
            $todayNews->image = $imageName;
        }

        $todayNews->save();

        flash()->success('TodayNews updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, TodayNews $todayNews)
    {
        $id = $request->id;
        $todayNews = TodayNews::find($id);

        if (!$todayNews) {
            return response()->json([
                'status' => false,
                'message' => 'TodayNews not found.',
            ], 404);
        }

        if ($todayNews->image) {
            $imagePath = public_path('uploads/todayNews/' . $todayNews->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $todayNews->delete();
        flash()->success('TodayNews deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'TodayNews deleted successfully.',
        ], 200);
    }
}
