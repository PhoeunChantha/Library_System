@extends('Backends.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Permission List') }}</h3>
                </div>

            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h3 class="card-title">Permissions </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
                <table id="permissionTable" class="table  table-hover">
                    @can('create permission')
                        {{-- <a href="{{ url('permissions/create') }}" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add Permission</a> --}}
                            <a href="{{ url('permissions/create') }}" class="btn btn-info float-right" data-bs-toggle="modal"  data-bs-target="#exampleModal"> <i class="fa fa-plus-circle"></i>
                                New</a>
                    @endcan
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    @can('update permission')
                                        <a href="{{ url('permissions/' . $permission->id . '/edit') }}"
                                            class="btn btn-sm"><i
                                            class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                    @endcan
                                    @can('delete permission')
                                        <a href="{{ url('permissions/' . $permission->id . '/delete') }}"
                                            class="btn btn-sm btn-delete"><i
                                            class="fa-solid fa-trash fa-xl " style="color: red;"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
    @include('Backends.role-permission.permission.create')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $("#permissionTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print",
                "colvis"], // Include all desired buttons
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": true
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#permissionTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "    Search for something...",
                },
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

            // Center the search input
            var searchInput = $('div.dataTables_filter input');
            var searchInputParent = searchInput.parent();
            searchInputParent.css({
                'width': '100%',
                'text-align': 'left'
            });
            searchInput.css({
                'display': 'inline-block',
                'width': '10cm',
                'height': '1cm'
            });
        });
    </script>
@endsection
