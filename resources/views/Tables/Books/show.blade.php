@extends('Dashboard')
@section('content')
<div class="container">
    <h1>Book Details</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text">BookName: {{ $book->BookName }}</p>
            <p class="card-text">BookCode: {{ $book->BookCode }}</p>
            <p class="card-text">Catalog Name: {{ $book->catalog->CatalogName}}</p>
            <p class="card-text">BookImage:  <img src="{{ asset('images/' . $book->BookImage) }}" alt="Image"  width="50" height="50"></p>
            <p class="card-text">BookDescription: {{ $book->BookDescription }}</p>
            <p class="card-text">Is Hidden: {{ $book->IsHidden ? 'Yes' : 'No' }}</p>
        </div>
    </div>
</div>
@endsection
