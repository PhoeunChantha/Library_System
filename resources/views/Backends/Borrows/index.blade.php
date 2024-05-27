@extends('Backends.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('All Borrows List') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Borrow</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="borrowTable" class="table  table-hover">
                @can('create borrow')
                    <a href="{{ route('borrow.create') }}" class="btn btn-info btn-sm mb-2"><i class="fa-solid fa-plus fa-xl"
                            style="color: #1567f4;"></i>Add</a>
                @endcan
                @can('show hide')
                    <button type="button" id="showAllBtn" class="btn btn-sm bg-gradient-success float-end">Show All
                    </button>
                @endcan
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
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrows as $item)
                        {{-- @if ($item->IsHidden == 0) --}}
                        <tr class="borrowRow" @if ($item->IsHidden == 0) style="display:none;" @endif>
                            <td>{{ $loop->iteration }}</td>
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
                            @can('hide data')
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_input IsHidden"
                                            id="IsHidden_{{ $item->BorrowId }}" data-id="{{ $item->BorrowId }}"
                                            {{ $item->IsHidden == 1 ? 'checked' : '' }} name="IsHidden">
                                        <label class="custom-control-label" for="IsHidden_{{ $item->BorrowId }}"></label>
                                    </div>
                                </td>
                            @endcan
                            <td>
                                @can('view borrow')
                                    <a href="{{ route('borrow.show', $item->BorrowId) }}" class="btn btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#BorrowModal{{ $item->BorrowId}}"><i class="fa-solid fa-eye fa-xl"
                                            style="color: #2363d1;"></i></a>
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
                                        <button type="submit" class="btn btn-sm btn-delete">
                                            <i class="fa-solid fa-trash fa-xl " style="color: red;"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        {{-- @endif --}}
                        @include('Backends.Borrows.show')
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    @include('Backends.BorrowDetails.index')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let showAll = false; // Flag to track the state of the button

            // Initially hide rows where IsHidden is 0
            $('.borrowRow').each(function() {
                if (!$(this).find('input.IsHidden').prop('checked')) {
                    $(this).hide();
                }
            });

            $('#showAllBtn').click(function() {
                showAll = !showAll; // Toggle the flag

                if (showAll) {
                    // Show all rows
                    $('.borrowRow').show();
                } else {
                    // Hide rows where IsHidden is 0
                    $('.borrowRow').each(function() {
                        if (!$(this).find('input.IsHidden').prop('checked')) {
                            $(this).hide();
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input.IsHidden').on('change', function() {
                let isChecked = $(this).is(':checked');
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "PUT",
                    url: "{{ route('borrow.update_IsHidden') }}",
                    data: {
                        _token: token,
                        id: $(this).data('id'),
                        IsHidden: isChecked ? 1 : 0
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.IsHidden == 1) {
                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg);
                        }
                        //location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        toastr.error('Something went wrong.');
                    }
                });
            });
        });
    </script>
    <script>
        $(function() {

            $('#borrowTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "dom": 'Bfrtip',
            });
        });
    </script>
@endsection
