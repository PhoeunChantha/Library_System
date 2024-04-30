@extends('Dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update Borrow Record</div>

                    <div class="card-body">
                        <form class="row" method="POST" action="{{ route('borrow.update',$borrow->BorrowId) }}">
                            @csrf
                            @method('put')
                            <div class="form-group col-6">
                                <label for="customerId">Customer Name</label>
                                <select name="CustomerId" id="CustomerId" class="form-control" value="{{$borrow->CustomerId}}" required>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->CustomerId }}">
                                            {{ $customer->CustomerName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="LibrarianId">Librarian Name</label>
                                <select name="LibrarianId" id="LibrarianId" class="form-control" value="{{$borrow->LibrarianId}}"  required>
                                    @foreach ($librarians as $librarian)
                                        <option value="{{ $librarian->LibrarianId }}">
                                            {{ $librarian->LibrarianName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-4">
                                <label for="BorrowDate">Borrow Date</label>
                                <input type="date" name="BorrowDate" id="BorrowDate" class="form-control" value="{{$borrow->BorrowDate}}" required>
                            </div>

                            <div class="form-group col-4">
                                <label for="BorrowCode">Borrow Code</label>
                                <input type="text" name="BorrowCode" id="BorrowCode" class="form-control" value="{{$borrow->BorrowCode}}" required>
                            </div>

                            <div class="form-group col-4">
                                <label for="Depositamount">Deposit Amount</label>
                                <input type="text" name="Depositamount" id="Depositamount" class="form-control" value="{{$borrow->Depositamount}}">
                            </div>

                            <div class="form-group col-6">
                                <label for="Duedate">Due Date</label>
                                <input type="date" name="Duedate" id="Duedate" class="form-control"  value="{{$borrow->Duedate}}" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="FineAmount">Fine Amount</label>
                                <input type="text" name="FineAmount" id="FineAmount" class="form-control"  value="{{$borrow->FineAmount}}" >
                            </div>
                            <div class="form-group">
                                <label for="Emmo">Emmo:</label>
                                <textarea id="Emmo" class="form-control" placeholder="Enter your note" name="Emmo" value="{{$borrow->Emmo}}"></textarea>
                            </div>
                            <div class="form-check mt-2 ml-3">
                                <input type="hidden" name="IsHidden" value="0">
                                <input type="checkbox" name="IsHidden" id="IsHidden" class="form-check-input" value="1" value="1" {{ $borrow->IsHidden == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="isHidden">Hidden</label>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 col-1 ml-3">update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
