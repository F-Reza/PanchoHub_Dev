<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller //implements HasMiddleware
{


    // public static function middleware(): array
    // {
    //    return [
    //     new Middleware('permission:view permissions', only: ['index']),
    //     new Middleware('permission:edit permissions', only: ['edit']),
    //     new Middleware('permission:create permissions', only: ['create']),
    //     new Middleware('permission:delete permissions', only: ['destroy']),
    //    ];
    // }


    public function index() {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(15);
        return view('permissions.list',[
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            flash()->success('Permission added successfully.');
            return redirect()->back();
        } else {
            flash()->error(' Permission not added. Validation error.' );
            return redirect()->back()->withErrors($validator);
        }

    }

    public function update($id, Request $request) {
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id'
        ]);

        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->save();

            flash()->success('Permission updated successfully.');
            return redirect()->back();
        } else {
            flash()->error(' Permission not updated. Validation error.');
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request){

        $id = $request->id;
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Permission not found.',
            ], 404);
        }

        $permission->delete();
        flash()->success('Permission deleted successfully.');
        return response()->json([
            'status' => true,
            'message' => 'Permission deleted successfully.',
        ], 200);

    }




}
