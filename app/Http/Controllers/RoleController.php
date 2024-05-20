<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->Middleware('permission:view user',['only'=>['index']]);
    //     $this->Middleware('permission:create user',['only'=>['create','store']]);
    //     $this->Middleware('permission:update user',['only'=>['update','edit']]);
    //     $this->Middleware('permission:delete user',['only'=>['destroy']]);
    //     //
    // }
    public function index(){
        $roles = Role::get();
        return view('Backends.role-permission.role.index',[
            'roles' => $roles
        ]);
    }
    public function create(){

        return view('Backends.role-permission.role.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required','string','unique:roles,name']
        ]);
        Role::create([
           'name'=> $request->name
        ]);
        return redirect('roles')->with('status','Role Created Successfully');
    }
    public function edit(Role $role){

        return view('Backends.role-permission.role.edit',[
            'role' => $role
        ]);

    }
    public function update(Request $request,Role $role){
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,'.$role->id]
        ]);
        $role->update([
            'name'=> $request->name
         ]);
         return redirect('roles')->with('status','Role updated Successfully');
    }
    public function destroy($roleId){
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status','Role deleted Successfully');
    }
    public function AddPermissionToRole($roleId){
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolepermissions = DB::table('role_has_permissions')
                            ->where('role_has_permissions.role_id',$role->id)
                            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                            ->all();
        return view('Backends.role-permission.role.add-permissions',[
            'role' => $role,
            'permissions' => $permissions,
            'rolepermissions' => $rolepermissions
        ]);
    }
    public function UpdatePermissionToRole(Request $request,$roleId){
        $request->validate([
            'permission' => 'required'
        ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status','Permissions add to role');
    }
}
