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
            <h3 class="card-title">Book </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" id="showAllBtn" class="btn btn-sm bg-gradient-success float-end">Show All</button>
            <table id="bookTable" class="table  table-hover">
                @can('create book')
                    <a href="{{ route('book.create') }}" class="btn btn-info btn-sm mb-2"><i class="fa-solid fa-plus fa-xl"
                            style="color: #1567f4;"></i>Add</a>
                @endcan



                <thead>
                    <tr>
                        <th>#</th>
                        <th>BookName</th>
                        <th>BookCode</th>
                        <th>Catalog Name</th>
                        <th>BookImage</th>
                        <th>BookDescription</th>
                        <th>IsHidden</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $item)
                        <tr class="bookRow" @if ($item->IsHidden == 1) style="display:none;" @endif>
                            <td>{{ $item->BookId }}</td>
                            <td>{{ $item->BookName }}</td>
                            <td>{{ $item->BookCode }}</td>
                            <td>{{ $item->catalog->CatalogName }}</td>
                            <td>
                                <img class="align-item-center" src="{{ asset('images/' . $item->BookImage) }}"
                                    alt="Image" width="60" height="50">
                            </td>
                            <td>{{ $item->BookDescription }}</td>
                            <td>
                                @if ($item->IsHidden == 1)
                                    {{-- <i class="fas fa-check ml-2" style="color: green;"></i> --}}
                                    <span class="badge bg-danger">Hided</span>
                                    <!-- Green color for checked state -->
                                @else
                                    {{-- <i class="fas fa-times ml-2" style="color: red;"></i>  --}}
                                    <span class="badge bg-success">showed</span>
                                @endif
                            </td>
                            <td>
                                @can('view book')
                                <a href="{{ route('book.show', $item->BookId) }}" class="btn btn-sm">
                                    <i class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i>
                                </a>
                                @endcan
                                @can('update book')
                                    <a href="{{ route('book.edit', $item->BookId) }}" class="btn  btn-sm"><i
                                            class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                @endcan
                                @can('delete book')
                                    <form action="{{ route('book.destroy', $item->BookId) }}" method="POST" class="d-inline">
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
    {{-- <script>
    // Close the alert after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        document.getElementById('statusAlert').style.display = 'none';
    }, 5000); // Adjust the time as needed (5 seconds in this case)
</script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#showAllBtn').click(function() {
                $('.bookRow').toggle(); // Toggle visibility of all rows
                // Hide rows where IsHidden is not equal to 1
                $('.bookRow').each(function() {
                    if ($(this).find('td:eq(6)').text().trim() != 'Hided') {
                        $(this).toggle();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#bookTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print",
                    "colvis"
                ], // Include all desired buttons
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": true
            });
        });
    </script>
@endsection
