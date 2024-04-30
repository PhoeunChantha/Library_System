<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LibrarianController extends Controller
{

    public function index(Request $request){

        $query_param = [];

        $librarians = Librarian::when($request->has('search'), function ($query) use ($request) {
            $key = explode(' ', $request['search']);
            $query->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('LibrarianName', 'like', "%{$value}%")
                        ->orWhere('LibrarianId', 'like', "%{$value}%");
                }
            });
        })->get();

        $query_param = $request->has('search') ? ['search' => $request['search']] : [];

        $librarians = Librarian::all();
        return view('Tables.Librarians.index',compact('librarians','query_param'));
    }
    public function create(){
        return view('Tables.Librarians.create');
    }
    public function store(Request $request){
        try{
            $request->validate([
                'LibrarianName'=>'required|max:50',
                'Sex'=>'required|max:50',
                'Dob'=>'nullable',
                'Pob'=>'nullable',
                'Phone'=>'nullable',
                'IsHidden'=>'nullable|boolean'
            ]);
            $librarians = new Librarian();
            $librarians->LibrarianName=$request->input('LibrarianName');
            $librarians->Sex=$request->input('Sex');
            $librarians->Dob=$request->input('Dob');
            $librarians->Pob=$request->input('Pob');
            $librarians->Phone=$request->input('Phone');
            $librarians->IsHidden=$request->input('IsHidden');
            $librarians->save();
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
        }
        return redirect()->route('librarian.index')->with('status','Librarian Created Successfully');
    }
    public function edit($id){
        $librarian = Librarian::findOrFail($id);
        return view('Tables.Librarians.edit',compact('librarian'));
    }
    public function update(Request $request,$id){
        try{
            $request->validate([
                'LibrarianName'=>'required|max:50',
                'Sex'=>'required|max:50',
                'Dob'=>'nullable',
                'Pob'=>'nullable',
                'Phone'=>'nullable',
                'IsHidden'=>'nullable|boolean'
            ]);
            $librarians = Librarian::findOrFail($id);
            $librarians->LibrarianName=$request->input('LibrarianName');
            $librarians->Sex=$request->input('Sex');
            $librarians->Dob=$request->input('Dob');
            $librarians->Pob=$request->input('Pob');
            $librarians->Phone=$request->input('Phone');
            $librarians->IsHidden=$request->input('IsHidden');
            $librarians->save();
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
        }
        return redirect()->route('librarian.index')->with('status','Librarian updated Successfully');
    }
    public function destroy($id){
        $librarian = Librarian::findOrFail($id);
        $librarian->delete();
        return redirect()->route('librarian.index')->with('status','Librarian deleted Successfully');
    }
}
