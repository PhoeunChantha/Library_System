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
                <h3>{{ __('Edit Book Detail') }}</h3>
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
                    <div class="card-header">Borrow Detail Information</div>

                    <div class="card-body">
                        <form class="row" method="POST" action="{{ route('borrowdetail.update', $borrowdetail->BorrowDetailId) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-6">
                                <label for="IsReturn">Return :</label>
                                <select name="IsReturn" id="IsReturn" class="form-control">
                                    <option value="1" {{ $borrowdetail->IsReturn == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $borrowdetail->IsReturn == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ReturnDate">Return Date</label>
                                <input type="date" name="ReturnDate" id="ReturnDate" class="form-control"
                                    value="{{ $borrowdetail->ReturnDate }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Note">Note :</label>
                                <textarea id="Note" class="form-control" placeholder="Enter your note" name="Note">{{ $borrowdetail->Note }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary col-1 ml-2">Update</button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('borrowdetail.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
                    list</a>
            </div>
        </div>
    </div>
@endsection
