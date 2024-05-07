@extends('Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header text-center">Create New Librarian</div>

                    <div class="card-body">
                        <form  method="POST" action="{{ route('librarian.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="librarianName">Librarian Name</label>
                                <input type="text" name="LibrarianName" id="librarianName" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="Sex">Sex</label>
                                <select name="Sex" id="Sex" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Dob">Date of Birth</label>
                                <input type="date" name="Dob" id="Dob" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="Pob">Place of Birth</label>
                                <input type="text" name="Pob" id="Pob" class="form-control" maxlength="50">
                            </div>

                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input type="text" name="Phone" id="Phone" class="form-control" maxlength="60">
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" value="0" name="IsHidden" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Hidden</label>
                                    <input type="hidden" id="IsHidden" name="IsHidden" value="1">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
