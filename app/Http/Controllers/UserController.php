<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller //implements HasMiddleware
{


    // public static function middleware(): array
    // {
    //    return [
    //     new Middleware('permission:view users', only: ['index']),
    //     new Middleware('permission:edit users', only: ['edit']),
    //     new Middleware('permission:create users', only: ['create']),
    //     new Middleware('permission:delete users', only: ['destroy']),
    //    ];
    // }

    public function index()
    {
        $users = User::latest()->paginate(25);
        return view('modules.Users.UserList',[
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4',
            'phone' => 'required|regex:/^[0-9]+$/|unique:users,phone',
            'profession' => 'required',
            'gender' => 'required',
            'upazila' => 'required|not_in:null,',
            'email' => 'lowercase|email|max:255',
            'password' => 'required|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new user.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = new User();
        $user-> name = $request->name;
        $user-> phone = $request->phone;
        $user-> email = $request->email?? null;
        $user-> profession = $request->profession;
        $user-> gender = $request->gender;
        $user-> upazila = $request->upazila;
        $user-> address = $request->address ?? null;
        $user-> subscription = $request->subscription ?? null;
        $user-> password = Hash::make($request->password);

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/users');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($user->image) {
                $oldImagePath = public_path('uploads/users/' . $user->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/users/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(450, 550);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $user->image = $imageName;
        }

        $user->save();

        flash()->success('New user added successfully.');
        return redirect()->back();

    }


    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4',
            // 'phone' => 'required|regex:/^[0-9]+$/|unique:users,phone,'.$id.',id',
            'profession' => 'required',
            'gender' => 'required',
            'upazila' => 'required|not_in:null,',
            'email' => 'lowercase|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update user.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user-> name = $request->name;
        // $user-> phone = $request->phone;
        $user-> email = $request->email?? null;
        $user-> profession = $request->profession;
        $user-> gender = $request->gender;
        $user-> upazila = $request->upazila;
        $user-> address = $request->address ?? null;
        $user-> subscription = $request->subscription ?? null;
        $user->status = $request->status ? 'Active' : 'Deactive';

        if ($request->hasFile('image')) {

            $directory = public_path('uploads/users');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            if ($user->image) {
                $oldImagePath = public_path('uploads/users/' . $user->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/users/' . $imageName);

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(450, 550);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $user->image = $imageName;
        }


        $user->save();
        flash()->success(' User updated successfully.');
        return redirect()->back();
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.',
            ], 404);
        }

        if ($user->image) {
            $imagePath = public_path('uploads/users/' . $user->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully.',
        ], 200);
    }
}
