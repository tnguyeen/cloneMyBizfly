<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        foreach ($roles as &$role) {
            $result = [];
            $arrayPer = str_split($role->permission);
            $permissions = Permission::all();
            foreach ($permissions as &$permission) {
                if(in_array($permission->id, $arrayPer)){
                    array_push($result, $permission->name);
                }
            }
            $role->permission = $result;
        }
        return view('role.list')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $role = Role::create([
                'name' => $request->name,'permission' => $request->permission
            ]
        );
        return response()->json([
                'result' => true,
                'message' => 'Created!',
            ]);
    }

    public function getCreate()
    {   
        $permissions = Permission::all();
        return view('role.create')->with(compact( 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Role $role)
    {
        $role =  Role::findOrFail($request->id);
        if($role){
            $role->name = $request->name;
            $role->permission = $request->permission;
            $role->save();
            return response()->json([
                'result' => true,
                'message' => 'Updated!',
            ]);
        }
        return "Khoong tim thay nguoi dung!";
    }

    public function getEdit(Request $request)
    {   
        $role =  Role::findOrFail($request->id);
        if($role){
            $result = [];
            $curPermission = str_split($role->permission);
            $permissions = Permission::all();
            foreach ($permissions as &$permission) {
                if(in_array($permission->id, $curPermission)){
                    array_push($result, $permission->id);
                }
            }
            return view('role.edit')->with(compact('role', 'permissions', 'result'));
        }
        return "Khoong tim thay nguoi dung!";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Role $role)
    {
        $role =  Role::findOrFail($request->id);
        if($role){
            $role->delete();
            return response()->json([
                'result' => true,
                'message' => 'Deleted!',
            ]);
        }
        return "Khoong tim thay nguoi dung!";
    }
}
