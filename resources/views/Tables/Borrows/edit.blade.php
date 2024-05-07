@extends('Dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update Borrow Record</div>
                    <div class="card-body">
                        <form class="row" id="updateForm" method="POST"
                            action="{{ route('borrow.update', $borrow->BorrowId) }}">
                            @csrf
                            @method('put')
                            <div class="form-group col-6">
                                <label for="customerId">Customer Name</label>
                                <select name="CustomerId" id="CustomerId" class="form-control" required>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->CustomerId }}"
                                            {{ $customer->CustomerId == $borrow->CustomerId ? 'selected' : '' }}>
                                            {{ $customer->CustomerName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="LibrarianId">Librarian Name</label>
                                <select name="LibrarianId" id="LibrarianId" class="form-control" required>
                                    @foreach ($librarians as $librarian)
                                        <option value="{{ $librarian->LibrarianId }}"
                                            {{ $librarian->LibrarianId == $borrow->LibrarianId ? 'selected' : '' }}>
                                            {{ $librarian->LibrarianName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-4">
                                <label for="BorrowDate">Borrow Date</label>
                                <input type="date" name="BorrowDate" id="BorrowDate" class="form-control"
                                    value="{{ $borrow->BorrowDate }}" required>
                            </div>

                            <div class="form-group col-4">
                                <label for="BorrowCode">Borrow Code</label>
                                <input type="text" name="BorrowCode" id="BorrowCode" class="form-control"
                                    value="{{ $borrow->BorrowCode }}" required>
                            </div>

                            <div class="form-group col-4">
                                <label for="Depositamount">Deposit Amount</label>
                                <input type="text" name="Depositamount" id="Depositamount" class="form-control"
                                    value="{{ $borrow->Depositamount }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="Duedate">Due Date</label>
                                <input type="date" name="Duedate" id="Duedate" class="form-control"
                                    value="{{ $borrow->Duedate }}" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="FineAmount">Fine Amount</label>
                                <input type="text" name="FineAmount" id="FineAmount" class="form-control"
                                    value="{{ $borrow->FineAmount }}">
                            </div>
                            <div class="form-group">
                                <label for="Emmo">Emmo:</label>
                                <textarea id="Emmo" class="form-control" placeholder="Enter your note" name="Emmo">{{ $borrow->Emmo }}</textarea>
                            </div>
                            {{-- <div class="form-check mt-2 ml-3">
                                <input type="hidden" name="IsHidden" value="0">
                                <input type="checkbox" name="IsHidden" id="IsHidden" class="form-check-input" value="1" value="1" {{ $borrow->IsHidden == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="isHidden">Hidden</label>
                            </div> --}}
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" value="0" name="IsHidden" id="customSwitch1"
                                    {{ $borrow->IsHidden == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                    <input type="hidden" id="IsHidden" name="IsHidden" value="1">
                                </div>
                            </div>
                            <button type="submit" id="updateButton" class="btn btn-primary mt-3 col-1 ml-3" disabled>Update</button>
                        </form>
                    </div>
                </div>
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
    {{-- <script>
        $(document).ready(function() {
            // Initialize Bootstrap Switch
            $('#my-checkbox').bootstrapSwitch();

            // Update value of checkbox when color changes
            $('#my-checkbox').on('switchChange.bootstrapSwitch', function(event, state) {
                // Set the value of the checkbox based on the switch state
                $(this).val(state ? 1 : 0);
            });
        });
    </script> --}}
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
@endsection
