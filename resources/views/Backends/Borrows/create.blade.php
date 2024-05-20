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
                    <h3>{{ __('Add New Borrow') }}</h3>
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
                    <div class="card-header">Borrow Information</div>

                    <div class="card-body">
                        <form class="row" method="POST" action="{{ route('borrow.store') }}">
                            @csrf

                            <div class="form-group col-6">
                                <label for="customerId">Customer Name</label>
                                <select name="CustomerId" id="CustomerId" class="form-control">
                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->CustomerId }}"
                                            {{ old('CustomerId') == $customer->CustomerId ? 'selected' : '' }}>
                                            {{ $customer->CustomerName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('CustomerId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="LibrarianId">Librarian Name</label>
                                <select name="LibrarianId" id="LibrarianId" class="form-control">
                                    <option value="">Select Librarian</option>
                                    @foreach ($librarians as $librarian)
                                        <option value="{{ $librarian->LibrarianId }}"
                                            {{ old('LibrarianId') == $librarian->LibrarianId ? 'selected' : '' }}>
                                            {{ $librarian->LibrarianName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('LibrarianId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="BorrowDate">Borrow Date</label>
                                <input type="date" name="BorrowDate" id="BorrowDate" class="form-control"
                                    value="{{ old('BorrowDate') }}">
                                @error('BorrowDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="Duedate">Duedate </label>
                                <input type="date" name="Duedate" id="Duedate" class="form-control"
                                    value="{{ old('Duedate') }}">
                                @error('Duedate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="BorrowCode">Borrow Code</label>
                                <input type="text" name="BorrowCode" id="BorrowCode" class="form-control"
                                    value="{{ old('BorrowCode') }}">
                                @error('BorrowCode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="Depositamount">Deposit Amount</label>
                                <input type="text" name="Depositamount" id="Depositamount" class="form-control"
                                    value="{{ old('Depositamount') }}">
                                @error('Depositamount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="Depositamount">Find Amount</label>
                                <input type="text" name="FineAmount" id="FineAmount" class="form-control"
                                    value="{{ old('FineAmount') }}">
                                @error('FineAmount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Emmo">Emmo:</label>
                                <textarea id="Emmo" class="form-control" placeholder="Enter your note" name="Emmo">{{ old('Emmo') }}</textarea>
                                @error('Emmo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" value="1" name="IsHidden"
                                        id="customSwitch1" {{ old('IsHidden') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                    <input type="hidden" id="IsHidden" name="IsHidden" value="0">
                                </div>
                                @error('IsHidden')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 col-1 ml-3">Save</button>
                        </form>


                    </div>
                </div>
                <a href="{{ route('borrow.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
                    list</a>
            </div>
        </div>
    </div>
    <script>
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
    </script>
@endsection
