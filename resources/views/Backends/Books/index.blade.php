@extends('Backends.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Books List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Book</h3>
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->BookName }}</td>
                            <td>{{ $item->BookCode }}</td>
                            <td>{{ $item->catalog->CatalogName }}</td>
                            {{-- <td>
                                <img class="align-item-center" src="{{ asset('images/' . $item->BookImage) }}"
                                    alt="Image" width="60" height="50">
                            </td> --}}
                            <td>
                                <img height="50" width="60"
                                    src="
                                @if ($item->BookImage && file_exists(public_path('images/' . $item->BookImage))) {{ asset('images/' . $item->BookImage) }}
                                @else
                                    {{ asset('uploads/image/default.png') }} @endif
                                "
                                    alt="" class="align-item-center">
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
                                    <form action="{{ route('book.destroy', $item->BookId) }}" method="POST"
                                        class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-delete">
                                            <i class="fa-solid fa-trash fa-xl" style="color: red;"></i>
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
@endsection

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

