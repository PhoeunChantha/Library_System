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
                <h3>{{ __('Edit Catalogs') }}</h3>
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
                <div class="card-header">Catalogs Information</div>

                <div class="card-body">
                    <form class="row" method="POST" action="{{ route('catalog.update',$catalogs->CatalogId) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-6">
                            <label for="CatalogCode">Catalog Code</label>
                            <input type="text" name="CatalogCode" id="CatalogCode" autocomplete="off" class="form-control"  value="{{$catalogs->CatalogCode}}">
                            @error('CatalogCode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="CatalogName">Catalog Name</label>
                            <input type="text" name="CatalogName" id="CatalogName" class="form-control"  value="{{$catalogs->CatalogName}}">
                            @error('CatalogName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Isbn">ISBN</label>
                            <input type="text" name="Isbn" id="Isbn" class="form-control"  value="{{$catalogs->Isbn}}">
                            @error('Isbn')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="AuthorName">Author Name</label>
                            <input type="text" name="AuthorName" id="AuthorName" class="form-control"  value="{{$catalogs->AuthorName}}">
                            @error('AuthorName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Publisher">Publisher</label>
                            <input type="text" name="Publisher" id="Publisher" class="form-control"  value="{{$catalogs->PubliSher}}">
                            @error('Publisher')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="PublishYear">Publish Year</label>
                            <input type="number" name="PublishYear" id="PublishYear" class="form-control"  max="2030" step="1" value="{{$catalogs->PublishYear}}" >
                            @error('PublishYear')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="PublisheDition">Published Edition</label>
                            <input type="date" name="PublisheDition" id="PublisheDition" class="form-control" value="{{$catalogs->PublisheDition}}" >
                            @error('PublisheDition')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        {{-- <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="1" name="IsHidden" id="customSwitch1"  {{ $catalogs->IsHidden == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                <input type="hidden" id="IsHidden" name="IsHidden" value="0">
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <button type="submit" id="updateButton" class="btn btn-primary col-1 ml-2" >update</button>
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
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
  {{-- <script>
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
</script> --}}
<script>
    document.getElementById('CatalogCode').addEventListener('input', function(event) {
        const input = event.target;
        const value = input.value;

        // Ensure the input starts with 'cat'
        if (!value.startsWith('cat')) {
            input.value = 'cat' + value.replace(/^cat/, '');
        }

        // Ensure the fourth character is a number
        if (value.length > 3 && !/\d/.test(value[3])) {
            input.value = value.slice(0, 3) + value.slice(4);
        }
    });
</script>
@endsection
