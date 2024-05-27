<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'CustomerCode' => 'required|max:500',
            'CustomerTypeId' => 'required|exists:customertypes,CustomerTypeId',
            'CustomerName' => 'required|max:50',
            'Sex' => 'nullable|max:50',
            'Dob' => 'nullable|date',
            'Pob' => 'nullable|max:50',
            'Phone' => 'required|max:50',
            'Address' => 'required|max:500',
          //  'IsHidden' => 'boolean'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }
        try{
             DB::beginTransaction();
           $customers = new Customer();
           $customers->CustomerCode = $request->input('CustomerCode');
           $customers->CustomerTypeId = $request->input('CustomerTypeId');
           $customers->CustomerName = $request->input('CustomerName');
           $customers->Sex = $request->input('Sex');
           $customers->Dob = $request->input('Dob');
           $customers->Pob = $request->input('Pob');
           $customers->Phone = $request->input('Phone');
           $customers->Address = $request->input('Address');
          // $customers->IsHidden = $request->input('IsHidden');
           $customers->save();
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
        return redirect()->route('customer.index')->with($output);
    }
    public function edit($id){
        $data['customers'] = Customer::findOrFail($id);
        $data['customertypes'] = CustomerType::all();
        return view('Backends.Customers.edit',$data);
    }
    public function update(Request $request,$id){
        try{
            DB::beginTransaction();
            $customers = Customer::findOrFail($id);
            $customers->CustomerCode = $request->input('CustomerCode');
            $customers->CustomerTypeId = $request->input('CustomerTypeId');
            $customers->CustomerName = $request->input('CustomerName');
            $customers->Sex = $request->input('Sex');
            $customers->Dob = $request->input('Dob');
            $customers->Pob = $request->input('Pob');
            $customers->Phone = $request->input('Phone');
            $customers->Address = $request->input('Address');
          //  $customers->IsHidden = $request->has('IsHidden') ? $request->input('IsHidden') : 0;
            $customers->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Updated successfully')
            ];
            return redirect()->route('customer.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('customer.index')->with($output);
        }
    }
    public function destroy($id){
        try {
            DB::beginTransaction();

            $customers = Customer::findOrFail($id);
            $customers->delete();

            DB::commit();

            // Redirect back to the borrow index page with a success message
            $output = [
                'success' => 1,
                'msg' => __('Deleted successfully.')
            ];
            return redirect()->route('customer.index')->with($output);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('customer.index')->with($output);
        }
    }
    public function show($id){
        $customer = Customer::findOrFail($id);
        $data = Customer::with('customerType')->get();
        return view('Backends.Customers.show',compact('customer'));
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $customer = Customer::findOrFail($request->id);
            $customer->IsHidden = $request->IsHidden;
            $customer->save();

            $output = ['IsHidden' => 1, 'msg' => __('Hidden data successfully')];

            DB::commit();
        } catch (Exception $e) {
            $output = ['IsHidden' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
