<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Borrow;
use App\Models\Customer;
use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BorrowController extends Controller
{
    public function index(){
        $borrows = Borrow::all();
        $customers = Customer::all();
        $librarians = Librarian::all();
        $totalBorrows = count($borrows);
        $borrows = Borrow::with('customer')->get();
        $borrows = Borrow::with('librarian')->get();
        return view('Tables.Borrows.index',compact('borrows','customers','librarians','totalBorrows'));
    }
    public function create(){
        $customers = Customer::all();
        $librarians = Librarian::all();
        return view('Tables.Borrows.create',compact('customers','librarians'));
    }
    public function store(Request $request){
        try {
            $request->validate([
                'CustomerId' => 'required|exists:customers,CustomerId',
                'LibrarianId' => 'required|exists:librarians,LibrarianId',
                'BorrowDate' => 'required|date',
                'BorrowCode' => 'required|max:60',
                'Depositamount' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
                'Duedate' => 'required|date',
                'FineAmount' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
                'Emmo' => 'nullable|max:100',
                'IsHidden' => 'nullable|boolean'
            ]);

            $borrow = new Borrow();
            $borrow->CustomerId = $request->input('CustomerId');
            $borrow->LibrarianId = $request->input('LibrarianId');
            $borrow->BorrowDate = $request->input('BorrowDate');
            $borrow->BorrowCode = $request->input('BorrowCode');
            $borrow->Depositamount = $request->input('Depositamount');
            $borrow->Duedate = $request->input('Duedate');
            $borrow->FineAmount = $request->input('FineAmount');
            $borrow->Emmo = $request->input('Emmo');
            $borrow->IsHidden = $request->input('IsHidden');
            $borrow->save();
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }

        return redirect()->route('borrow.index')->with('status', 'Borrow created successfully.');

    }
    public function edit($id){
        $customers = Customer::all();
        $librarians = Librarian::all();
        $borrow = Borrow::findOrFail($id);

        return view('Tables.Borrows.edit',compact('customers','borrow','librarians'));
    }
    public function update(Request $request,$id){
        $borrows = Borrow::findOrFail($id);
        $borrows->CustomerId = $request->input('CustomerId');
        $borrows->LibrarianId = $request->input('LibrarianId');
        $borrows->BorrowDate = $request->input('BorrowDate');
        $borrows->BorrowCode = $request->input('BorrowCode');
        $borrows->Depositamount = $request->input('Depositamount');
        $borrows->Duedate = $request->input('Duedate');
        $borrows->FineAmount = $request->input('FineAmount');
        $borrows->Emmo = $request->input('Emmo');
        $borrows->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;
        $borrows->save();
        return redirect()->route('borrow.index')->with('status', 'Borrow updated successfully.');
    }
    public function destroy($id){
        $borrow = Borrow::findOrFail($id);
        $borrow->delete();
        return redirect()->route('borrow.index')->with('status', 'Borrow deleted successfully.');

    }
    public function show($id){
        $borrow = Borrow::findOrFail($id);
        $data = Borrow::with('customer')->get();
        $data = Borrow::with('librarian')->get();
        return view('Tables.Borrows.show',compact('borrow'));

    }
}
