@extends('Backends.master')
@section('content')
    <style>
        a {
            text-decoration: none;
            color: gray;
        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Edit Book') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Book Information</div>
                    <div class="card-body">
                        <form method="POST" class="row" action="{{ route('book.update', $book->BookId) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- <div class="form-group col-md-6">
                                <label for="BookName">Book Name</label>
                                <input type="text" name="BookName" id="BookName"
                                    class="form-control @error('BookName') is-invalid @enderror"
                                    value="{{ old('BookName', $book->BookName) }}" required>
                                @error('BookName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="form-group col-md-6">
                                <label for="BookCode">Book Code</label>
                                <input type="text" name="BookCode" id="BookCode"
                                    class="form-control @error('BookCode') is-invalid @enderror"
                                    value="{{ old('BookCode', $book->BookCode) }}" required>
                                @error('BookCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="CatalogId">Catalog</label>
                                <select name="CatalogId" id="CatalogId"
                                    class="select2 form-control @error('CatalogId') is-invalid @enderror" required>
                                    <option value="">{{ __('Select Categories') }}</option>
                                    @foreach ($catalogs as $catalog)
                                        <option value="{{ $catalog->CatalogId }}"
                                            {{ $catalog->CatalogId == old('CatalogId', $book->CatalogId) ? 'selected' : '' }}>
                                            {{ $catalog->CatalogName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('CatalogId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="BookDescription">Book Description</label>
                                <textarea type="text" name="BookDescription" id="BookDescription"
                                    class="form-control @error('BookDescription') is-invalid @enderror">{{ old('BookDescription', $book->BookDescription) }}</textarea>
                                @error('BookDescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="BookImage">New Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input @error('BookImage') is-invalid @enderror"
                                            name="BookImage" id="exampleInputFile" accept="image/*">
                                        <label class="custom-file-label" id="fileLabel"
                                            for="exampleInputFile">{{ $book->BookImage ?? __('Choose file') }}</label>
                                    </div>
                                </div>
                                @error('BookImage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="preview text-center border rounded mt-2"
                                    style="height: 150px; display: flex; justify-content: center; align-items: center;">
                                    <img id="preview"
                                        src="
                                        @if ($book->BookImage && file_exists(public_path('images/' . $book->BookImage))) {{ asset('images/' . $book->BookImage) }}
                                        @else
                                            {{ asset('images/image/default.png') }} @endif
                                    "
                                        alt="Preview"
                                        style="max-width: 100%; max-height: 100%; display: {{ $book->BookImage ? 'block' : 'none' }};">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('book.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
                    list</a>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.book-file-input').addEventListener('change', function(e) {
            var reader = new FileReader();
            var preview = document.getElementById('preview');
            var fileLabel = document.getElementById('fileLabel');

            // Update the preview image
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);

            // Update the file label
            var fileName = this.files[0].name;
            fileLabel.textContent = fileName;
        });
    </script>
    <script>
        // Get the checkbox element
        var checkbox = document.getElementById('customSwitch1');
        // Get the hidden input element
        var hiddenInput = document.getElementById('IsHidden');

        // Add event listener to listen for changes in the checkbox
        checkbox.addEventListener('change', function() {
            // Toggle the values of the hidden input based on the checkbox state
            if (this.checked) {
                hiddenInput.value = '1';
            } else {
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
