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
            <h3 class="card-title">Borrow Records</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="borrowTable" class="table  table-hover">
                @can('create borrow')
                    <a href="{{ route('borrow.create') }}" class="btn btn-info btn-sm mb-2"><i class="fa-solid fa-plus fa-xl"
                            style="color: #1567f4;"></i>Add</a>
                @endcan
                <button type="button" id="showAllBtn" class="btn btn-sm bg-gradient-success float-end">Show All</button>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Librarian Name</th>
                        <th>Borrow Date</th>
                        <th>Borrow Code</th>
                        <th>Deposit Amount</th>
                        <th>Due Date</th>
                        <th>Fine Amount</th>
                        <th>Emmo</th>
                        <th>Is Hidden</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrows as $item)
                        {{-- @if ($item->IsHidden == 0) --}}
                        <tr class="borrowRow" @if ($item->IsHidden == 1) style="display:none;" @endif>
                            <td>{{ $item->BorrowId }}</td>
                            <td>{{ $item->customer->CustomerName }}</td>
                            <td>{{ $item->librarian->LibrarianName }}</td>
                            <td>{{ $item->BorrowDate }}</td>
                            <td>{{ $item->BorrowCode }}</td>
                            <td><i class="fas fa-dollar-sign fa-sm mr-1" style="color: gray"></i>{{ $item->Depositamount }}
                            </td>
                            <td>{{ $item->Duedate }}</td>
                            <td><i class="fas fa-dollar-sign fa-sm mr-1" style="color: gray"></i>{{ $item->FineAmount }}
                            </td>
                            <td>{{ $item->Emmo }}</td>
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
                                @can('view borrow')
                                    <a href="{{ route('borrow.show', $item->BorrowId) }}" class="btn btn-sm"><i
                                            class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                                @endcan
                                @can('update borrow')
                                    <a href="{{ route('borrow.edit', $item->BorrowId) }}" class="btn btn-sm"><i
                                            class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                @endcan
                                @can('delete borrow')
                                    <form action="{{ route('borrow.destroy', $item->BorrowId) }}" method="POST"
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
                        {{-- @endif --}}
                    @endforeach
                </tbody>
            </table>

        </div>

        <!-- /.card-body -->
    </div>

    <script>
        // Close the alert after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            document.getElementById('statusAlert').style.display = 'none';
        }, 5000); // Adjust the time as needed (5 seconds in this case)
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#showAllBtn').click(function() {
                $('.borrowRow').toggle(); // Toggle visibility of all rows
                // Hide rows where IsHidden is not equal to 1
                $('.borrowRow').each(function() {
                    if ($(this).find('td:eq(9)').text().trim() != 'Hided') {
                        $(this).toggle();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#borrowTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script>
@endsection
