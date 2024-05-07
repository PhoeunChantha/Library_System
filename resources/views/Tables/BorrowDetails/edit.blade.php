@extends('Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header text-center">Update BorrowDetail</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('borrowdetail.update', $borrowdetail->BorrowDetailId) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="BorrowId">Borrow Code</label>
                                <select name="BorrowId" id="BorrowId" class="form-control" required>
                                    @foreach ($borrows as $borrow)
                                        <option value="{{ $borrow->BorrowId }}"
                                            {{ $borrow->BorrowId == $borrowdetail->BorrowId ? 'selected' : '' }}>
                                            {{ $borrow->BorrowCode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Book Name</label>
                                <select class="select2" name="book_ids[]" multiple="multiple" data-placeholder="Select Book"
                                    style="width: 100%;">
                                    @foreach ($books as $book)
                                        <?php $bookIds = json_decode($borrowdetail->book_ids); ?>
                                        <option value="{{ $book->BookId }}"
                                            {{ in_array($book->BookId, $bookIds) ? 'selected' : '' }}>
                                            {{ $book->BookName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Note">Note :</label>
                                <textarea id="Note" class="form-control" placeholder="Enter your note" name="Note">{{ $borrowdetail->Note }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="IsReturn">Return :</label>
                                <select name="IsReturn" id="IsReturn" class="form-control">
                                    <option value="1" {{ $borrowdetail->IsReturn == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $borrowdetail->IsReturn == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="IsReturn">Return :</label>
                                <select name="IsReturn" id="IsReturn" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="ReturnDate">Return Date</label>
                                <input type="date" name="ReturnDate" id="ReturnDate" class="form-control"
                                    value="{{ $borrowdetail->ReturnDate }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
