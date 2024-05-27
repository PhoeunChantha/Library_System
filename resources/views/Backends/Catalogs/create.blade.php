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
                    <h3>{{ __('Add New Catalogs') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">Catalogs Informaion</div>

                    <div class="card-body">
                        <form class="row" method="POST" action="{{ route('catalog.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="CatalogCode">Catalog Code</label>
                                <input type="text" name="CatalogCode" id="CatalogCode" class="form-control"
                                    value="{{ old('CatalogCode') }}">
                                @error('CatalogCode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="CatalogName">Catalog Name</label>
                                <input type="text" name="CatalogName" id="CatalogName" class="form-control"
                                    value="{{ old('CatalogName') }}">
                                @error('CatalogName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Isbn">ISBN</label>
                                <input type="text" name="Isbn" id="Isbn" class="form-control"
                                    value="{{ old('Isbn') }}">
                                @error('Isbn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="AuthorName">Author Name</label>
                                <input type="text" name="AuthorName" id="AuthorName" class="form-control"
                                    value="{{ old('AuthorName') }}">
                                @error('AuthorName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Publisher">Publisher</label>
                                <input type="text" name="Publisher" id="Publisher" class="form-control"
                                    value="{{ old('Publisher') }}">
                                @error('Publisher')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="PublishYear">Publish Year</label>
                                <input type="number" name="PublishYear" id="PublishYear" class="form-control "
                                    max="2030" step="1" value="{{ old('PublishYear') }}">
                                @error('PublishYear')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="PublisheDition">Published Edition</label>
                                <input type="date" name="PublisheDition" id="PublisheDition" class="form-control"
                                    value="{{ old('PublisheDition') }}">
                                @error('PublisheDition')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary col-1 ml-2">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('catalog.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
                    list</a>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
