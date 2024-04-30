@extends('Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create New Catalogs</div>

                <div class="card-body">
                    <form class="row" method="POST" action="{{ route('catalog.update',$catalogs->CatalogId) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-3">
                            <label for="CatalogCode">Catalog Code</label>
                            <input type="text" name="CatalogCode" id="CatalogCode" class="form-control" required value="{{$catalogs->CatalogCode}}">
                        </div>
                        <div class="form-group col-5">
                            <label for="CatalogName">Catalog Name</label>
                            <input type="text" name="CatalogName" id="CatalogName" class="form-control" required value="{{$catalogs->CatalogName}}">
                        </div>
                        <div class="form-group col-4">
                            <label for="Isbn">ISBN</label>
                            <input type="text" name="Isbn" id="Isbn" class="form-control" required value="{{$catalogs->Isbn}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="AuthorName">Author Name</label>
                            <input type="text" name="AuthorName" id="AuthorName" class="form-control" required value="{{$catalogs->AuthorName}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="Publisher">Publisher</label>
                            <input type="text" name="Publisher" id="Publisher" class="form-control" required value="{{$catalogs->PubliSher}}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="PublishYear">Publish Year</label>
                            <input type="text" name="PublishYear" id="PublishYear" class="form-control" required value="{{$catalogs->PublishYear}}">
                        </div>
                        <div class="form-group">
                            <label for="PublisheDition">Published Edition</label>
                            <input type="text" name="PublisheDition" id="PublisheDition" class="form-control" required value="{{$catalogs->PublisheDition}}">
                        </div> --}}
                        <div class="form-group">
                            <label for="PublishYear">Publish Year</label>
                            <input type="number" name="PublishYear" id="PublishYear" class="form-control" min="2000" max="2030" step="1" value="{{$catalogs->PublishYear}}" required>
                        </div>
                        <div class="form-group">
                            <label for="PublisheDition">Published Edition</label>
                            <input type="date" name="PublisheDition" id="PublisheDition" class="form-control" value="{{$catalogs->PublisheDition}}" required>
                        </div>
                        <div class="form-check mb-2 ml-3">
                            <input type="hidden" name="IsHidden" value="0"> <!-- Add a hidden input to ensure a value is always submitted -->
                            <input type="checkbox" name="IsHidden" id="IsHidden" class="form-check-input" value="1" {{ $catalogs->IsHidden == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="IsHidden">Hidden</label>
                        </div>
                        <button type="submit" class="btn btn-primary col-1 ml-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
@endsection
