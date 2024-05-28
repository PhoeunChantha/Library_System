{{-- @extends('Backends.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Book Details List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section> --}}
<!-- /.card -->
<div class="card ">
    <div class="card-header">
        <h3 class="card-title">Borrow Detail</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="borrowdetailTable" class="table  table-hover">
            {{-- @can('create borrowdetail')
                    <a href="{{ route('borrowdetail.create') }}" class="btn btn-info btn-sm mb-2"><i
                            class="fa-solid fa-plus fa-xl" style="color: #1567f4;"></i>Add</a>
                @endcan --}}
            <thead>
                <tr>
                    <th>#</th>
                    <th>Borrow Code</th>
                    <th>Book Name</th>
                    <th>Note</th>
                    <th>Return</th>
                    <th>Return Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowdetails as $item)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->borrow->BorrowCode }}</td>

                        <td>
                            @php
                                $bookIds = json_decode($item->book_ids, true);
                            @endphp

                            @foreach ($bookIds as $bookId)
                                <li>
                                    {{ \App\Models\Book::find($bookId)->BookCode }}
                                    {{ \App\Models\Book::find($bookId)->catalog->CatalogName }}
                                </li>

                                {{-- @if (!$loop->last)
                                    ,
                                @endif --}}
                            @endforeach

                        </td>
                        <td>{{ $item->Note }}</td>
                        <td>
                            @if ($item->IsReturn == 1)
                                {{-- <i class="fas fa-check ml-2" style="color: green;"></i> --}}
                                <span class="badge bg-success">Yes</span>
                                <!-- Green color for checked state -->
                            @else
                                <span class="badge bg-danger">No</span>
                                {{-- <i class="fas fa-times ml-2" style="color: red;"></i>  --}}
                            @endif
                        </td>
                        <td>{{ $item->ReturnDate }}</td>
                        <td>
                            @can('view borrowdetail')
                                <a href="{{ route('borrowdetail.show', $item->BorrowDetailId) }}" class="btn btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#BorrowDetailModal{{ $item->BorrowDetailId }}"><i
                                        class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                            @endcan
                            @can('update borrowdetail')
                                <a href="{{ route('borrowdetail.edit', $item->BorrowDetailId) }}" class="btn  btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#BorrowUpdateModal{{ $item->BorrowDetailId }}"><i
                                        class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                            @endcan
                            @can('delete borrowdetail')
                                <form action="{{ route('borrowdetail.destroy', $item->BorrowDetailId) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-delete">
                                        <i class="fa-solid fa-trash fa-xl " style="color: red;"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                    @include('Backends.BorrowDetails.show')
                    @include('Backends.BorrowDetails.edit')
                @endforeach

            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#borrowdetailTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            // "dom": 'Bfrtip', // Add this line to include the buttons
        });
    });
</script>
{{-- <script>
    $(document).ready(function() {
        // Handle modal show event
        $('#BorrowUpdateModal{{ $item->BorrowDetailId }}').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var detailId = button.data('detail-id'); // Extract detail ID from data-* attributes
            var borrowDetail = @json($item); // Get the current BorrowDetail item

            // Update modal content with BorrowDetail data
            $(this).find('.modal-title').text('Update Borrow Detail');
            $(this).find('input[name="ReturnDate"]').val(borrowDetail.ReturnDate);
            $(this).find('textarea[name="Note"]').val(borrowDetail.Note);
            // Update other form fields as needed
        });
    });
</script> --}}

{{-- @endsection --}}
