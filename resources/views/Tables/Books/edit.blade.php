@extends('Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Book</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('book.update',$book->BookId) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="BookName">Book Name</label>
                            <input type="text" name="BookName" id="BookName" class="form-control" value="{{$book->BookName}}" required>
                        </div>
                        <div class="form-group">
                            <label for="BookCode">Book Code</label>
                            <input type="text" name="BookCode" id="BookCode" class="form-control" value="{{$book->BookCode}}" required>
                        </div>
                        <div class="form-group">
                            <label for="CatalogId">CatalogId</label>
                            <select name="CatalogId" id="CatalogId" class="form-control" value="{{$book->CatalogId}}" required>
                                @foreach($catalogs as $catalog)
                                    <option value="{{ $catalog->CatalogId }}">
                                        {{ $catalog->CatalogName }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="current_image" class="form-label">Current Image</label>
                            <img src="{{ asset('images/' . $book->BookImage) }}" alt="Current Image" style="max-width: 100px;">
                        </div>
                        <div class="form-group">
                            <label for="BookImage">New Image</label>
                            <input type="file" name="BookImage" id="BookImage" class="form-control-file" accept="image/*" onchange="previewImage(event)" required>
                            <img id="preview" src="#" alt="Preview" style="display: none; max-width: 100px; max-height: 100px; margin-top: 10px;">
                            <!-- accept="image/*" ensures that only image files can be selected -->
                        </div>
                        <div class="form-group">
                            <label for="BookDescription">Book Description</label>
                            <input type="text" name="BookDescription" id="BookDescription" class="form-control" value="{{$book->BookDescription}}">
                        </div>
                        <div class="form-check mb-2">
                            <input type="hidden" name="IsHidden" value="0">
                            <input type="checkbox" name="IsHidden" id="IsHidden" class="form-check-input" value="1" {{ $book->IsHidden == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="IsHidden">Hidden</label>
                        </div>
                        <button type="submit" class="btn btn-primary">update</button>
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
