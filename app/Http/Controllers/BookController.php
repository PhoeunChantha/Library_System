<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('catalog')->get();
        return view('Backends.Books.index', compact('books',));
    }
    public function create()
    {
        $catalogs = Catalog::all()->pluck('CatalogName', 'CatalogId');
        return view('Backends.Books.create', compact('catalogs'));
    }
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'BookName' => 'required|string|max:60',
    //         'BookCode' => 'required|string|max:60',
    //         'CatalogId' => 'required|exists:catalogs,CatalogId',
    //         'BookImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'BookDescription' => 'required|string|max:60',
    //         'IsHidden' => 'nullable|boolean'
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput()
    //             ->with(['success' => 0, 'msg' => __('Invalid form input')]);
    //     }
    //     try {
    //         $Book = new Book();
    //         $Book->BookName = $request->input('BookName');
    //         $Book->BookCode = $request->input('BookCode');
    //         $Book->CatalogId = $request->input('CatalogId');
    //         if ($request->hasFile('BookImage')) {
    //             $image = $request->file('BookImage');
    //             $imageName = time() . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('images'), $imageName);
    //             $Book->BookImage = $imageName;
    //         }
    //         $Book->BookDescription = $request->input('BookDescription');
    //         $Book->IsHidden = $request->input('IsHidden');


    //         $Book->save();
    //         DB::commit();
    //         $output = [
    //             'success' => 1,
    //             'msg' => __('Created successfully')
    //         ];
    //     } catch (Exception $ex) {
    //         dd($ex);
    //         DB::rollBack();
    //         $output = [
    //             'success' => 0,
    //             'msg' => __('Something went wrong')
    //         ];
    //         // Log::error($ex->getMessage());
    //         // return response()->json(['message' => $ex->getMessage()], 500);
    //     }
    //     //return Redirect()->route('book.index')->with('status', 'Book Created Successfully');
    //     return Redirect()->route('book.index')->with($output);
    // }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BookName' => 'required|string|max:60',
            'BookCode' => 'required|string|max:60',
            'CatalogId' => 'required|exists:catalogs,CatalogId',
            'BookImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'BookDescription' => 'nullable|string|max:60',
            'IsHidden' => 'nullable|boolean'
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
            $Book->BookName = $request->input('BookName');
            $Book->BookCode = $request->input('BookCode');
            $Book->CatalogId = $request->input('CatalogId');
            if ($request->hasFile('BookImage')) {
                $image = $request->file('BookImage');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $Book->BookImage = $imageName;
            }
            $Book->BookDescription = $request->input('BookDescription');
            $Book->IsHidden = $request->input('IsHidden', 0);

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
        // Validate the incoming request data
        $request->validate([
            'BookName' => 'required|string|max:255',
            'BookCode' => 'required|string|max:255',
            'CatalogId' => 'required|exists:catalogs,CatalogId',
            'BookImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'BookDescription' => 'nullable|string',
            'IsHidden' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $book = Book::findOrFail($id);
            $book->BookName = $request->input('BookName');
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
            $book->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;

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
        $book = Book::findOrFail($id);
        $books = Book::with('catalog')->get();
        return view('Backends.Books.show', compact('book'));
    }
}
