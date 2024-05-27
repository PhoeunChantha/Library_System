<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Catalog;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all();
        return view('Backends.Catalogs.index', compact('catalogs'));
    }
    public function create()
    {
        return view('Backends.Catalogs.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'CatalogCode' => 'required|max:60',
            'CatalogName' => 'required|max:500',
            'Isbn' => 'nullable|max:60',
            'AuthorName' => 'required|max:50',
            'Publisher' => 'required|max:50',
            'PublishYear' => 'required|max:50',
            'PublisheDition' => 'required|max:60',
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
            $catalog = new Catalog();
            $catalog->CatalogCode = $request->input('CatalogCode');
            $catalog->CatalogName = $request->input('CatalogName');
            $catalog->Isbn = $request->input('Isbn');
            $catalog->AuthorName = $request->input('AuthorName');
            $catalog->Publisher = $request->input('Publisher');
            $catalog->PublishYear = $request->input('PublishYear');
            $catalog->PublisheDition = $request->input('PublisheDition');
            $catalog->IsHidden = '1';
            $catalog->save();
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
        return redirect()->route('catalog.index')->with($output);
    }
    public function edit($id)
    {
        $data['catalogs'] = Catalog::findOrFail($id);
        return view('Backends.Catalogs.edit', $data);
    }
    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $catalogs = Catalog::findOrFail($id);
            $catalogs->CatalogCode = $request->input('CatalogCode');
            $catalogs->CatalogName = $request->input('CatalogName');
            $catalogs->Isbn = $request->input('Isbn');
            $catalogs->AuthorName = $request->input('AuthorName');
            $catalogs->Publisher = $request->input('Publisher');
            $catalogs->PublishYear = $request->input('PublishYear');
            $catalogs->PublisheDition = $request->input('PublisheDition');
            //   $catalogs->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;
            $catalogs->save();
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Updated successfully')
            ];
            return redirect()->route('catalog.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('catalog.index')->with($output);
        }
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $catalogs = Catalog::findOrFail($id);
            $catalogs->delete();

            DB::commit();

            // Redirect back to the borrow index page with a success message
            $output = [
                'success' => 1,
                'msg' => __('Deleted successfully.')
            ];
            return redirect()->route('catalog.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('catalog.index')->with($output);
        }
    }
    public function show($id)
    {
        $catalog = Catalog::findOrFail($id); // Retrieve the catalog item by its ID
        return view('Backends.Catalogs.show', compact('catalog')); // Pass the catalog item to the view
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $catalog = Catalog::findOrFail($request->id);
            $catalog->IsHidden = $request->IsHidden;
            $catalog->save();

            $output = ['IsHidden' => 1, 'msg' => __('Update data successfully')];

            DB::commit();
        } catch (Exception $e) {
            $output = ['IsHidden' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
