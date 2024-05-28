@extends('Backends.master')
@section('content')
@if (Session('status'))
{{-- <div class="alert alert-success" id="statusAlert">{{ session('status') }}</div> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Set Toastr options
    toastr.options = {
        progressBar: true,
        closeButton: false,
        timeOut: 5000
    };
    // Display success message
    toastr.success("{{ session('status') }}", 'Success!');
</script>
@endif
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
<div class="card ">
    <div class="card-header">
        <h3 class="card-title">Roles</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="roleTable" class="table  table-hover">
            {{-- @can('create role')
            <a href="{{url('roles/create')}}" class="btn btn-primary">Add role</a>
            @endcan --}}
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role )
                <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            @can('add edit permission')
                            <a href="{{url('roles/'.$role->id.'/give-permissions')}}" class="btn btn-success">Add / Edit Role Permission </a>
                            @endcan
                            @can('update role')
                            <a href="{{url('roles/'.$role->id.'/edit')}}" class="btn btn-success">Edit</a>
                            @endcan
                            @can('delete role')
                            <a href="{{url('roles/'.$role->id.'/delete')}}" class="btn btn-danger">Delete</a>
                            @endcan

                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@include('Backends.role-permission.permission.create')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#roleTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"], // Include all desired buttons
            "paging": true,
            "searching": true,
            "ordering": false,
            "info": true
        });
    });
</script>
@endsection



