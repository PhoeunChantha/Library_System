@extends('Backends.master')

@section('content')
<style>
    a {
        text-decoration: none;
        color: gray;
    }

</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>{{ __('Edit Customer') }}</h3>
            </div>
            <div class="col-sm-6" style="text-align: right">
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Customer Information</div>

                <div class="card-body">
                    <form class="row" method="POST" action="{{ route('customer.update',$customers->CustomerId) }}">
                        @csrf
                        @method('put')
                        <div class="form-group col-md-6 ">
                            <label for="customerCode">Customer Code</label>
                            <input type="text" name="CustomerCode" id="customerCode" class="form-control" value="{{ $customers->CustomerCode }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="CustomerTypeId">Customer Type</label>
                            <select name="CustomerTypeId" id="CustomerTypeId" class="form-control" value="{{ $customers->CustomerCode }}" required>
                                @foreach($customertypes as $customerType)
                                    <option value="{{ $customerType->CustomerTypeId }}">
                                        {{ $customerType->CustomerTypeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="CustomerName">Customer Name</label>
                            <input type="text" name="CustomerName" id="CustomerName" class="form-control" value="{{ $customers->CustomerName }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Sex">Sex</label>
                            <select name="Sex" id="Sex" class="form-control" value="{{ $customers->Sex }}">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Dob">Date of Birth</label>
                            <input type="date" name="Dob" id="Dob" class="form-control" value="{{ $customers->Dob }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Pob">Place of Birth</label>
                            <input type="text" name="Pob" id="Pob" class="form-control" maxlength="50" value="{{ $customers->Pob }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Phone">Phone</label>
                            <input type="text" name="Phone" id="Phone" class="form-control" maxlength="50" value="{{ $customers->Phone }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Address">Address</label>
                            <input type="text" name="Address" id="Address" class="form-control" maxlength="500" value="{{ $customers->Address }}">
                        </div>
                        {{-- <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="1" name="IsHidden" id="customSwitch1"   {{ $customers->IsHidden == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                <input type="hidden" id="IsHidden" name="IsHidden" value="0">
                            </div>
                        </div> --}}
                        <button type="submit" id="updateButton" class="btn btn-primary col-1 ml-2">Update</button>
                    </form>
                </div>
            </div>
            <a href="{{ route('customer.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
                list</a>
        </div>
    </div>
</div>
{{-- <script>
    // Get the checkbox element
    var checkbox = document.getElementById('customSwitch1');
    // Get the hidden input element
    var hiddenInput = document.getElementById('IsHidden');

    // Add event listener to listen for changes in the checkbox
    checkbox.addEventListener('change', function() {
        // Toggle the values of the hidden input based on the checkbox state
        if (this.checked) {
            hiddenInput.value = '1';
        } else {
            hiddenInput.value = '0';
        }
    });
</script> --}}
@endsection
