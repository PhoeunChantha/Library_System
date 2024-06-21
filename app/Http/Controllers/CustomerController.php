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
    public function index()
    {
        $data['customers'] = Customer::all();
        $data['customertypes'] = CustomerType::all();
        $data['customers'] = Customer::with('customerType')->get();
        return view('Backends.Customers.index', $data);
    }
    public function create()
    {

        $data['customertypes'] = CustomerType::all();
        return view('Backends.Customers.create', $data);
    }
    // public function store(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'CustomerTypeId' => 'required|exists:customertypes,CustomerTypeId',
    //         'FirstCode' => 'required|string',
    //         'NextCode' => 'required|string',
    //         'CustomerName' => 'required|max:50',
    //         'Sex' => 'nullable|max:50',
    //         'Dob' => 'nullable|date',
    //         'Pob' => 'nullable|max:50',
    //         'Phone' => 'required|max:50',
    //         'Address' => 'required|max:500',
    //         //  'IsHidden' => 'boolean'
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput()
    //             ->with(['success' => 0, 'msg' => __('Invalid form input')]);
    //     }
    //     try {
    //         DB::beginTransaction();
    //         $customers = new Customer();
    //         // Generate the CustomerCode
    //         // $lastCustomer = Customer::orderBy('CustomerId', 'desc')->first();
    //         // $nextId = $lastCustomer ? $lastCustomer->CustomerId + 1 : 1;
    //         // $customers->CustomerCode = 'CUST' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

    //         // $customers->CustomerCode = $request->input('CustomerCode');

    //         // Get the values of FirstCode and NextCode from the validated request
    //         $firstCode = $validatedData['FirstCode'];
    //         $nextCode = $validatedData['NextCode'];

    //         // Validate and format the inputs
    //         $firstCode = preg_replace('/[^a-zA-Z]/', '', $firstCode); // Remove non-letter characters
    //         $nextCode = preg_replace('/\D/', '', $nextCode); // Remove non-digit characters

    //         // Generate sequential number
    //         $sequentialNumber = (int)$nextCode + 1;

    //         // Generate CustomerCode
    //         $customerCode = $firstCode . str_pad($nextCode, 3, '0', STR_PAD_LEFT) . str_pad($sequentialNumber, 4, '0', STR_PAD_LEFT);
    //         $customers->CustomerTypeId = $request->input('CustomerTypeId');
    //         $customers->CustomerName = $request->input('CustomerName');
    //         $customers->Sex = $request->input('Sex');
    //         $customers->Dob = $request->input('Dob');
    //         $customers->Pob = $request->input('Pob');
    //         $customers->Phone = $request->input('Phone');
    //         $customers->Address = $request->input('Address');
    //         $customers->IsHidden = '1';
    //         $customers->save();
    //         DB::commit();
    //         $output = [
    //             'success' => 1,
    //             'msg' => __('Created successfully')
    //         ];
    //     } catch (Exception $ex) {
    //         dd($ex);
    //         // DB::rollBack();
    //         // $output = [
    //         //     'success' => 0,
    //         //     'msg' => __('Something went wrong')
    //         // ];
    //     }
    //     return redirect()->route('customer.index')->with($output);
    // }
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'CustomerTypeId' => 'required|exists:customertypes,CustomerTypeId',
    //         'FirstCode' => 'required|string',
    //         'NextCode' => 'required|string',
    //         'CustomerName' => 'required|max:50',
    //         'Sex' => 'nullable|max:50',
    //         'Dob' => 'nullable|date',
    //         'Pob' => 'nullable|max:50',
    //         'Phone' => 'required|max:50',
    //         'Address' => 'required|max:500',
    //         // 'IsHidden' => 'boolean'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput()
    //             ->with(['success' => 0, 'msg' => __('Invalid form input')]);
    //     }

    //     try {
    //         DB::beginTransaction();

    //         // Get the validated data
    //         $validatedData = $validator->validated();

    //         // Get the values of FirstCode and NextCode from the validated request
    //         $firstCode = $validatedData['FirstCode'];
    //         $nextCode = $validatedData['NextCode'];

    //         // Validate and format the inputs
    //         $firstCode = preg_replace('/[^a-zA-Z]/', '', $firstCode); // Remove non-letter characters
    //         $nextCode = preg_replace('/\D/', '', $nextCode); // Remove non-digit characters

    //         // Generate sequential number
    //         $sequentialNumber = (int)$nextCode + 1;

    //         // Generate CustomerCode
    //         $customerCode = $firstCode . str_pad($nextCode, 3, '0', STR_PAD_LEFT) . $sequentialNumber;

    //         // Create a new Customer instance
    //         $customers = new Customer();
    //         $customers->CustomerTypeId = $validatedData['CustomerTypeId'];
    //         $customers->CustomerName = $validatedData['CustomerName'];
    //         $customers->Sex = $validatedData['Sex'];
    //         $customers->Dob = $validatedData['Dob'];
    //         $customers->Pob = $validatedData['Pob'];
    //         $customers->Phone = $validatedData['Phone'];
    //         $customers->Address = $validatedData['Address'];
    //         $customers->IsHidden = '1'; // Assuming this is intentional

    //         // Assign the generated CustomerCode
    //         $customers->CustomerCode = $customerCode;

    //         // Save the customer to the database
    //         $customers->save();

    //         DB::commit();

    //         $output = [
    //             'success' => 1,
    //             'msg' => __('Created successfully')
    //         ];
    //     } catch (Exception $ex) {
    //         // Handle the exception if necessary
    //         dd($ex);
    //         // DB::rollBack();
    //         // $output = [
    //         //     'success' => 0,
    //         //     'msg' => __('Something went wrong')
    //         // ];
    //     }

    //     return redirect()->route('customer.index')->with($output);
    // }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'CustomerTypeId' => 'required|exists:customertypes,CustomerTypeId',
            'FirstCode' => 'required|string',
            'NextCode' => 'required|numeric',
            'CustomerName' => 'required|max:50',
            'Sex' => 'nullable|max:50',
            'Dob' => 'nullable|date',
            'Pob' => 'nullable|max:50',
            'Phone' => 'required|max:50',
            'Address' => 'required|max:500',
            // 'IsHidden' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            // Get the validated data
            $validatedData = $validator->validated();

            // Get the values of FirstCode and NextCode from the validated request
            $firstCode = $validatedData['FirstCode'];
            $nextCode = $validatedData['NextCode'];

            // Validate and format the inputs
            $firstCode = preg_replace('/[^a-zA-Z]/', '', $firstCode); // Remove non-letter characters
            $nextCode = preg_replace('/\D/', '', $nextCode); // Remove non-digit characters

            // Find the highest existing CustomerCode with the same prefix
            $highestExistingCustomer = Customer::where('CustomerCode', 'like', $firstCode . $nextCode . '%')
                ->orderBy('CustomerCode', 'desc')
                ->first();

            // Determine the next sequential number
            if ($highestExistingCustomer) {
                $existingCode = $highestExistingCustomer->CustomerCode;
                $existingNumber = (int)substr($existingCode, strlen($firstCode . $nextCode));
                $sequentialNumber = $existingNumber + 1;
            } else {
                $sequentialNumber = 1;
            }

            // Generate unique CustomerCode
            $customerCode = $firstCode . $nextCode . $sequentialNumber;

            // Create a new Customer instance
            $customer = new Customer();
            $customer->CustomerTypeId = $validatedData['CustomerTypeId'];
            $customer->CustomerName = $validatedData['CustomerName'];
            $customer->Sex = $validatedData['Sex'];
            $customer->Dob = $validatedData['Dob'];
            $customer->Pob = $validatedData['Pob'];
            $customer->Phone = $validatedData['Phone'];
            $customer->Address = $validatedData['Address'];
            $customer->IsHidden = '1'; // Assuming this is intentional

            // Assign the generated CustomerCode
            $customer->CustomerCode = $customerCode;

            // Save the customer to the database
            $customer->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Created successfully')
            ];
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage());
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong')
            ];
            return redirect()->route('customer.index')->with($output);
        }

        return redirect()->route('customer.index')->with($output);
    }


    public function edit($id)
    {
        $data['customers'] = Customer::findOrFail($id);
        $data['customertypes'] = CustomerType::all();
        return view('Backends.Customers.edit', $data);
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'CustomerTypeId' => 'required|exists:customertypes,CustomerTypeId',
            'CustomerName' => 'required|max:50',
            'Phone' => 'required|max:50',
            'Address' => 'required|max:500',
            'FirstCode' => 'required|string', // Add validation rule for FirstCode
            'NextCode' => 'required|numeric', // Add validation rule for NextCode
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();
            $customers = Customer::findOrFail($id);

            // Get the validated data
            $validatedData = $validator->validated();

            // Get the values of FirstCode and NextCode from the validated request
            $firstCode = $validatedData['FirstCode'];
            $nextCode = $validatedData['NextCode'];

            // Validate and format the inputs
            $firstCode = preg_replace('/[^a-zA-Z]/', '', $firstCode); // Remove non-letter characters
            $nextCode = preg_replace('/\D/', '', $nextCode); // Remove non-digit characters

            // Find the highest existing CustomerCode with the same prefix
            $highestExistingCustomer = Customer::where('CustomerCode', 'like', $firstCode . $nextCode . '%')
                ->orderBy('CustomerCode', 'desc')
                ->first();

            // Determine the next sequential number
            if ($highestExistingCustomer) {
                $existingCode = $highestExistingCustomer->CustomerCode;
                $existingNumber = (int)substr($existingCode, strlen($firstCode . $nextCode));
                $sequentialNumber = $existingNumber + 1;
            } else {
                $sequentialNumber = 1;
            }

            // Generate unique CustomerCode
            $customerCode = $firstCode . $nextCode . $sequentialNumber;

            $customers->CustomerTypeId = $request->input('CustomerTypeId');
            $customers->CustomerName = $request->input('CustomerName');
            $customers->Sex = $request->input('Sex');
            $customers->Dob = $request->input('Dob');
            $customers->Pob = $request->input('Pob');
            $customers->Phone = $request->input('Phone');
            $customers->Address = $request->input('Address');

            // Assign the generated CustomerCode
            $customers->CustomerCode = $customerCode;
            //$customers->IsHidden = '1';
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


    public function destroy($id)
    {
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
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $data = Customer::with('customerType')->get();
        return view('Backends.Customers.show', compact('customer'));
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $customer = Customer::findOrFail($request->id);
            $customer->IsHidden = $request->IsHidden;
            $customer->save();

            $output = ['IsHidden' => 1, 'msg' => __(' Update successfully')];

            DB::commit();
        } catch (Exception $e) {
            $output = ['IsHidden' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
