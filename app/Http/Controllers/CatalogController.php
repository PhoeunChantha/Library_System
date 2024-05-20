<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Catalog;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CatalogController extends Controller
{
    public function index(){
        $catalogs = Catalog::all();
        return view('Backends.Catalogs.index',compact('catalogs'));
    }
    public function create(){
        return view('Backends.Catalogs.create');
    }
    public function store(Request $request){
        try {
            $request->validate([
                'CatalogCode' => 'required|max:60',
                'CatalogName' => 'required|max:500',
                'Isbn' => 'required|max:60',
                'AuthorName' => 'required|max:50',
                'Publisher' => 'required|max:50',
                'PublishYear' => 'nullable|max:50',
                'PublisheDition' => 'nullable|max:60',
                'IsHidden' => 'nullable|boolean'
            ]);

            $catalog = new Catalog();
            $catalog->CatalogCode = $request->input('CatalogCode');
            $catalog->CatalogName = $request->input('CatalogName');
            $catalog->Isbn = $request->input('Isbn');
            $catalog->AuthorName = $request->input('AuthorName');
            $catalog->Publisher = $request->input('Publisher');
            $catalog->PublishYear = $request->input('PublishYear');
            $catalog->PublisheDition = $request->input('PublisheDition');
            $catalog->IsHidden = $request->input('IsHidden');
            $catalog->save();

            return redirect()->route('catalog.index')->with('status', 'Catalog created successfully');
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }

    }
    public function edit($id){
        $data['catalogs'] = Catalog::findOrFail($id);
        return view('Backends.Catalogs.edit',$data);
    }
    public function update(Request $request,$id){
        try{
            $catalogs = Catalog::findOrFail($id);
            $catalogs->CatalogCode = $request->input('CatalogCode');
            $catalogs->CatalogName = $request->input('CatalogName');
            $catalogs->Isbn = $request->input('Isbn');
            $catalogs->AuthorName = $request->input('AuthorName');
            $catalogs->Publisher = $request->input('Publisher');
            $catalogs->PublishYear = $request->input('PublishYear');
            $catalogs->PublisheDition = $request->input('PublisheDition');
            $catalogs->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;
            $catalogs->save();
            return redirect()->route('catalog.index')->with('status', 'Catalog Updated successfully');
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
    public function destroy($id){
        $catalogs = Catalog::findOrFail($id);
        $catalogs->delete();
        return redirect()->route('catalog.index')->with('status', 'Catalog deleted successfully');
    }
    public function show($id){
        $catalog = Catalog::findOrFail($id); // Retrieve the catalog item by its ID
        return view('Backends.Catalogs.show', compact('catalog')); // Pass the catalog item to the view
    }
}
