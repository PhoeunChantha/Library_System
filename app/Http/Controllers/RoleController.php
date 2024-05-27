<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
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
    public function index()
    {
        $roles = Role::get();
        return view('Backends.role-permission.role.index', [
            'roles' => $roles
        ]);
    }
    public function create()
    {

        return view('Backends.role-permission.role.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name']
        ]);
        try {
            DB::beginTransaction();

            Role::create([
                'name' => $request->name
            ]);
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (Exception $ex) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }
        return redirect('roles')->with($output);
    }

    public function edit(Role $role)
    {

        return view('Backends.role-permission.role.edit', [
            'role' => $role
        ]);
    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $role->id]
        ]);

        try {
            DB::beginTransaction();
            $role->update([
                'name' => $request->name
            ]);
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Updated successfully')
            ];
            return redirect('roles')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect('roles')->with($output);
        }
    }
    public function destroy($roleId)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($roleId);
            $role->delete();
            DB::commit();

            // Redirect back to the book index page with a success message
            $output = [
                'success' => 1,
                'msg' => __('Deleted successfully.')
            ];
            return redirect('roles')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect('roles')->with($output);
        }
    }
    public function AddPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolepermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('Backends.role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolepermissions' => $rolepermissions
        ]);
    }
    public function UpdatePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status', 'Permissions add to role');
    }
}
