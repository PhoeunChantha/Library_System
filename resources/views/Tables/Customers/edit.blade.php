@extends('Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Customer</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customer.update',$customers->CustomerId) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="customerCode">Customer Code</label>
                            <input type="text" name="CustomerCode" id="customerCode" class="form-control" value="{{ $customers->CustomerCode }}" required>
                        </div>

                        <div class="form-group">
                            <label for="CustomerTypeId">Customer Type</label>
                            <select name="CustomerTypeId" id="CustomerTypeId" class="form-control" value="{{ $customers->CustomerCode }}" required>
                                @foreach($customertypes as $customerType)
                                    <option value="{{ $customerType->CustomerTypeId }}">
                                        {{ $customerType->CustomerTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="CustomerName">Customer Name</label>
                            <input type="text" name="CustomerName" id="CustomerName" class="form-control" value="{{ $customers->CustomerName }}" required>
                        </div>

                        <div class="form-group">
                            <label for="Sex">Sex</label>
                            <input type="text" name="Sex" id="Sex" class="form-control" maxlength="50" value="{{ $customers->Sex }}">
                        </div>

                        <div class="form-group">
                            <label for="Dob">Date of Birth</label>
                            <input type="date" name="Dob" id="Dob" class="form-control" value="{{ $customers->Dob }}">
                        </div>

                        <div class="form-group">
                            <label for="Pob">Place of Birth</label>
                            <input type="text" name="Pob" id="Pob" class="form-control" maxlength="50" value="{{ $customers->Pob }}">
                        </div>

                        <div class="form-group">
                            <label for="Phone">Phone</label>
                            <input type="text" name="Phone" id="Phone" class="form-control" maxlength="50" value="{{ $customers->Phone }}">
                        </div>

                        <div class="form-group">
                            <label for="Address">Address</label>
                            <input type="text" name="Address" id="Address" class="form-control" maxlength="500" value="{{ $customers->Address }}">
                        </div>
                        <div class="form-check mb-2">
                            <input type="hidden" name="IsHidden" value="0"> <!-- Add a hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="IsHidden" id="IsHidden" class="form-check-input" value="1" {{ $customers->IsHidden == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="IsHidden">Hidden</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
