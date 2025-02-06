<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TeachersController extends Controller
{
    public function index()
    {
        $teachers = Teachers::with('user')->latest()->paginate(25);
        return view('modules.Teachers.TeacherList',[
            'teachers' => $teachers
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|string',
            'title' => 'required|min:2|string',
            'category' => 'required|not_in:null,',
            'contact' => 'required|regex:/^[0-9]+$/',
            'classess' => 'required|min:2|string',
            'subjects' => 'required|min:2|string',
            'time_period' => 'required|min:2|string',
            'gender' => 'required|not_in:null,',
            'salary' => 'required|min:2|string',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:2|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new Teacher.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $teacher = new Teachers();
        $teacher->user_id = Auth::user()->id;
        $teacher-> name = $request->name;
        $teacher-> title = $request->title;
        $teacher-> category = $request->category;
        $teacher-> contact = $request->contact;
        $teacher-> classess = $request->classess;
        $teacher-> subjects = $request->subjects;
        $teacher-> time_period = $request->time_period;
        $teacher-> gender = $request->gender;
        $teacher-> salary = $request->salary;
        $teacher-> upazila = $request->upazila;
        $teacher-> address = $request->address;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/teachers');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($teacher->image) {
                $oldImagePath = public_path('uploads/teachers/' . $teacher->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/teachers/' . $imageName);

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
            $teacher->image = $imageName;
        }

        $teacher->save();

        flash()->success('New Teacher added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, Teachers $teachers)
    {
        $teacher = Teachers::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|string',
            'title' => 'required|min:2|string',
            'category' => 'required|not_in:null,',
            'contact' => 'required|regex:/^[0-9]+$/',
            'classess' => 'required|min:2|string',
            'subjects' => 'required|min:2|string',
            'time_period' => 'required|min:2|string',
            'gender' => 'required|not_in:null,',
            'salary' => 'required|min:2|string',
            'upazila' => 'required|not_in:null,',
            'address' => 'required|min:2|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Teacher.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $teacher-> name = $request->name;
        $teacher-> title = $request->title;
        $teacher-> category = $request->category;
        $teacher-> contact = $request->contact;
        $teacher-> classess = $request->classess;
        $teacher-> subjects = $request->subjects;
        $teacher-> time_period = $request->time_period;
        $teacher-> gender = $request->gender;
        $teacher-> salary = $request->salary;
        $teacher-> upazila = $request->upazila;
        $teacher-> address = $request->address;
        $teacher->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/teachers');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            if ($teacher->image) {
                $oldImagePath = public_path('uploads/teachers/' . $teacher->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/teachers/' . $imageName);

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
            $teacher->image = $imageName;
        }

        $teacher->save();
        flash()->success('Teacher updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Teachers $teachers)
    {
        $id = $request->id;
        $teacher = Teachers::find($id);

        if (!$teacher) {
            return response()->json([
                'status' => false,
                'message' => 'Teacher not found.',
            ], 404);
        }

        if ($teacher->image) {
            $imagePath = public_path('uploads/teachers/' . $teacher->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $teacher->delete();
        flash()->success('Teacher deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Teacher deleted successfully.',
        ], 200);
    }
}
