@extends('Backends.master')
@section('content')
<style>
    a {
        text-decoration: none;
        color: gray;
    }

</style>
<div class="container">
    <h3>Borrow Details</h3>
    <div class="card col-5">
        <div class="card-body">
            <p class="card-text"><strong>Borrow Code:</strong> {{ $borrowdetail->borrow->BorrowCode }}</p>
            <p class="card-text"><strong>Book Names:</strong>
                @if ($books->isNotEmpty())
                    <ul>
                        @foreach ($books as $book)
                            <li>{{ $book->BookName }}</li>
                        @endforeach
                    </ul>
                @else
                    <span>N/A</span>
                @endif
            </p>            <p class="card-text"><strong>Note :</strong> {{ $borrowdetail->Note }}</p>
            <p class="card-text"><strong>Return Date :</strong> {{ $borrowdetail->ReturnDate}}</p>
            <p class="card-text"><strong>IsReturn :</strong>
                @if ($borrowdetail->IsReturn)
                    <span class="badge bg-success">Yes</span>
                @else
                    <span class="badge bg-danger">No</span>
                @endif
            </p>
        </div>
    </div>
    <a href="{{ route('borrowdetail.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
        list</a>
</div>
@endsection
