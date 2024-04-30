@extends('Dashboard')
@section('content')
<div class="container">
    <h1>Librarian Details</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text">Librarian Name: {{ $librarian->LibrarianName }}</p>
            <p class="card-text">Sex: {{ $librarian->Sex }}</p>
            <p class="card-text">Date of Birth: {{ $librarian->Dob }}</p>
            <p class="card-text">Place of Birth: {{ $librarian->Pob }}</p>
            <p class="card-text">Phone: {{ $librarian->Phone }}</p>
            <p class="card-text">Is Hidden: {{ $librarian->IsHidden ? 'Yes' : 'No' }}</p>
        </div>
    </div>
</div>
@endsection
