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
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" value="0" name="IsHidden" id="customSwitch1"
                                {{ $catalogs->IsHidden == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                <input type="hidden" id="IsHidden" name="IsHidden" value="1">
                            </div>
                        </div>
                        <button type="submit" id="updateButton" class="btn btn-primary col-1 ml-3" disabled>update</button>
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
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const updateButton = document.getElementById('updateButton');
            const formElements = form.querySelectorAll('input, select, textarea');

            // Listen for changes in form elements
            formElements.forEach(element => {
                element.addEventListener('change', () => {
                    // Enable the button when any field changes
                    updateButton.disabled = false;
                });
            });
        });
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
@endsection
