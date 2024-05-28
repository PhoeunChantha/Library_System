<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\BorrowDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {

        // Fetch all books with their catalog relationships
        $books = Book::with('catalog')->get();
        $totalItems = $books->count();

        // Fetch all borrow details
        $borrowDetails = BorrowDetail::all();

        // Fetch the selected book codes from BorrowDetail
        $selectedBookCodes = $borrowDetails->pluck('book_ids');

        return view('Backends.Books.index', compact('books', 'totalItems', 'selectedBookCodes', 'borrowDetails'));
    }

    public function create()
    {
        $catalogs = Catalog::all()->pluck('CatalogName', 'CatalogId');
        return view('Backends.Books.create', compact('catalogs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BookCode' => [
                'required',
                'unique:books,BookCode',
                'max:60',
                function ($attribute, $value, $fail) {
                    if (!str_starts_with($value, 'BK')) {
                        $fail('The ' . $attribute . ' must start with "BK".');
                    }
                }
            ],
            'CatalogId' => 'required|exists:catalogs,CatalogId',
            'BookImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'BookDescription' => 'nullable|string|max:60',
            //  'IsHidden' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $Book = new Book();
            $Book->BookCode = $request->input('BookCode');
            $Book->CatalogId = $request->input('CatalogId');
            if ($request->hasFile('BookImage')) {
                $image = $request->file('BookImage');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $Book->BookImage = $imageName;
            }
            $Book->BookDescription = $request->input('BookDescription');
            $Book->IsHidden = '1';

            $Book->save();
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (Exception $ex) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return redirect()->route('book.index')->with($output);
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $catalogs = Catalog::all();
        return view('Backends.Books.edit', compact('book', 'catalogs'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'BookCode' => [
                'required',
                'unique:books,BookCode',
                'max:60',
                function ($attribute, $value, $fail) {
                    if (!str_starts_with($value, 'BK')) {
                        $fail('The ' . $attribute . ' must start with "BK".');
                    }
                }
            ],
            'CatalogId' => 'required|exists:catalogs,CatalogId',
            'BookImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'BookDescription' => 'nullable|string|max:60',
            //  'IsHidden' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $book = Book::findOrFail($id);
            $book->BookCode = $request->input('BookCode');
            $book->CatalogId = $request->input('CatalogId');

            // Check if a new image is uploaded
            if ($request->hasFile('BookImage')) {
                // Delete the old image if it exists
                if ($book->BookImage) {
                    $oldImagePath = public_path('images/' . $book->BookImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Delete the old image file
                    }
                }

                // Upload and save the new image
                $image = $request->file('BookImage');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $book->BookImage = $imageName;
            }

            $book->BookDescription = $request->input('BookDescription');
            //  $book->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;

            $book->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Updated successfully')
            ];
            return redirect()->route('book.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('book.index')->with($output);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Find the book by its ID
            $book = Book::findOrFail($id);

            // Delete the associated image file if it exists
            if ($book->BookImage) {
                $imagePath = public_path('images/' . $book->BookImage);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file from the server
                }
            }

            // Delete the book
            $book->delete();

            DB::commit();

            // Redirect back to the book index page with a success message
            $output = [
                'success' => 1,
                'msg' => __('Book deleted successfully.')
            ];
            return redirect()->route('book.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('book.index')->with($output);
        }
    }

    public function show($id)
    {
        // $book = Book::with('catalog')->findOrFail($id);
        $book = Book::findOrFail($id);
        $books = Book::with('catalog')->get();
        return view('Backends.Books.show', compact('book'));
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $book = Book::findOrFail($request->id);
            $book->IsHidden = $request->IsHidden;
            $book->save();

            $output = ['IsHidden' => 1, 'msg' => __('Update data successfully')];

            DB::commit();
        } catch (Exception $e) {
            $output = ['IsHidden' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
