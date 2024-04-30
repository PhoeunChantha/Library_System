@extends('Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Customer</div>

                    <div class="card-body ">
                        <form class="row" method="POST" action="{{ route('customer.store') }}">
                            @csrf

                            <div class="form-group col-3">
                                <label for="customerCode">Customer Code</label>
                                <input type="text" name="CustomerCode" id="customerCode" class="form-control" required>
                            </div>

                            <div class="form-group col-4">
                                <label for="CustomerTypeId">Customer Type</label>
                                <select name="CustomerTypeId" id="CustomerTypeId" class="form-control" required>
                                    @foreach ($customertypes as $customerType)
                                        <option value="{{ $customerType->CustomerTypeId }}">
                                            {{ $customerType->CustomerTypeName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-5">
                                <label for="CustomerName">Customer Name</label>
                                <input type="text" name="CustomerName" id="CustomerName" class="form-control" required>
                            </div>
                            <div class="form-group col-3">
                                <label for="Sex">Sex</label>
                                <select name="Sex" id="Sex" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="Dob">Date of Birth</label>
                                <input type="date" name="Dob" id="Dob" class="form-control">
                            </div>

                            <div class="form-group col-5">
                                <label for="Pob">Place of Birth</label>
                                <input type="text" name="Pob" id="Pob" class="form-control" maxlength="50">
                            </div>

                            <div class="form-group col-6">
                                <label for="Phone">Phone</label>
                                <input type="text" name="Phone" id="Phone" class="form-control" maxlength="50">
                            </div>

                            <div class="form-group col-6">
                                <label for="Address">Address</label>
                                <input type="text" name="Address" id="Address" class="form-control" maxlength="500">
                            </div>
                            <div class="form-check mb-2 ">
                                <input type="hidden" name="IsHidden" value="0">
                                <input type="checkbox" name="IsHidden" id="IsHidden" class="form-check-input"
                                    value="1">
                                <label class="form-check-label" for="IsHidden">Hidden</label>
                            </div>
                            <button type="submit" class="btn btn-primary col-1">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
