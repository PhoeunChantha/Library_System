@extends('Dashboard')
@section('content')
<div class="container">
    <h1>Customer Details</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text">Customer Code: {{ $customer->CustomerCode }}</p>
            <p class="card-text">Customer Type: {{ $customer->customerType->CustomerTypeName }}</p>
            <p class="card-text">Customer Name: {{ $customer->CustomerName }}</p>
            <p class="card-text">Sex: {{ $customer->Sex}}</p>
            <p class="card-text">Date of Birth: {{ $customer->Dob}}</p>
            <p class="card-text">Place of Birth: {{ $customer->Pob}}</p>
            <p class="card-text">Phone: {{ $customer->Phone}}</p>
            <p class="card-text">Address: {{ $customer->Address}}</p>
            <p class="card-text">Is Hidden: {{ $customer->IsHidden ? 'Yes' : 'No' }}</p>
        </div>
    </div>
</div>
@endsection
