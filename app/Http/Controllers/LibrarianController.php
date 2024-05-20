<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LibrarianController extends Controller
{
    public function index()
    {
       $librarians = Librarian::all();
        return view('Backends.Librarians.index',compact('librarians'));
    }
    public function create()
    {

        return view('Backends.Librarians.create');
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'LibrarianName' => 'required|max:50',
                'Sex' => 'required|max:50',
                'Dob' => 'nullable',
                'Pob' => 'nullable',
                'Phone' => 'nullable',
                'IsHidden' => 'nullable|boolean'
            ]);
            $librarians = new Librarian();
            $librarians->LibrarianName = $request->input('LibrarianName');
            $librarians->Sex = $request->input('Sex');
            $librarians->Dob = $request->input('Dob');
            $librarians->Pob = $request->input('Pob');
            $librarians->Phone = $request->input('Phone');
            $librarians->IsHidden = $request->input('IsHidden');
            $librarians->save();
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
        return redirect()->route('librarian.index')->with('status', 'Librarian Created Successfully');
    }
    public function edit($id)
    {
        $librarian = Librarian::findOrFail($id);
        return view('Backends.Librarians.edit', compact('librarian'));
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'LibrarianName' => 'required|max:50',
                'Sex' => 'required|max:50',
                'Dob' => 'nullable',
                'Pob' => 'nullable',
                'Phone' => 'nullable',
                'IsHidden' => 'nullable|boolean'
            ]);
            $librarians = Librarian::findOrFail($id);
            $librarians->LibrarianName = $request->input('LibrarianName');
            $librarians->Sex = $request->input('Sex');
            $librarians->Dob = $request->input('Dob');
            $librarians->Pob = $request->input('Pob');
            $librarians->Phone = $request->input('Phone');
            $librarians->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;
            $librarians->save();
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
        return redirect()->route('librarian.index')->with('status', 'Librarian updated Successfully');
    }
    public function destroy($id)
    {
        $librarian = Librarian::findOrFail($id);
        $librarian->delete();
        return redirect()->route('librarian.index')->with('status', 'Librarian deleted Successfully');
    }
    public function show($id){
        $librarian = Librarian::findOrFail($id);
        return view('Backends.Librarians.show',compact('librarian'));
    }
}
