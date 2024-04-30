<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        $catalogs = Catalog::all();
        $books = Book::with('catalog')->get();
        return view('Tables.Books.index',compact('catalogs','books'));
    }
    public function create(){
        $catalogs = Catalog::all();
        return view('Tables.Books.create',compact('catalogs'));
    }
    public function store(Request $request){
        try{
            $request->validate([
                'BookName' => 'required|string|max:60',
                'BookCode' => 'required|string|max:60',
                'CatalogId' => 'required|exists:catalogs,CatalogId',
                'BookImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'BookDescription' => 'nullable|string|max:60',
                'IsHidden' => 'nullable|boolean'
            ]);
            $Book = new Book();
            $Book->BookName =$request->input('BookName');
            $Book->BookCode = $request->input('BookCode');
            $Book->CatalogId = $request->input('CatalogId');
            if ($request->hasFile('BookImage')) {
                $image = $request->file('BookImage');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $Book->BookImage = $imageName;
            }
            $Book->BookDescription = $request->input('BookDescription');
            $Book->IsHidden = $request->input('IsHidden');
            $Book->save();
            return Redirect()->route('book.index')->with('status','Book Created Successfully');

        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
    public function edit($id){
        $book = Book::findOrFail($id);
        $catalogs = Catalog::all();
        return view('Tables.Books.edit',compact('book','catalogs'));
    }
    public function update(Request $request,$id){
        try{
        $book = Book::findOrFail($id);
        $book->BookName =$request->input('BookName');
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
        $book->IsHidden = $request->input('IsHidden');
        $book->save();
        return Redirect()->route('book.index')->with('status','Book Updated Successfully');
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }

    }
    public function destroy($id){
        try {
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

            // Redirect back to the book index page with a success message
            return redirect()->route('book.index')->with('status', 'Book deleted successfully.');
        } catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
    public function show($id){
        $book = Book::findOrFail($id);
        $books = Book::with('catalog')->get();
        return view('Tables.Books.show',compact('book'));
    }

}
