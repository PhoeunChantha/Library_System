<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::get();
        return view('Backends.role-permission.permission.index',[
            'permissions' => $permissions
        ]);
    }
    public function create(){

        return view('Backends.role-permission.permission.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required','string','unique:permissions,name']
        ]);
        try {
            DB::beginTransaction();

            Permission::create([
                'name'=> $request->name
             ]);
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Permission created successfully')
            ];
        } catch (Exception $ex) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }
        return redirect('permissions')->with($output);
    }
    public function edit(Permission $permission){

        return view('Backends.role-permission.permission.edit',[
            'permission' => $permission
        ]);

    }
    public function update(Request $request,Permission $permission){
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name,'.$permission->id]
        ]);
        try {
            DB::beginTransaction();
            $permission->update([
                'name'=> $request->name
             ]);
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Permission updated successfully')
            ];
            return redirect('permissions')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect('permissions')->with($output);
        }
    }
    public function destroy($permissionId){
        try {
            DB::beginTransaction();
            $permission = Permission::find($permissionId);
            $permission->delete();
            DB::commit();

            // Redirect back to the book index page with a success message
            $output = [
                'success' => 1,
                'msg' => __('Permission deleted successfully.')
            ];
            return redirect('permissions')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect('permissions')->with($output);
        }
    }

}
