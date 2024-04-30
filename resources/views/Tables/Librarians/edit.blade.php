@extends('Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Librarian</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('librarian.update', $librarian->LibrarianId) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="LibrarianName">LibrarianName</label>
                                <input type="text" name="LibrarianName" id="LibrarianName" class="form-control"
                                    value="{{ $librarian->LibrarianName }}" required>
                            </div>
                            <div class="form-group">
                                <label for="Sex">Sex</label>
                                <input type="text" name="Sex" id="Sex" class="form-control"
                                    value="{{ $librarian->Sex }}">
                            </div>

                            <div class="form-group">
                                <label for="Dob">Date of Birth</label>
                                <input type="date" name="Dob" id="Dob" class="form-control"
                                    value="{{ $librarian->Dob }}">
                            </div>

                            <div class="form-group">
                                <label for="Pob">Place of Birth</label>
                                <input type="text" name="Pob" id="Pob" class="form-control"
                                    value="{{ $librarian->Pob }}">
                            </div>
                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input type="text" name="Phone" id="Phone" class="form-control"
                                    value="{{ $librarian->Phone }}">
                            </div>
                            <div class="form-check mb-2">
                                <input type="hidden" name="IsHidden" value="0">
                                <!-- Add a hidden input to ensure a value is always submitted -->
                                <input type="checkbox" name="IsHidden" id="IsHidden" class="form-check-input"
                                    value="1" {{ $librarian->IsHidden == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="IsHidden">Hidden</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
