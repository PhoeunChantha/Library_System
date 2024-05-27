<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LibrarianController extends Controller
{
    public function index()
    {
        $librarians = Librarian::all();
        return view('Backends.Librarians.index', compact('librarians'));
    }
    public function create()
    {
        return view('Backends.Librarians.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'LibrarianName' => 'required|max:50',
            'Sex' => 'required|max:50',
            'Dob' => 'nullable',
            'Pob' => 'nullable',
            'Phone' => 'required',
            //   'IsHidden' => 'nullable|boolean'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }
        try {
            DB::beginTransaction();
            $librarians = new Librarian();
            $librarians->LibrarianName = $request->input('LibrarianName');
            $librarians->Sex = $request->input('Sex');
            $librarians->Dob = $request->input('Dob');
            $librarians->Pob = $request->input('Pob');
            $librarians->Phone = $request->input('Phone');
            //  $librarians->IsHidden = $request->input('IsHidden');
            $librarians->save();
            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (Exception $ex) {
            // dd($ex);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }
        return redirect()->route('librarian.index')->with($output);
    }
    public function edit($id)
    {
        $librarian = Librarian::findOrFail($id);
        return view('Backends.Librarians.edit', compact('librarian'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'LibrarianName' => 'required|max:50',
            'Sex' => 'required|max:50',
            'Dob' => 'nullable',
            'Pob' => 'nullable',
            'Phone' => 'nullable',
            //  'IsHidden' => 'nullable|boolean'
        ]);
        try {
            DB::beginTransaction();
            $librarians = Librarian::findOrFail($id);
            $librarians->LibrarianName = $request->input('LibrarianName');
            $librarians->Sex = $request->input('Sex');
            $librarians->Dob = $request->input('Dob');
            $librarians->Pob = $request->input('Pob');
            $librarians->Phone = $request->input('Phone');
            //  $librarians->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;
            $librarians->save();
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Updated successfully')
            ];
            return redirect()->route('librarian.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('librarian.index')->with($output);
        }
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $librarian = Librarian::findOrFail($id);
            $librarian->delete();
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Deleted successfully.')
            ];
            return redirect()->route('librarian.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('librarian.index')->with($output);
        }
    }
    public function show($id)
    {
        $librarian = Librarian::findOrFail($id);
        return view('Backends.Librarians.show', compact('librarian'));
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $librarian = Librarian::findOrFail($request->id);
            $librarian->IsHidden = $request->IsHidden;
            $librarian->save();

            $output = ['IsHidden' => 1, 'msg' => __('Hidden updated successfully')];

            DB::commit();
        } catch (Exception $e) {
            $output = ['IsHidden' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
