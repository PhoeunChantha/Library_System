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
                    <h3>{{ __('Add New Book Detail') }}</h3>
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
                        {{-- <form class="row" method="POST" action="{{ route('borrowdetail.store') }}">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="BorrowId">Borrow Code</label>
                                <select name="BorrowId" id="BorrowId" class="form-control" required>
                                    @foreach ($borrows as $borrow)
                                        <option value="{{ $borrow->BorrowId }}">
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
                                        <option value="{{ $book->BookId }}">
                                            {{ $book->BookName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="IsReturn">IsReturn :</label>
                                <select name="IsReturn" id="IsReturn" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ReturnDate">Return Date</label>
                                <input type="date" name="ReturnDate" id="ReturnDate" class="form-control" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Note">Note :</label>
                                <textarea id="Note" class="form-control" placeholder="Enter your note" name="Note"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary col-1 ml-2">Save</button>
                        </form> --}}
                        <form class="row" method="POST" action="{{ route('borrowdetail.store') }}">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="BorrowId">Borrow Code</label>
                                <select name="BorrowId" id="BorrowId" class="form-control" >
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
                                <label>Book Name</label>
                                <select class="select2" name="book_ids[]" multiple="multiple" data-placeholder="Select Book"
                                    style="width: 100%;" >
                                    @foreach ($books as $book)
                                        <option value="{{ $book->BookId }}"
                                            {{ in_array($book->BookId, (array) old('book_ids', [])) ? 'selected' : '' }}>
                                            {{ $book->BookName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="IsReturn">IsReturn :</label>
                                <select name="IsReturn" id="IsReturn" class="form-control" >
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
                                <textarea id="Note" class="form-control" placeholder="Enter your note" name="Note"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary col-1 ml-2">Save</button>
                        </form>

                    </div>
                </div>
                <a href="{{ route('borrowdetail.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back
                    to
                    list</a>
            </div>
        </div>
    </div>
@endsection
