@extends('Dashboard')
@section('content')
<div class="container">
    <h3>Customer Details</h3>
    <div class="card col-5">
        <div class="card-body">
            <p class="card-text">Customer Code: {{ $customer->CustomerCode }}</p>
            <p class="card-text">Customer Type: {{ $customer->customerType->CustomerTypeName }}</p>
            <p class="card-text">Customer Name: {{ $customer->CustomerName }}</p>
            <p class="card-text">Sex: {{ $customer->Sex}}</p>
            <p class="card-text">Date of Birth: {{ $customer->Dob}}</p>
            <p class="card-text">Place of Birth: {{ $customer->Pob}}</p>
            <p class="card-text">Phone: {{ $customer->Phone}}</p>
            <p class="card-text">Address: {{ $customer->Address}}</p>
            <p class="card-text">Is Hidden:
                @if ($customer->IsHidden == 1)
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
