@extends('Backends.master')
@section('content')
    <style>
        a {
            text-decoration: none;
            color: gray;
        }
    </style>
    <div class="container">
        <h3>Book Details</h3>
        <div class="card col-5">
            <div class="card-body">
                <p class="card-text">BookName: {{ $book->BookName }}</p>
                <p class="card-text">BookCode: {{ $book->BookCode }}</p>
                <p class="card-text">Catalog Name: {{ $book->catalog->CatalogName }}</p>
                <p class="card-text">BookImage: <img src="{{ asset('images/' . $book->BookImage) }}" alt="No Image"
                        width="50" height="50"></p>
                <p class="card-text">BookDescription: {{ $book->BookDescription }}</p>
                <p class="card-text">Is Hidden:
                    @if ($book->IsHidden == 1)
                        {{-- <i class="fas fa-check ml-2" style="color: green;"></i> --}}
                        <span class="badge bg-danger">Hided</span>
                        <!-- Green color for checked state -->
                    @else
                        {{-- <i class="fas fa-times ml-2" style="color: red;"></i>  --}}
                        <span class="badge bg-success">showed</span>
                    @endif
                </p>
            </div>
        </div>
        <a href="{{ route('book.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
            list</a>
    </div>
@endsection
