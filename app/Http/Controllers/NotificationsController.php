<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = Notifications::with('user')->latest()->paginate(25);
        return view('modules.Notifications.NotificationList',[
            'notifications' => $notifications
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
            flash()->error('Failed to add new notification.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $notifications = new Notifications();
        $notifications->user_id = Auth::user()->id;
        $notifications-> title = $request->title;
        $notifications-> discription = $request->discription;
        $notifications-> upazila = $request->upazila;
        $notifications-> address = $request->address?? null;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/notifications');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($notifications->image) {
                $oldImagePath = public_path('uploads/notifications/' . $notifications->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/notifications/' . $imageName);

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
            $notifications->image = $imageName;
        }

        $notifications->save();

        flash()->success('Notification added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Notifications $notifications)
    {
        $notifications = Notifications::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:4|string|max:255',
            'discription' => 'required|min:4|string|max:255',
            'upazila' => 'required|not_in:null,',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update notification.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $notifications->user_id = Auth::user()->id;
        $notifications-> title = $request->title;
        $notifications-> discription = $request->discription;
        $notifications-> upazila = $request->upazila;
        $notifications-> address = $request->address?? null;
        $notifications->status = $request->status;

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/notifications');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($notifications->image) {
                $oldImagePath = public_path('uploads/notifications/' . $notifications->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/notifications/' . $imageName);

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
            $notifications->image = $imageName;
        }

        $notifications->save();

        flash()->success('Notification updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Notifications $notifications)
    {
        $id = $request->id;
        $notification = Notifications::find($id);

        if (!$notifications) {
            return response()->json([
                'status' => false,
                'message' => 'Notifications not found.',
            ], 404);
        }

        if ($notification->image) {
            $imagePath = public_path('uploads/notifications/' . $notification->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $notification->delete();
        flash()->success('Notification deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Notification deleted successfully.',
        ], 200);
    }
}
