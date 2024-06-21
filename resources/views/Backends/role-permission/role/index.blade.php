@extends('Backends.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Roles List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h3 class="card-title">Roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="roleTable" class="table  table-hover">
                    @can('create role')
                        <a href="{{ url('roles/create') }}" class="btn btn-info float-right" data-bs-toggle="modal"  data-bs-target="#RoleModal"> <i class="fa fa-plus-circle"></i>
                            New</a>
                    @endcan
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @can('add edit permission')
                                        <a href="{{ url('roles/' . $role->id . '/give-permissions') }}" class="btn btn-sm btn-success">Add
                                            / Edit Role Permission </a>
                                    @endcan
                                    @can('update role')
                                        <a href="{{ url('roles/' . $role->id . '/edit') }}" class="btn btn-sm"><i
                                            class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                    @endcan
                                    @can('delete role')
                                        <a href="{{ url('roles/' . $role->id . '/delete') }}" class="btn btn-sm btn-delete"><i
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
    @include('Backends.role-permission.role.create')
    @include('Backends.role-permission.permission.create')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#roleTable').DataTable({
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
