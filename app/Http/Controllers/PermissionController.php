<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.list')->with(compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $permission = Permission::create([
                'name' => $request->name
            ]
        );
        return response()->json([
                'result' => true,
                'message' => 'Created!',
            ]);
    }

    public function getCreate()
    {   
        return view('permission.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $permission =  Permission::findOrFail($request->id);
        if($permission){
            $permission->name = $request->name;
            $permission->save();
            return response()->json([
                'result' => true,
                'message' => 'Updated!',
            ]);
        }
        return "Khoong tim thay nguoi dung!";
    }

    public function getEdit(Request $request)
    {   
        $permission =  Permission::findOrFail($request->id);
        if($permission){
            return view('permission.edit')->with(compact( 'permission'));
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
        $permission =  Permission::findOrFail($request->id);
        if($permission){
            $permission->delete();
            return response()->json([
                'result' => true,
                'message' => 'Deleted!',
            ]);
        }
        return "Khoong tim thay nguoi dung!";
    }
}
