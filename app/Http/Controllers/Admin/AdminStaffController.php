<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class AdminStaffController extends Controller //implements HasMiddleware
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
        $roles = Role::orderBy('name', 'ASC')->get();
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $admins = Admin::latest()->paginate(25);
        return view('modules.Users.AdminList',[
            'admins' => $admins,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|min:4|string|max:255',
                'email' => 'required|email|unique:admins,email|max:255',
                'password' => 'required|min:8|confirmed',
                'role' => 'required|not_in:null,',
                'phone' => 'nullable|regex:/^[0-9]+$/',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Create and save the new Admin record
            $admin = new Admin();
            $admin->name = $validated['name'];
            $admin->email = $validated['email'];
            $admin->password = Hash::make($validated['password']);
            $admin->role = $validated['role'];
            $admin->phone = $validated['phone'] ?? null;

            // Handle image upload if provided
            // if ($request->hasFile('image')) {
            //     // Delete old image if it exists
            //     if ($admin->image) {
            //         $oldImagePath = public_path('uploads/admins/' . $admin->image);
            //         if (File::exists($oldImagePath)) {
            //             File::delete($oldImagePath);
            //         }
            //     }

            //     // Upload new image
            //     $image = $request->file('image');
            //     $imageName = time() . '.' . $image->getClientOriginalExtension();
            //     $image->move(public_path('uploads/admins'), $imageName);
            //     $admin->image = $imageName;
            // }

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($admin->image) {
                    $oldImagePath = public_path('uploads/admins/' . $admin->image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                // Upload new image
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('uploads/admins/' . $imageName);

                // Initialize Image Manager
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);

                // Resize while maintaining aspect ratio
                $img->resize(592, 744);

                // Reduce image size to 100 KB
                $quality = 90; // Start with high quality
                do {
                    ob_start(); // Start output buffering
                    $img->save($imagePath, $quality); // Save image with current quality
                    $imageSize = ob_get_length(); // Get the image size
                    ob_end_clean(); // End output buffering

                    $quality -= 5; // Reduce quality by 5
                } while ($imageSize > 100 * 1024 && $quality > 10); // Repeat until under 100 KB or quality reaches 10

                // Save final optimized image
                $img->save($imagePath, $quality);

                // Save filename in database
                $admin->image = $imageName;
            }


            $admin->save();
            $admin->syncRoles($request->role);
            flash()->success('New staff member added successfully.');
            return redirect()->back();

        } catch (ValidationException $e) {
            flash()->error('Failed to add new staff member.');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function update($id, Request $request, Admin $admins)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4|string|max:255',
            'email' => 'required|lowercase|email|max:255|unique:admins,email,'.$id.',id',
            'role' => 'required|not_in:null,',
            'phone' => 'nullable|regex:/^[0-9]+$/',
            'status' => 'string|in:Active,Deactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update staff member.');
            return redirect()->back()->withErrors($validator);
        }


        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role = $request->role;
        $admin->phone = $request->phone ?? null;
        $admin->status = $request->status ? 'Active' : 'Deactive';

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            if ($admin->image) {
                $oldImagePath = public_path('uploads/admins/' . $admin->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/admins/' . $imageName);
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(592, 744);
            $quality = 90;
            do {
                ob_start();
                $img->save($imagePath, $quality);
                $imageSize = ob_get_length();
                ob_end_clean();

                $quality -= 5;
            } while ($imageSize > 100 * 1024 && $quality > 10);

            $img->save($imagePath, $quality);
            $admin->image = $imageName;
        }


        $admin->save();
        $admin->syncRoles($request->role);
        flash()->success('' . $admin->name . ' updated successfully.');
        return redirect()->back();
    }

    public function update_password($id, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update password.');
        }

        $admin = Admin::findOrFail($id);
        $admin->password = Hash::make($request->password);
        $admin->save();
        flash()->success('Password updated successfully.');
        return back();
    }

    public function destroy(Request $request, Admin $admins)
    {
        $id = $request->id;
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.',
            ], 404);
        }

        if ($admin->image) {
            $imagePath = public_path('uploads/admins/' . $admin->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }


        $admin->delete();

        flash()->success('User deleted successfully.');
        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully.',
        ], 200);
    }
}
