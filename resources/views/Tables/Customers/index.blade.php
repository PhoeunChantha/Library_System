@extends('Dashboard')
@section('content')

@if (Session('status'))
    {{-- <div class="alert alert-success" id="statusAlert">{{ session('status') }}</div> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Customer List </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="" class="table table-bordered table-hover">
                <a href="{{ route('customer.create') }}" class="btn btn-info btn-sm mb-2"><i class="fa-solid fa-plus fa-xl"
                        style="color: #1567f4;"></i>Add</a>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CustomerCode</th>
                        <th>CustomerType Name</th>
                        <th>CustomerName</th>
                        <th>Sex</th>
                        <th>Dob</th>
                        <th>Pob</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>IsHidden</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $item)
                        <tr>
                            <td>{{ $item->CustomerId }}</td>
                            <td>{{ $item->CustomerCode }}</td>
                            <td>{{ $item->customerType->CustomerTypeName }}</td>
                            <td>{{ $item->CustomerName }}</td>
                            <td>{{ $item->Sex }}</td>
                            <td>{{ $item->Dob }}</td>
                            <td>{{ $item->Pob }}</td>
                            <td>{{ $item->Phone }}</td>
                            <td>{{ $item->Address }}</td>
                            <td>
                                @if ($item->IsHidden == 1)
                                    <i class="fas fa-check" style="color: green;"></i>
                                    <!-- Green color for checked state -->
                                @else
                                    <i class="fas fa-times" style="color: red;"></i> <!-- Red color for unchecked state -->
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('customer.show', $item->CustomerId) }}" class="btn btn-sm"><i
                                        class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                                <a href="{{ route('customer.edit', $item->CustomerId) }}" class="btn  btn-sm"><i
                                        class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                <form action="{{ route('customer.destroy', $item->CustomerId) }}" method="POST"
                                    class="d-inline">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        // Close the alert after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            document.getElementById('statusAlert').style.display = 'none';
        }, 5000); // Adjust the time as needed (5 seconds in this case)
    </script>
@endsection
