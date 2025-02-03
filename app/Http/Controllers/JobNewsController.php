<?php

namespace App\Http\Controllers;

use App\Models\JobNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class JobNewsController extends Controller
{
    public function index()
    {
        $jobNewses = JobNews::with('user')->latest()->paginate(25);
        return view('modules.JobNews.JobNewsList',[
            'jobNewses' => $jobNewses
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'job_title' => 'required|min:4|string|max:255',
            'org_name' => 'required|min:2|string|max:255',
            'position' => 'required|min:2|string|max:255',
            'vacancy' => 'required|min:1|string|max:255',
            'education_qualify' => 'required|min:2|string|max:255',
            'experience' => 'required|min:2|string',
            'upazila' => 'required|not_in:null,',
            'contact' => 'required|regex:/^[0-9]+$/',
            'salary' => 'required|min:2|string|max:255',
            'dateline' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new job news.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $jobNews = new JobNews();
        $jobNews->user_id = Auth::user()->id;
        $jobNews-> job_title = $request->job_title;
        $jobNews-> org_name = $request->org_name;
        $jobNews-> position = $request->position;
        $jobNews-> vacancy = $request->vacancy;
        $jobNews-> education_qualify = $request->education_qualify;
        $jobNews-> experience = $request->experience;
        $jobNews-> upazila = $request->upazila;
        $jobNews-> address = $request->address?? null;
        $jobNews-> contact = $request->contact;
        $jobNews-> email = $request->email?? null;
        $jobNews-> others_info = $request->others_info?? null;
        $jobNews-> salary = $request->salary;
        $jobNews-> dateline = $request->dateline;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/jobNews');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($jobNews->image) {
                $oldImagePath = public_path('uploads/jobNews/' . $jobNews->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/jobNews/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(150, 150);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $jobNews->image = $imageName;
        }

        $jobNews->save();

        flash()->success('JobNews added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, JobNews $jobNews)
    {
        $jobNews = JobNews::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'job_title' => 'required|min:4|string|max:255',
            'org_name' => 'required|min:2|string|max:255',
            'position' => 'required|min:2|string|max:255',
            'vacancy' => 'required|min:1|string|max:255',
            'education_qualify' => 'required|min:2|string|max:255',
            'experience' => 'required|min:2|string',
            'upazila' => 'required|not_in:null,',
            'contact' => 'required|regex:/^[0-9]+$/',
            'salary' => 'required|min:2|string|max:255',
            'dateline' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update job news.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $jobNews-> job_title = $request->job_title;
        $jobNews-> org_name = $request->org_name;
        $jobNews-> position = $request->position;
        $jobNews-> vacancy = $request->vacancy;
        $jobNews-> education_qualify = $request->education_qualify;
        $jobNews-> experience = $request->experience;
        $jobNews-> upazila = $request->upazila;
        $jobNews-> address = $request->address?? null;
        $jobNews-> contact = $request->contact;
        $jobNews-> email = $request->email?? null;
        $jobNews-> others_info = $request->others_info?? null;
        $jobNews-> salary = $request->salary;
        $jobNews-> dateline = $request->dateline;
        $jobNews->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/jobNews');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($jobNews->image) {
                $oldImagePath = public_path('uploads/jobNews/' . $jobNews->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/jobNews/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(150, 150);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $jobNews->image = $imageName;
        }

        $jobNews->save();

        flash()->success('JobNews updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, JobNews $jobNews)
    {
        $id = $request->id;
        $jobNews = JobNews::find($id);

        if (!$jobNews) {
            return response()->json([
                'status' => false,
                'message' => 'JobNews not found.',
            ], 404);
        }

        if ($jobNews->image) {
            $imagePath = public_path('uploads/todayNews/' . $jobNews->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $jobNews->delete();
        flash()->success('JobNews deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'JobNews deleted successfully.',
        ], 200);
    }
}
