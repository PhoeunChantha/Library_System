@extends('Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Librarian</div>

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

                            <div class="form-check mb-2">
                                <input type="hidden" name="IsHidden" value="0">
                                <input type="checkbox" name="IsHidden" id="IsHidden" class="form-check-input"
                                    value="1">
                                <label class="form-check-label" for="IsHidden">Hidden</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
