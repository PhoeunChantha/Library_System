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
                    <h3>{{ __('Edit Borrow') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"  style="background-color:  rgba(173, 72, 0, 1)">Borrow Information</div>
            <div class="card-body">
                <form class="row" id="updateForm" method="POST"
                    action="{{ route('borrow.updateBoth', $borrow->BorrowId) }}">
                    @csrf
                    @method('put')

                    <!-- Borrow Information -->
                    <div class="form-group col-6">
                        <label for="CustomerId">Customer Name</label>
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
                        <label for="UserId">Librarian Name</label>
                        {{-- <select name="LibrarianId" id="LibrarianId" class="form-control" required>
                                    @foreach ($librarians as $librarian)
                                        <option value="{{ $librarian->LibrarianId }}"
                                            {{ $librarian->LibrarianId == $borrow->LibrarianId ? 'selected' : '' }}>
                                            {{ $librarian->LibrarianName }}
                                        </option>
                                    @endforeach
                                </select> --}}
                        <input type="text" name="CustomerId" id="CustomerId" class="form-control"
                            @if ($user) value="{{ $borrow->user->name }}" @endif disabled>
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
                        @error('BorrowCode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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

                    <div class="form-group col-12">
                        <label for="Emmo">Emmo:</label>
                        <textarea id="Emmo" class="form-control" placeholder="Enter your note" name="Emmo">{{ $borrow->Emmo }}</textarea>
                    </div>

                    <!-- BorrowDetail Information -->

                    {{-- <div class="form-group col-md-6">
                                <label for="BorrowId">Borrow Code</label>
                                <select name="BorrowDetailId" id="BorrowDetailId" class="form-control" required>
                                    <option value="{{ $borrow->BorrowId }}" selected>{{ $borrow->BorrowCode }}</option>
                                </select>
                            </div> --}}


                    <div class="form-group col-md-6">
                        <label for="BorrowId">Borrow Code</label>
                        <input type="text" name="BorrowId" id="Borrow_Id" class="form-control"
                            value="{{ old('BorrowId', $borrow->BorrowCode ?? '') }}" disabled>
                        @error('BorrowId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="BorrowCodeDetail" id="BorrowCodeDetail"
                        value="{{ old('BorrowCode', $borrow->BorrowCode ?? '') }}">

                    <div class="form-group col-md-6">
                        <label>Book Name</label>
                        <select class="select2" name="book_ids[]" multiple="multiple" data-placeholder="Select Book"
                            style="width: 100%;">
                            @foreach ($books as $book)
                                <?php $bookIds = !is_null($borrowdetail->book_ids) ? json_decode($borrowdetail->book_ids) : []; ?>
                                <option value="{{ @$book->BookId }}"
                                    {{ in_array(@$book->BookId, $bookIds) ? 'selected' : '' }}>
                                    {{ @$book->BookCode }} ({{ @$book->catalog->CatalogName }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="IsReturn">Return :</label>
                        <select name="IsReturn" id="IsReturn" class="form-control select2">
                            <option value="1" {{ $borrowdetail->IsReturn == 1 ? 'selected' : '' }}>Yes
                            </option>
                            <option value="0" {{ $borrowdetail->IsReturn == 0 ? 'selected' : '' }}>No</option>
                        </select>
                        {{-- <input type="hidden" name="IsReturn" id="IsReturnHidden"
                                    value="{{ $borrowdetail->IsReturn }}"> --}}
                        @error('IsReturn')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-6">
                        <label for="ReturnDate">Return Date</label>
                        <input type="date" name="ReturnDate" id="ReturnDate" class="form-control"
                            value="{{ $borrowdetail->ReturnDate }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="Note">Note :</label>
                        <textarea id="Note" class="form-control" placeholder="Enter your note" name="Note">{{ $borrowdetail->Note }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 col-1 ml-3">Update</button>
                </form>
            </div>
        </div>
        <a href="{{ route('borrow.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back
            to
            list</a>
    </div>



    <script>
        // Get the BorrowCode input field
        var borrowCodeInput = document.getElementById('BorrowCode');

        // Get the BorrowId input field in the Borrow Detail Information section
        var borrowIdInput = document.getElementById('Borrow_Id');

        // Add event listener to detect changes in BorrowCode input field
        borrowCodeInput.addEventListener('input', function() {
            // Update the value of BorrowId input field with the same value
            borrowIdInput.value = borrowCodeInput.value;
        });
    </script>
    {{-- <script>
        document.getElementById('ReturnDate').addEventListener('input', function(event) {
            const isReturnField = document.getElementById('IsReturn');
            const isReturnHiddenField = document.getElementById('IsReturnHidden');
            if (event.target.value) {
                isReturnField.value = '1'; // Set to "Yes"
                isReturnHiddenField.value = '1'; // Set hidden input to "Yes"
            } else {
                isReturnField.value = '0'; // Set to "No" if the date is cleared
                isReturnHiddenField.value = '0'; // Set hidden input to "No"
            }
        });
    </script> --}}
@endsection
