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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Borrow Information</div>
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
                            <button type="submit" id="updateButton" class="btn btn-primary mt-3 col-1 ml-3">Update</button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('borrow.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back
                    to
                    list</a>
            </div>

        </div>
    </div>
@endsection
