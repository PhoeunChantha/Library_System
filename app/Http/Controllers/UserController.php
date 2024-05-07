<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('role-permission.user.index', [
            'users' => $users
        ]);
    }
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('role-permission.user.create', [
            'roles' => $roles
        ]);
    }
    public function store(Request $request)
    {
        // try{
        //     $request->validate([
        //         'name' => 'required|string|max:255',
        //         'email' => 'required|email|max:255|unique:users,email',
        //         'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //         'password' => 'required|string|min:8|max:20',
        //         'roles' => 'required'
        //     ]);
        //     $user = new User();

        //     if ($request->hasFile('profile')) {
        //         $image = $request->file('profile');
        //         $imageName = time() . '.' . $image->getClientOriginalExtension();
        //         $image->move(public_path('P_images'), $imageName);
        //         $user->profile = $imageName;
        //     }

        //     $user = User::create([
        //         'name'=>$request->name,
        //         'email'=>$request->email,

        //         'password'=>Hash::make($request->password),
        //     ]);
        //     $user->syncRoles($request->roles);
        // }catch(Exception $ex){
        //     Log::error($ex->getMessage());
        //     return response()->json(['message' => $ex->getMessage()], 500);
        // }
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'required|string|min:8|max:20',
                'roles' => 'required'
            ]);

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('P_images'), $imageName);
                $user->profile = $imageName;
            }

            $user->password = Hash::make($request->input('password'));

            $user->save();

            $user->syncRoles($request->roles);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }
        return redirect('/users')->with('status', 'User created sucessfully with roles');
    }
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        // // Decrypt the password
        //  $decryptedPassword = Crypt::decrypt($user->password);
        // $userRoles = $user->roles->pluck('name','name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            // 'userRoles'=>$userRoles

        ]);
    }
    public function update(Request $request, User $user)
    {

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'nullable|string|min:8|max:20',
                'roles' => 'required|array', // Make sure roles is an array
            ]);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // Check if a new image is uploaded
            if ($request->hasFile('profile')) {
                // Delete the old image if it exists
                if ($user->profile) {
                    $oldImagePath = public_path('P_images/' . $user->profile);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Delete the old image file
                    }
                }

                // Upload and save the new image
                $image = $request->file('profile');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('P_images'), $imageName);
                $user->profile = $imageName;
            }

            // Check if a new image is uploaded and update profile field
            if (isset($imageName)) {
                $data['profile'] = $imageName;
            }

            // Check if password is provided and update it
            if (!empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            }

            // Update user data
            $user->update();

            // Sync user roles
            if ($request->has('roles')) {
                $user->syncRoles($request->roles);
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['message' => 'Error updating user'], 500);
        }
        return redirect('/users')->with('status', 'User updated successfully with roles');
    }
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('/users')->with('status', 'User Deleted sucessfully with roles');
    }
}
