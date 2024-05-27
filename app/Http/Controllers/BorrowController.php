<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Customer;
use App\Models\Librarian;
use App\Models\BorrowDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BorrowController extends Controller
{
    //  public function index()
    // {
    //     $borrowdetail = BorrowDetail::where('BorrowDetailId')->get();
    //     // Decode book_ids
    //     $bookIdsArray = json_decode($borrowdetail->book_ids, true);

    //     // Fetch books
    //     $books = Book::whereIn('BookId', $bookIdsArray)->get();

    //     $borrowdetails = BorrowDetail::all();
    //     $borrows = Borrow::all();
    //     $customers = Customer::all();
    //     $librarians = Librarian::all();
    //     $totalBorrows = count($borrows);
    //     $borrows = Borrow::with('customer')->get();
    //     $borrows = Borrow::with('librarian')->get();
    //     return view('Backends.Borrows.index', compact(
    //         'borrows',
    //         'customers',
    //         'librarians',
    //         'totalBorrows',
    //         'borrowdetails',
    //         'books'
    //     ));
    // }
    public function index()
    {
        // Fetch all BorrowDetails
        $borrowdetails = BorrowDetail::all();

        // Initialize an array to store books
        $books = collect();

        // Iterate over each BorrowDetail to get book IDs and fetch corresponding books
        foreach ($borrowdetails as $borrowdetail) {
            // Decode book_ids
            $bookIdsArray = json_decode($borrowdetail->book_ids, true);

            // Fetch books for the current BorrowDetail and merge into the $books collection
            $books = $books->merge(Book::whereIn('BookId', $bookIdsArray)->get());
        }

        // Fetch other necessary data
        $borrows = Borrow::with(['customer', 'librarian'])->get();
        $customers = Customer::all();
        $librarians = Librarian::all();
        $totalBorrows = $borrows->count();


        // Return view with compacted data
        return view('Backends.Borrows.index', compact(
            'borrows',
            'customers',
            'librarians',
            'totalBorrows',
            'borrowdetails',
            'books'
        ));
    }



    public function create()
    {
        $books = Book::all();
        $borrows = Borrow::all();
        $customers = Customer::all();
        $librarians = Librarian::all();
        $borrowedBookIds = BorrowDetail::where('IsReturn', '1')->pluck('book_ids')->flatten()->unique()->toArray();
        $books = Book::where('IsHidden', 1)
            ->whereNotIn('BookId', $borrowedBookIds)
            ->get();
        return view('Backends.Borrows.create', compact('books', 'borrows', 'customers', 'librarians'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'CustomerId' => 'required|exists:customers,CustomerId',
            'LibrarianId' => 'required|exists:librarians,LibrarianId',
            'BorrowDate' => 'required|date',
            'BorrowCode' => 'required|max:60',
            'Depositamount' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'Duedate' => 'required|date',
            'FineAmount' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'Emmo' => 'nullable|max:100',
            // 'IsHidden' => 'nullable|boolean',

        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $borrow = new Borrow();
            $borrow->BorrowId = $request->BorrowId;
            $borrow->CustomerId = $request->input('CustomerId');
            $borrow->LibrarianId = $request->input('LibrarianId');
            $borrow->BorrowDate = $request->input('BorrowDate');
            $borrow->BorrowCode = $request->BorrowCode;
            $borrow->Depositamount = $request->input('Depositamount');
            $borrow->Duedate = $request->input('Duedate');
            $borrow->FineAmount = $request->input('FineAmount');
            $borrow->Emmo = $request->input('Emmo');
            $borrow->IsHidden = '1';
            $borrow->save();

            // Create a new BorrowDetail instance and save it
            $borrowDetail = new BorrowDetail();
            $borrowDetail->BorrowId = $borrow->BorrowId;
            $borrowDetail->IsReturn = $request->input('IsReturn');
            $borrowDetail->ReturnDate = $request->input('ReturnDate');
            $borrowDetail->Note = $request->input('Note');

            // Convert book_ids to JSON
            $bookIds = $request->input('book_ids');
            $borrowDetail->book_ids = json_encode($bookIds);

            // Save the BorrowDetail instance
            $borrowDetail->save();


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

        return redirect()->route('borrow.index')->with($output);
    }
    public function edit($id)
    {
        $books = Book::all();
        $borrows = Borrow::all();
        $customers = Customer::all();
        $librarians = Librarian::all();
        $borrow = Borrow::findOrFail($id);

        return view('Backends.Borrows.edit', compact('customers', 'books', 'borrows', 'borrow', 'librarians'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'CustomerId' => 'required|exists:customers,CustomerId',
            'LibrarianId' => 'required|exists:librarians,LibrarianId',
            'BorrowDate' => 'required|date',
            'BorrowCode' => 'required|max:60',
            'Depositamount' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'Duedate' => 'required|date',
            'FineAmount' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'Emmo' => 'nullable|max:100',
            //   'IsHidden' => 'nullable|boolean'
        ]);

        try {
            DB::beginTransaction();

            $borrow = Borrow::findOrFail($id);
            $borrow->CustomerId = $request->input('CustomerId');
            $borrow->LibrarianId = $request->input('LibrarianId');
            $borrow->BorrowDate = $request->input('BorrowDate');
            $borrow->BorrowCode = $request->input('BorrowCode');
            $borrow->Depositamount = $request->input('Depositamount');
            $borrow->Duedate = $request->input('Duedate');
            $borrow->FineAmount = $request->input('FineAmount');
            $borrow->Emmo = $request->input('Emmo');
            //   $borrow->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;
            $borrow->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Updated successfully')
            ];
            return redirect()->route('borrow.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('borrow.index')->with($output);
        }
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $borrow = Borrow::findOrFail($id);
            $borrow->delete();

            DB::commit();

            // Redirect back to the borrow index page with a success message
            $output = [
                'success' => 1,
                'msg' => __('Borrow deleted successfully.')
            ];
            return redirect()->route('borrow.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('borrow.index')->with($output);
        }
    }

    public function show($id)
    {
        $borrow = Borrow::findOrFail($id);
        $data = Borrow::with('customer')->get();
        $data = Borrow::with('librarian')->get();
        return view('Backends.Borrows.show', compact('borrow'));
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $borrow = Borrow::findOrFail($request->id);
            $borrow->IsHidden = $request->IsHidden;
            $borrow->save();

            $output = ['IsHidden' => 1, 'msg' => __('Hidden data successfully')];

            DB::commit();
        } catch (Exception $e) {
            $output = ['IsHidden' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
