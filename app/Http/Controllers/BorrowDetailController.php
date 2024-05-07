<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Exception;
use App\Models\BorrowDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class BorrowDetailController extends Controller
{
    public function index()
    {
        $borrowdetails = BorrowDetail::all();
        $data = BorrowDetail::with('borrow')->get();
        $data = BorrowDetail::with('book')->get();
        return view('Tables.BorrowDetails.index', compact('borrowdetails'));
    }
    public function create()
    {
        $borrows = Borrow::all();
        $books = Book::all();
        return view('Tables.BorrowDetails.create', compact('borrows', 'books'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'BorrowId' => 'required|exists:borrows,BorrowId',
                'book_ids' => 'required|exists:books,BookId',
                'Note' => 'nullable|max:500',
                'IsReturn' => 'required|boolean',
                'ReturnDate' => 'nullable|date'
            ]);

            $borrow = new BorrowDetail();
            $borrow->BorrowId = $request->input('BorrowId');

            $borrow->Note = $request->input('Note');
            $borrow->IsReturn = $request->input('IsReturn');
            $borrow->ReturnDate = $request->input('ReturnDate');

            $bookIds = $request->input('book_ids');
            if (is_array($bookIds)) {
                $borrow->book_ids = json_encode($bookIds);
            } else {
                $borrow->book_ids = $bookIds;
            }
            $borrow->save();
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }

        return redirect()->route('borrowdetail.index')->with('status', 'BorrowDetail created successfully.');
    }

    public function edit($id)
    {
        $borrows = Borrow::all();
        $books = Book::all();
        $borrowdetail = BorrowDetail::findOrFail($id);
        return view('Tables.BorrowDetails.edit', compact('borrowdetail','borrows','books'));
    }
    public function update(Request $request, $id)
    {
        $borrowdetail = BorrowDetail::findOrFail($id);
        $borrowdetail->BorrowId = $request->input('BorrowId');
        $borrowdetail->Note = $request->input('Note');
        $borrowdetail->IsReturn = $request->input('IsReturn');
        $borrowdetail->ReturnDate = $request->input('ReturnDate');

        $bookIds = $request->input('book_ids');
        $borrowdetail->book_ids = is_array($bookIds) ? json_encode($bookIds) : json_encode([$bookIds]);

        $borrowdetail->save();

        return redirect()->route('borrowdetail.index')->with('status', 'BorrowDetail updated successfully.');
    }

    public function destroy($id)
    {
        $borrowdetail = BorrowDetail::findOrFail($id);
        $borrowdetail->delete();
        return redirect()->route('borrowdetail.index')->with('status', 'BorrowDetail deleted successfully.');
    }
}
