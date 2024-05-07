@extends('Dashboard')
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
    <!-- /.card -->
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Users </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="userTable" class="table  table-hover">
                @can('create user')
                <a href="{{ url('users/create') }}" class="btn btn-primary rounded-circle">
                    <i class="fa-solid fa-plus" style="color: white;"></i>
                </a>
                @endcan
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
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
                                    <img class=" align-item-center" src="{{ asset('P_images/' . $user->profile) }}"
                                        alt="Profile Image" id="profile" width="50" height="50%"
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
                                {{-- <a href="{{url('users/'.$user->id.'/give-permissions')}}" class="btn btn-success">Add / Edit user Permission </a> --}}
                                @can('update user')
                                <a href="{{ url('users/' . $user->id . '/edit') }}"
                                    class="btn btn-success rounded-circle"><i class="fa-solid fa-pen-to-square"
                                        style="color: white;"></i></a>
                                @endcan
                                @can('delete user')
                                <a href="{{ url('users/' . $user->id . '/delete') }}"
                                    class="btn btn-danger rounded-circle"><i class="fa-solid fa-trash-can fa-bounce"
                                        style="color: white;"></i></i></a>
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
    @foreach ($users as $user)
        <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-head">
                        <h1 class="modal-title fs-5" id="exampleModalLabel{{ $user->id }}">{{ $user->name }}</h1>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <img class="align-item-center" src="{{ asset('P_images/' . $user->profile) }}" alt="Profile Image"
                            width="400">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
    </script>
@endsection
