<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller //implements HasMiddleware
{


    // public static function middleware(): array
    // {
    //    return [
    //     new Middleware('permission:view roles', only: ['index']),
    //     new Middleware('permission:edit roles', only: ['edit']),
    //     new Middleware('permission:create roles', only: ['create']),
    //     new Middleware('permission:delete roles', only: ['destroy']),
    //    ];
    // }

    public function index() {
        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        return view('admin.roles.list',[
            'roles' => $roles
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:roles|min:3'
        ]);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name]);

            if(!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            flash()->success('Role added successfully.');
            return redirect()->back();
        } else {
            flash()->error(' Role not added. Validation error.');
            return redirect()->back()->withInput()->withErrors($validator);
        }

    }

    public function getPermissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions->pluck('name');
        return response()->json(['permissions' => $permissions]);
    }

    public function update($id, Request $request) {

        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:roles,name,'.$id.',id'
        ]);

        if ($validator->passes()) {
            $role->name = $request->name;
            $role->save();

            if(!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            } else {
                $role->syncPermissions([]);
            }
            flash()->success(' Role updated successfully.');
            return redirect()->back();
        } else {
            flash()->error(' Role not updated. Validation error.');
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request){

        $id = $request->id;
        $role = Role::find($id);

        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found.',
            ], 404);
        }

        $role->delete();
        flash()->success('Role deleted successfully.');
        return response()->json([
            'status' => true,
            'message' => 'Role deleted successfully.',
        ], 200);

    }



}
