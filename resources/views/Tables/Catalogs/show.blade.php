@extends('Dashboard')
@section('content')
<div class="container">
    <h1>Catalog Item Details</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text">Catalog Code: {{ $catalog->CatalogCode }}</p>
            <p class="card-text">Catalog Name: {{ $catalog->CatalogName }}</p>
            <p class="card-text">ISBN: {{ $catalog->Isbn }}</p>
            <p class="card-text">Author Name: {{ $catalog->AuthorName }}</p>
            <p class="card-text">Publisher: {{ $catalog->PubliSher }}</p>
            <p class="card-text">Publish Year: {{ $catalog->PublishYear }}</p>
            <p class="card-text">Published Edition: {{ $catalog->PublisheDition }}</p>
            <p class="card-text">Is Hidden: {{ $catalog->IsHidden ? 'Yes' : 'No' }}</p>
        </div>
    </div>
</div>
@endsection
