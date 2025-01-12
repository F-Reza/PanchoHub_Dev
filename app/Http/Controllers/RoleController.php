<?php

namespace App\Http\Controllers;

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


    //This method will show role page
    public function index() {
        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        return view('roles.list',[
            'roles' => $roles
        ]);
    }

    //This method will show create role page
    public function create() {

        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create',[
            'permissions' => $permissions
        ]);
    }

    //This method will insert a role in DB
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:roles|min:3'
        ]);

        if ($validator->passes()) {
            //dd($request->permission);
            $role = Role::create(['name' => $request->name]);

            if(!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success', 'Role added successfully.');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }

    }

    //This method will show edit role page
    public function edit($id) {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();
        //dd($hasPermissions);
        return view('roles.edit',[
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }

    //This method will update role page
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
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } else {
            return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);
        }
    }

    //This method will delete role in DB
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

        return response()->json([
            'status' => true,
            'message' => 'Role deleted successfully.',
        ], 200);

    }



}
