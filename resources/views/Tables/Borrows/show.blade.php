@extends('Dashboard')
@section('content')
<div class="container">
    <h3>Borrow Details</h3>
    <div class="card col-5">
        <div class="card-body">
            <p class="card-text">Customer Name: {{ $borrow->customer->CustomerName }}</p>
            <p class="card-text">Librarian Name: {{ $borrow->librarian->LibrarianName }}</p>
            <p class="card-text">BorrowDate: {{ $borrow->BorrowDate}}</p>
            <p class="card-text">BorrowCode: {{ $borrow->BorrowCode}}</p>
            <p class="card-text">Depositamount: {{ $borrow->Depositamount }}</p>
            <p class="card-text">Duedate: {{ $borrow->Duedate }}</p>
            <p class="card-text">FineAmount: {{ $borrow->FineAmount }}</p>
            <p class="card-text">Emmo: {{ $borrow->Emmo }}</p>
            <p class="card-text">Is Hidden:
                @if ($borrow->IsHidden == 1)
                {{-- <i class="fas fa-check ml-2" style="color: green;"></i> --}}
                <span class="badge bg-danger">Hided</span>
                <!-- Green color for checked state -->
                @else
                {{-- <i class="fas fa-times ml-2" style="color: red;"></i>  --}}
                    <span class="badge bg-success">showed</span>
                @endif
            </p>        </div>
    </div>
</div>
@endsection
