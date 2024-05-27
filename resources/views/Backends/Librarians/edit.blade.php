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
                <h3>{{ __('Edit Librarian') }}</h3>
            </div>
            <div class="col-sm-6" style="text-align: right">
            </div>
        </div>
    </div>
</section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header text-white"style="background-color:  rgba(173, 72, 0, 1)"> Librarian Information</div>

                    <div class="card-body">
                        <form method="POST" class="row" action="{{ route('librarian.update', $librarian->LibrarianId) }}">
                            @csrf
                            @method('put')
                            <div class="form-group col-md-6">
                                <label for="LibrarianName">LibrarianName</label>
                                <input type="text" name="LibrarianName" id="LibrarianName" class="form-control"
                                    value="{{ $librarian->LibrarianName }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Sex">Sex</label>
                                    <select name="Sex" id="Sex" class="form-control" value="{{ $librarian->Sex }}">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Dob">Date of Birth</label>
                                <input type="date" name="Dob" id="Dob" class="form-control"
                                    value="{{ $librarian->Dob }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Pob">Place of Birth</label>
                                <input type="text" name="Pob" id="Pob" class="form-control"
                                    value="{{ $librarian->Pob }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Phone">Phone</label>
                                <input type="text" name="Phone" id="Phone" class="form-control"
                                    value="{{ $librarian->Phone }}">
                            </div>
                            {{-- <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" value="1" name="IsHidden" id="customSwitch1"  {{ $librarian->IsHidden == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                    <input type="hidden" id="IsHidden" name="IsHidden" value="0">
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <button type="submit" id="updateButton" class="btn btn-primary col-1 ml-2" >Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('librarian.index') }}" class="back"><i class="fa-solid fa-arrow-left mr-2"></i>back to
                    list</a>
            </div>
        </div>
    </div>
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
@endsection
