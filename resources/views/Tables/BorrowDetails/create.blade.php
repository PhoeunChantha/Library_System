@extends('Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header text-center">Create New BorrowDetail</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('borrowdetail.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="BorrowId">Borrow Code</label>
                                <select name="BorrowId" id="BorrowId" class="form-control" required>
                                    @foreach ($borrows as $borrow)
                                        <option value="{{ $borrow->BorrowId }}">
                                            {{ $borrow->BorrowCode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Book Name</label>
                                <select class="select2" name="book_ids[]" multiple="multiple" data-placeholder="Select Book" style="width: 100%;">
                                    @foreach ($books as $book)
                                        <option value="{{ $book->BookId }}">
                                            {{ $book->BookName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Note">Note :</label>
                                <textarea id="Note" class="form-control" placeholder="Enter your note" name="Note"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="IsReturn">IsReturn :</label>
                                <select name="IsReturn" id="IsReturn" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ReturnDate">Return Date</label>
                                <input type="date" name="ReturnDate" id="ReturnDate" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
