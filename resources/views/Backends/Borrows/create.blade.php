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
                    {{-- <div class="card-body">
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
                                <label for="Duedate">Duedate</label>
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
                                <label for="FineAmount">Find Amount</label>
                                <input type="text" name="FineAmount" id="FineAmount" class="form-control"
                                    value="{{ old('FineAmount') }}">
                                @error('FineAmount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="Emmo">Emmo:</label>
                                <textarea id="Emmo" class="form-control" placeholder="Enter your note" name="Emmo">{{ old('Emmo') }}</textarea>
                                @error('Emmo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
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
                            <hr style="width: 98%;border:2px solid black;">
                            <div class="card-header w-100">Borrow Detail Information</div>
                            <div class="form-group col-md-6">
                                <label for="BorrowId">Borrow Code</label>
                                <select name="BorrowId" id="BorrowId" class="form-control">
                                    @foreach ($borrows as $borrow)
                                        <option value="{{ $borrow->BorrowId }}"
                                            {{ old('BorrowId') == $borrow->BorrowId ? 'selected' : '' }}>
                                            {{ $borrow->BorrowCode }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('BorrowId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Book Code</label>
                                <select class="select2" name="book_ids[]" multiple="multiple"
                                    data-placeholder="Select BookCode" style="width: 100%;">
                                    @foreach ($books as $book)
                                        <option value="{{ $book->BookId }}"
                                            {{ in_array($book->BookId, (array) old('book_ids', [])) ? 'selected' : '' }}>
                                            {{ $book->BookCode }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="IsReturn">IsReturn :</label>
                                <select name="IsReturn" id="IsReturn" class="form-control">
                                    <option value="1" {{ old('IsReturn') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('IsReturn') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('IsReturn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ReturnDate">Return Date</label>
                                <input type="date" name="ReturnDate" id="ReturnDate" class="form-control"
                                    value="{{ old('ReturnDate') }}">
                                @error('ReturnDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="Note">Note :</label>
                                <textarea id="Note" class="form-control" placeholder="Enter your note" name="Note">{{ old('Note') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 col-2 ml-3">Save</button>
                        </form>
                    </div> --}}

                    <div class="card-body">
                        <form class="row" method="POST" action="{{ route('borrow.store') }}">
                            @csrf
                            <!-- Hidden input field to capture BorrowId -->
                            <input type="hidden" name="BorrowId" id="BorrowId"
                                value="{{ $borrow->BorrowId ?? old('BorrowId') }}">

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
                                <label for="Duedate">Duedate</label>
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
                                <label for="FineAmount">Find Amount</label>
                                <input type="text" name="FineAmount" id="FineAmount" class="form-control"
                                    value="{{ old('FineAmount') }}">
                                @error('FineAmount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="Emmo">Emmo:</label>
                                <textarea id="Emmo" class="form-control" placeholder="Enter your note" name="Emmo">{{ old('Emmo') }}</textarea>
                                @error('Emmo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <div class="form-group col-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" value="1" name="IsHidden"
                                        id="customSwitch1" {{ old('IsHidden') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                    <input type="hidden" id="IsHidden" name="IsHidden" value="0">
                                </div>
                                @error('IsHidden')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            <hr style="width: 98%;border:2px solid black;">
                            <div class="card-header w-100">Borrow Detail Information</div>

                            <div class="form-group col-md-6">
                                <label for="BorrowId">Borrow Code</label>
                                <input type="text" name="BorrowId" id="Borrow_Id" class="form-control"
                                    value="{{ old('BorrowId', $borrow->BorrowId ?? '') }}" disabled>
                                @error('BorrowId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <input type="hidden" name="BorrowCodeDetail" id="BorrowCodeDetail"
                                value="{{ old('BorrowCode', $borrow->BorrowCode ?? '') }}">
                            <div class="form-group col-md-6">
                                <label>Book Code</label>
                                <select class="select2" name="book_ids[]" multiple="multiple"
                                    data-placeholder="Select BookCode" style="width: 100%;">
                                    {{-- @foreach ($books as $book)
                                        <option value="{{ $book->BookId }}"
                                            {{ in_array($book->BookId, (array) old('book_ids', [])) ? 'selected' : '' }}>
                                            {{ $book->BookCode }}
                                        </option>
                                    @endforeach --}}
                                    @foreach ($books as $book)
                                        @if (old('book_ids') == $book->BookId)
                                            <option value="{{ $book->BookId }}" selected>
                                                {{ $book->BookCode }} ({{ $book->catalog->CatalogName }})</option>
                                        @else
                                            <option value="{{ $book->BookId }}">
                                                {{ $book->BookCode }} ({{ $book->catalog->CatalogName }})</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('book_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="IsReturn">IsReturn :</label>
                                <select name="IsReturn" id="IsReturn" class="form-control">
                                    <option value="1" {{ old('IsReturn') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('IsReturn') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('IsReturn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ReturnDate">Return Date</label>
                                <input type="date" name="ReturnDate" id="ReturnDate" class="form-control"
                                    value="{{ old('ReturnDate') }}">
                                @error('ReturnDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="Note">Note :</label>
                                <textarea id="Note" class="form-control" placeholder="Enter your note" name="Note">{{ old('Note') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 col-2 ml-3">Save</button>
                        </form>
                    </div>

                </div>
                <a href="{{ route('borrow.index') }}" class="back mt-3"><i class="fa-solid fa-arrow-left mr-2"></i>back
                    to list</a>
            </div>
        </div>
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
    <script>
        document.getElementById('BorrowCode').addEventListener('input', function(event) {
            const input = event.target;
            const value = input.value;

            // Ensure the input starts with 'cat'
            if (!value.startsWith('BR')) {
                input.value = 'BR' + value.replace(/^cat/, '');
            }

            // Ensure the fourth character is a number
            if (value.length > 3 && !/\d/.test(value[3])) {
                input.value = value.slice(0, 3) + value.slice(4);
            }
        });
    </script>
@endsection
