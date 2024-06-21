<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Librarian;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        // $users = User::with(['librarian' => function ($query) {
        //     $query->withDefault(['LibrarianName' => 'No Librarian']);
        // }])->get();
        $users = User::get();
        return view('Backends.role-permission.user.index', [
            'users' => $users

        ]);
    }
    public function create()
    {

        $roles = Role::pluck('name', 'name')->all();
        return view('Backends.role-permission.user.create', [
            'roles' => $roles

        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|max:20|unique:users,password',
            'roles' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }
        try {
            DB::beginTransaction();

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
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('User created successfully')
            ];
        } catch (Exception $ex) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }
        return redirect('/users')->with($output);
    }
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        // // Decrypt the password
        //  $decryptedPassword = Crypt::decrypt($user->password);
        // $userRoles = $user->roles->pluck('name','name')->all();
        return view('Backends.role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            // 'userRoles'=>$userRoles

        ]);
    }
    public function update(Request $request, User $user)
    {
        if ($user->hasRole('super-admin')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'nullable|string|min:8|max:20',
                'roles' => 'required|array', // Make sure roles is an array
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }
        try {
            DB::beginTransaction();

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
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('User updated successfully')
            ];
            return redirect()->route('/users')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('/users')->with($output);
        }
    }
    public function destroy($userId)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($userId);
             $user->delete();

            DB::commit();

            // Redirect back to the book index page with a success message
            $output = [
                'success' => 1,
                'msg' => __('User deleted successfully.')
            ];
            return redirect()->route('/users')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('/users')->with($output);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $user->Status = $request->Status;
            $user->save();

            $output = ['Status' => 1, 'msg' => __(' Update successfully')];

            DB::commit();
        } catch (Exception $e) {
            $output = ['Status' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
