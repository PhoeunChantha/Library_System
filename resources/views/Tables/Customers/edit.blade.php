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
                            <select name="Sex" id="Sex" class="form-control" value="{{ $customers->Sex }}">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
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
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="0" name="IsHidden" id="customSwitch1"
                                {{ $customers->IsHidden == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                <input type="hidden" id="IsHidden" name="IsHidden" value="1">
                            </div>
                        </div>
                        <button type="submit" id="updateButton" class="btn btn-primary" disabled>Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const updateButton = document.getElementById('updateButton');
        const formElements = form.querySelectorAll('input, select, textarea');

        // Listen for changes in form elements
        formElements.forEach(element => {
            element.addEventListener('change', () => {
                // Enable the button when any field changes
                updateButton.disabled = false;
            });
        });
    });
</script>
<script>
    // Get the checkbox element
    var checkbox = document.getElementById('customSwitch1');
    // Get the hidden input element
    var hiddenInput = document.getElementById('IsHidden');

    // Add event listener to listen for changes in the checkbox
    checkbox.addEventListener('change', function() {
        // Toggle the values of the checkbox and hidden input
        if (this.checked) {
            checkbox.value = '0';
            hiddenInput.value = '1';
        } else {
            checkbox.value = '1';
            hiddenInput.value = '0';
        }
    });
</script>
@endsection
