@extends('Backends.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All CustomerTypes List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">CustomerType </h3>
            @if (session('status'))
                <div class="alert alert-success" id="statusAlert">{{ session('status') }}</div>
            @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="" class="table table-bordered table-hover">
                @can('create customertype')
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#CustomerTypeModal">
                        Create
                    </button>
                @endcan

                <thead>
                    <tr>
                        <th>#</th>
                        <th>CustomerTypeName</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customertypes as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->CustomerTypeName }}</td>

                            <td>
                                @can('delete customertype')
                                    <form action="{{ route('customertype.destroy', $item->CustomerTypeId) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash fa-xl " style="color: red;"></i>
                                        </button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="CustomerTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Add New Customer Type</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('customertype.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="CustomerTypeName">Customer Type Name</label>
                            <input type="text" name="CustomerTypeName" id="CustomerTypeName" class="form-control"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Tap</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete?')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
@endsection
