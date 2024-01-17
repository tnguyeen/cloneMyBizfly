<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\EditUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);
        if(!($request->role_id || $request->name) ){
            $users = User::all();
            foreach ($users as &$user) {
                $roles = Role::all();
                foreach ($roles as &$role) {
                    if($role->id == $user->role_id){
                        $user->role_id = $role->name;
                    }
                }
            }
            return view('user.list')->with(compact('users', 'roles'));
        }
        else{
            $users = User::where('role_id', $request->role_id)->where('name', 'like', '%' . $request->name . '%')->get();
            foreach ($users as &$user) {
                $roles = Role::all();
                foreach ($roles as &$role) {
                    if($role->id == $user->role_id){
                        $user->role_id = $role->name;
                    }
                }
            }
            return view('user.list')->with(compact('users', 'roles'));
        }
    }

    public function getEdit(Request $request, User $user)
    {   
        $this->authorize('update', $user);
        $user =  User::findOrFail($request->id);
        if($user){
            $roles = Role::all();
            return view('user.edit')->with(compact('user','roles'));
        }
        return "Khoong tim thay nguoi dung!";
    }

    public function edit(EditUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user =  User::findOrFail($request->id);
        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role;
            // $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'result' => true,
                'message' => 'Updated!',
            ]);
        }
        return "Khoong tim thay nguoi dung!";
    }

    public function getCreate( User $user)
    {   
        $this->authorize('create', $user);
        $roles = Role::all();
        return view('user.create')->with(compact('roles'));
    }

    public function create(EditUserRequest $request, User $user)
    {
        $this->authorize('create', $user);
        $user = User::create([
                'name' => $request->name,'email' => $request->email,'password' => $request->password,'role_id' => $request->role
            ]
        );
        return response()->json([
                'result' => true,
                'message' => 'Created!',
            ]);
    }

    public function editPassword(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $user =  User::findOrFail($request->id);
        if($user){
            if(Hash::check($request->password, $user->password)){
                $user->password = Hash::make($request->newPassword);
            }
            else{
                return response()->json([
                    'result' => false,
                    'message' => 'Nhập sai mật khẩu!',
                ]);
            }
            $user->save();
            return response()->json([
                'result' => true,
                'message' => 'Updated!',
            ]);
        }
        return "Khoong tim thay nguoi dung!";
    }

    public function delete(Request $request, User $user)
    {
        $this->authorize('delete', $user);
        $user =  User::findOrFail($request->id);
        if($user){
            $user->delete();
            return response()->json([
                'result' => true,
                'message' => 'Deleted!',
            ]);
        }
        return "Khoong tim thay nguoi dung!";
    }
}
