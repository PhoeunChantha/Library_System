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
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="BookImage" id="exampleInputFile" accept="image/*" onchange="previewImage(event)" >
                                    <label class="custom-file-label" id="fileLabel" for="exampleInputFile">Choose Image</label>
                                </div>
                            </div>
                            <img id="preview" src="#" alt="Preview" style="display: none; max-width: 100px; max-height: 100px; margin-top: 10px;">
                        </div>
                        <div class="form-group">
                            <label for="BookDescription">Book Description</label>
                            <input type="text" name="BookDescription" id="BookDescription" class="form-control" value="{{$book->BookDescription}}">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="0" name="IsHidden" id="customSwitch1"
                                {{ $book->IsHidden == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                <input type="hidden" id="IsHidden" name="IsHidden" value="1">
                            </div>
                        </div>
                        <button type="submit" id="updateButton" class="btn btn-primary" >Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(event) {
        const input = event.target;
        const file = input.files[0];
        const label = input.nextElementSibling;
        const preview = document.getElementById('preview');

        label.innerText = file.name;

        const reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
</script>
<script>
    // Get the checkbox element
    var checkbox = document.getElementById('customSwitch1');
    // Get the hidden input element
    var hiddenInput = document.getElementById('IsHidden');

    // Add event listener to listen for changes in the checkbox
    checkbox.addEventListener('change', function() {
        // Toggle the values of the checkbox and hidden input
        if (this.checked) {
            checkbox.value = '0';
            hiddenInput.value = '1';
        } else {
            checkbox.value = '1';
            hiddenInput.value = '0';
        }
    });
</script>
{{-- <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script> --}}
@endsection
