@extends('Backends.master')
@section('content')
    <style>
        .rounded-circle {
            transition: transform 0.3s ease-in-out;
            box-shadow: 0px 7px 9px rgba(17, 17, 17, 0.1);
            /* Shadow effect */
            bo
        }

        .rounded-circle:hover {
            transform: scale(1.1);
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
            /* Shadow effect on hover */
        }

        .modal-head {
            margin: 1rem;
            text-align: center !important;
        }

        #profile {
            width: 50px !important;
            height: 50px !important;

        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Users List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header" style="background-color:  rgba(173, 72, 0, 1)">
                <h3 class="card-title">Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="userTable" class="table  table-hover">
                    @can('create user')
                        <a href="{{ url('users/create') }}" class="btn btn-info float-right"> <i class="fa fa-plus-circle"></i>
                            New</a>
                    @endcan
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="col-1">
                                    <a href="#" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $user->id }}">
                                        <img class=" align-item-center"
                                            src="
                                    @if ($user->profile && file_exists(public_path('P_images/' . $user->profile))) {{ asset('P_images/' . $user->profile) }}
                                    @else
                                        {{ asset('uploads/image/default.png') }} @endif
                                    "
                                            alt="No Image" alt="Profile Image" id="profile" width="50" height="50%"
                                            style="border-radius: 50%;">
                                    </a>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                {{-- <td>{{$user->password}}</td> --}}
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $rolename)
                                            <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_input Status"
                                            id="Status_{{ $user->id }}" data-id="{{ $user->id }}"
                                            {{ $user->Status == 1 ? 'checked' : '' }} name="Status">
                                        <label class="custom-control-label" for="Status_{{ $user->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    {{-- <a href="{{url('users/'.$user->id.'/give-permissions')}}" class="btn btn-success">Add / Edit user Permission </a> --}}
                                    @can('update user')
                                        <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-sm"><i
                                                class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                    @endcan
                                    @can('delete user')
                                        <a href="{{ url('users/' . $user->id . '/delete') }}"
                                            class="btn btn btn-sm btn-delete"><i class="fa-solid fa-trash fa-xl "
                                                style="color: red;"></i></a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $("#userTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": true
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
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
    <script>
        $(document).ready(function() {
            $('input.Status').on('change', function() {
                let isChecked = $(this).is(':checked');
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "PUT",
                    url: "{{ route('user.update_Status') }}",
                    data: {
                        _token: token,
                        id: $(this).data('id'),
                        Status: isChecked ? 1 : 0
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.Status == 1) {
                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg);
                        }
                        //  location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        toastr.error('Something went wrong.');
                    }
                });
            });
        });
    </script>
@endsection
