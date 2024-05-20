<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    public function index(){
        $data['customertypes']=CustomerType::all();
        return view('Backends.Customertypes.index',$data);
    }
    public function create(){
        return view('Backends.Customertypes.Create');
    }
    public function store(Request $request){
        $request->validate([
            'CustomerTypeName' => 'required|max:50',
        ]);
        $customertypes = new CustomerType();
        $customertypes -> CustomerTypeName = $request->input('CustomerTypeName');
        $customertypes->save();
        return redirect()->route('customertype.index')->with('status','CustomerType Created Successfully');
    }
    public function destroy(Request $request,$id){
        $customertypes = CustomerType::findOrFail($id);
        $customertypes->delete($request->all());
        return redirect()->route('customertype.index')->with('status','CustomerType deleted Successfully');
    }
}
