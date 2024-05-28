<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class BorrowDetailController extends Controller
{

    public function index()
    {
        $books = Book::all();
        $borrowdetails = BorrowDetail::with(['borrow', 'book', 'catalog'])->get();
        return view('Backends.BorrowDetails.index', compact('books', 'borrowdetails'));
    }


    public function show($id)
    {
        $borrowdetail = BorrowDetail::findOrFail($id);

        // Decode book_ids
        $bookIdsArray = json_decode($borrowdetail->book_ids, true);

        // Fetch books
        $books = Book::whereIn('BookId', $bookIdsArray)->get();

        return view('Backends.BorrowDetails.show', compact('borrowdetail', 'books'));
    }


    public function create()
    {
        $borrows = Borrow::all();
        $books = Book::where('IsHidden', '!=', 0)->get();
        return view('Backends.BorrowDetails.create', compact('borrows', 'books'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BorrowId' => 'required|exists:borrows,BorrowId',
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,BookId',
            'ReturnDate' => 'nullable|date',
            'Note' => 'nullable|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $borrow = new BorrowDetail();
            $borrow->BorrowId = $request->input('BorrowId');
            $borrow->IsReturn = '1';
            $borrow->ReturnDate = $request->input('ReturnDate');
            $borrow->Note = $request->input('Note');

            // Convert book_ids to JSON
            $bookIds = $request->input('book_ids');
            $borrow->book_ids = json_encode($bookIds);

            // Save the BorrowDetail instance
            $borrow->save();

            // Commit transaction
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (Exception $ex) {
            // Rollback transaction in case of failure
            DB::rollBack();

            // Log error message
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('borrow.index')->with($output);
    }


    public function edit($id)
    {
        $borrowdetail = BorrowDetail::with('catalog')->get();
        $borrows = Borrow::all();
        $books = Book::all();
        $borrowdetail = BorrowDetail::findOrFail($id);
        return view('Backends.BorrowDetails.edit', compact('borrowdetail', 'borrows', 'books'));
    }
    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();
            $borrowdetail = BorrowDetail::findOrFail($id);
            // $borrowdetail->BorrowId = $request->input('BorrowId');
            $borrowdetail->Note = $request->input('Note');
            $borrowdetail->IsReturn = $request->input('IsReturn');
            $borrowdetail->ReturnDate = $request->input('ReturnDate');

            $bookIds = $request->input('book_ids');
            $borrowdetail->book_ids = is_array($bookIds) ? json_encode($bookIds) : json_encode([$bookIds]);

            $borrowdetail->save();
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

            // Find the book by its ID
            $borrowdetail = BorrowDetail::findOrFail($id);
            // Delete the book
            $borrowdetail->delete();
            DB::commit();

            // Redirect back to the book index page with a success message
            $output = [
                'success' => 1,
                'msg' => __('BorrowDetail deleted successfully.')
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
}
