@extends('Backends.master')
@section('content')
<style>
    a {
        text-decoration: none;
        color: gray;
    }

</style>
<div class="container">
    <h3>Librarian Details</h3>
    <div class="card col-5">
        <div class="card-body">
            <p class="card-text">Librarian Name: {{ $librarian->LibrarianName }}</p>
            <p class="card-text">Sex: {{ $librarian->Sex }}</p>
            <p class="card-text">Date of Birth: {{ $librarian->Dob }}</p>
            <p class="card-text">Place of Birth: {{ $librarian->Pob }}</p>
            <p class="card-text">Phone: {{ $librarian->Phone }}</p>
            <p class="card-text">Is Hidden:
                @if ($librarian->IsHidden == 1)
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
    <a href="{{ route('librarian.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
        list</a>
</div>
@endsection
