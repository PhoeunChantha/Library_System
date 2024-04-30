@extends('Dashboard')
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
<!-- /.card -->
<div class="card ">
    <div class="card-header">
        <h3 class="card-title">Librarian </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form class="col-5 mb-3" role="search" action="{{ url()->current() }}" method="GET">
            @csrf
            <div class="input-group inline">
                <input type="text" class="form-control search-bar" name="search" style="border-radius: 10px"
                    placeholder="Search for something" aria-label="Search" />
                <div>
                    <!-- Add refresh button -->
                    <button type="submit" class="btn btn-primary" value="Refresh"
                        style="background-color: #3559E0; margin-left:1vw;">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
            </div>
        </form>

        <table id="" class="table table-bordered table-hover">
            <a href="{{route('librarian.create')}}" class="btn btn-info btn-sm mb-2"><i class="fa-solid fa-plus fa-xl" style="color: #1567f4;"></i>Add</a>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Librarian Name</th>
                    <th>Sex</th>
                    <th>Date of Birth</th>
                    <th>Place of Birth</th>
                    <th>Phone</th>
                    <th>IsHidden</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($librarians as $item)
                    <tr>
                        <td>{{$item->LibrarianId}}</td>
                        <td>{{$item->LibrarianName}}</td>
                        <td>{{$item->Sex}}</td>
                        <td>{{$item->Dob}}</td>
                        <td>{{$item->Pob}}</td>
                        <td>{{$item->Phone}}</td>
                        <td>
                            @if($item->IsHidden == 1)
                                <i class="fas fa-check" style="color: green;"></i> <!-- Green color for checked state -->
                            @else
                                <i class="fas fa-times" style="color: red;"></i> <!-- Red color for unchecked state -->
                            @endif
                        </td>
                        <td>
                            <a href="{{route('librarian.show',$item->LibrarianId)}}" class="btn btn-sm"><i class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                            <a href="{{route('librarian.edit',$item->LibrarianId)}}" class="btn  btn-sm"><i class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                            <form action="{{ route('librarian.destroy', $item->LibrarianId) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash fa-xl " style="color: red;"></i>
                                </button>

                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
    // Close the alert after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        document.getElementById('statusAlert').style.display = 'none';
    }, 5000); // Adjust the time as needed (5 seconds in this case)
</script>
@endsection
