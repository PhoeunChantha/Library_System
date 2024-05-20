@extends('Backends.master')
@section('content')
<style>
    a {
        text-decoration: none;
        color: gray;
    }

</style>
    <div class="container">
        <h3>Catalog Item Details</h3>
        <div class="card col-5">
            <div class="card-body">
                <p class="card-text">Catalog Code: {{ $catalog->CatalogCode }}</p>
                <p class="card-text">Catalog Name: {{ $catalog->CatalogName }}</p>
                <p class="card-text">ISBN: {{ $catalog->Isbn }}</p>
                <p class="card-text">Author Name: {{ $catalog->AuthorName }}</p>
                <p class="card-text">Publisher: {{ $catalog->PubliSher }}</p>
                <p class="card-text">Publish Year: {{ $catalog->PublishYear }}</p>
                <p class="card-text">Published Edition: {{ $catalog->PublisheDition }}</p>
                <p class="card-text">Is Hidden:
                    @if ($catalog->IsHidden == 1)
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
        <a href="{{ route('catalog.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
            list</a>
    </div>
@endsection
