<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(){
        $data['customers'] = Customer::all();
        $data['customertypes'] = CustomerType::all();
        $data['customers'] = Customer::with('customerType')->get();
        return view('Backends.Customers.index',$data);
    }
    public function create(){

        $data['customertypes'] = CustomerType::all();
        return view('Backends.Customers.create',$data);
    }
    public function store(Request $request){
        try{

            $request->validate([
                'CustomerCode' => 'required|max:500',
                'CustomerTypeId' => 'required|exists:customertypes,CustomerTypeId',
                'CustomerName' => 'required|max:50',
                'Sex' => 'nullable|max:50',
                'Dob' => 'nullable|date',
                'Pob' => 'nullable|max:50',
                'Phone' => 'nullable|max:50',
                'Address' => 'nullable|max:500',
                'IsHidden' => 'boolean'
            ]);

           $customers = new Customer();
           $customers->CustomerCode = $request->input('CustomerCode');
           $customers->CustomerTypeId = $request->input('CustomerTypeId');
           $customers->CustomerName = $request->input('CustomerName');
           $customers->Sex = $request->input('Sex');
           $customers->Dob = $request->input('Dob');
           $customers->Pob = $request->input('Pob');
           $customers->Phone = $request->input('Phone');
           $customers->Address = $request->input('Address');
           $customers->IsHidden = $request->input('IsHidden');
           $customers->save();
            return redirect()->route('customer.index')->with('status','Customer created successfully');
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
    public function edit($id){
        $data['customers'] = Customer::findOrFail($id);
        $data['customertypes'] = CustomerType::all();
        return view('Backends.Customers.edit',$data);
    }
    public function update(Request $request,$id){
        try{
            $customers = Customer::findOrFail($id);
            $customers->CustomerCode = $request->input('CustomerCode');
            $customers->CustomerTypeId = $request->input('CustomerTypeId');
            $customers->CustomerName = $request->input('CustomerName');
            $customers->Sex = $request->input('Sex');
            $customers->Dob = $request->input('Dob');
            $customers->Pob = $request->input('Pob');
            $customers->Phone = $request->input('Phone');
            $customers->Address = $request->input('Address');
            $customers->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;
            $customers->save();
            return redirect()->route('customer.index')->with('status','Customer Updated successfully');
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
    public function destroy($id){
        $customers = Customer::findOrFail($id);
        $customers->delete();
        return redirect()->route('customer.index')->with('status','Customer deleted successfully');
    }
    public function show($id){
        $customer = Customer::findOrFail($id);
        $data = Customer::with('customerType')->get();
        return view('Backends.Customers.show',compact('customer'));
    }
}
