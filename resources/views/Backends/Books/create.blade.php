@extends('Backends.master')

@section('content')
    <style>
        /* Style for the circular profile picture */
        #preview {
            display: block;
            width: 120px;
            height: 130px;
            margin-top: 10px;
            /* border-radius: 50%; */
            object-fit: cover;

        }

        .required_label::after {
            content: '*';
            color: red;
            margin-left: 5px;
            /* Adjust the spacing as needed */
        }

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
                    <h3>{{ __('Add New Book') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row justify-content-center d-flex">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">Book Information</div>

                    <div class="card-body">
                        <form method="POST" class="row" action="{{ route('book.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="BookCode">Book Code</label>
                                <input type="text" name="BookCode" id="BookCode"
                                    class="form-control @error('BookCode') is-invalid
                                @enderror" autocomplete="off">{{ old('BookCode') }}
                                @error('BookCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required_lable" for="CatalogId">{{ __('Catalog') }}</label>
                                <select name="CatalogId" id="CatalogId"
                                    class="form-control select2 @error('CatalogId') is-invalid
                                @enderror"
                                   >{{ old('CatalogId') }}
                                   <option value="">{{ __('Select CatalogName') }}</option>
                                    @foreach ($catalogs as $CatalogId => $CatalogName)
                                        <option value="{{ $CatalogId }}">{{ $CatalogName }}</option>
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
                                <textarea name="BookDescription" id="BookDescription"
                                    class="form-control @error('BookDescription') is-invalid @enderror">{{ old('BookDescription') }}</textarea>
                                @error('BookDescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="BookImage">Book Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="BookImage"
                                            id="exampleInputFile" accept="image/*" onchange="previewImage(event)">
                                        <label class="custom-file-label" id="fileLabel" for="exampleInputFile">Choose
                                            Image</label>
                                    </div>
                                </div>
                                <div class="preview text-center border rounded mt-2"
                                    style="height: 150px; display: flex; justify-content: center; align-items: center;">
                                    <img id="preview" src="#" alt="Preview"
                                        style="display: none; max-width: 200px; max-height: 200px; margin: auto; margin-top: 10px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary col-1 ml-2">Save</button>
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
        document.getElementById('BookCode').addEventListener('input', function(event) {
            const input = event.target;
            const value = input.value;

            // Ensure the input starts with 'cat'
            if (!value.startsWith('BK')) {
                input.value = 'BK' + value.replace(/^cat/, '');
            }

            // Ensure the fourth character is a number
            if (value.length > 3 && !/\d/.test(value[3])) {
                input.value = value.slice(0, 3) + value.slice(4);
            }
        });
    </script>
@endsection
