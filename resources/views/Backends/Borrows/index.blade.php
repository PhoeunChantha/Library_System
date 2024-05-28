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
            <table id="borrowTable" class="table  table-hover text-nowrap table-responsive ">
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
                        <th>Book Name</th>
                        <th>Return</th>
                        <th>Return Date</th>
                        <th>Emmo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- @foreach ($borrows as $borrow)
                        <tr class="borrowRow" @if ($borrow->IsHidden == 0) style="display:none;" @endif>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $borrow->customer->CustomerName }}</td>
                            <td>{{ $borrow->librarian->LibrarianName }}</td>
                            <td>{{ $borrow->BorrowDate }}</td>
                            <td>{{ $borrow->BorrowCode }}</td>
                            <td>{{ $borrow->Duedate }}</td>
                            <td><i class="fas fa-dollar-sign fa-sm mr-1"
                                    style="color: gray"></i>{{ $borrow->Depositamount }}</td>
                            <td><i class="fas fa-dollar-sign fa-sm mr-1" style="color: gray"></i>{{ $borrow->FineAmount }}
                            </td>
                            <td>
                                @foreach ($borrow->borrowDetails as $detail)
                                    @php
                                        $bookIds = json_decode($detail->book_ids, true);
                                    @endphp

                                    @foreach ($bookIds as $bookId)
                                        @php
                                            $book = \App\Models\Book::find($bookId);
                                        @endphp

                                        @if ($book)
                                            <li>
                                                {{ $book->BookCode }}
                                                 {{ $book->catalog->CatalogName }}

                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                @if ($borrow->borrowDetails->isNotEmpty() && $borrow->borrowDetails->first()->IsReturn == 1)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>{{ $borrow->borrowDetails->isNotEmpty() ? $borrow->borrowDetails->first()->ReturnDate : '' }}
                            </td>
                            <td>{{ $borrow->Emmo }}</td>
                            @can('hide data')
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_input IsHidden"
                                            id="IsHidden_{{ $borrow->BorrowId }}" data-id="{{ $borrow->BorrowId }}"
                                            {{ $borrow->IsHidden == 1 ? 'checked' : '' }} name="IsHidden">
                                        <label class="custom-control-label" for="IsHidden_{{ $borrow->BorrowId }}"></label>
                                    </div>
                                </td>
                            @endcan
                            <td>
                                @can('view borrow')
                                    <a href="{{ route('borrow.show', $borrow->BorrowId) }}" class="btn btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#BorrowModal{{ $borrow->BorrowId }}"><i
                                            class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                                @endcan
                                @can('update borrow')
                                    <a href="{{ route('borrow.edit', $borrow->BorrowId) }}" class="btn btn-sm"><i
                                            class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                @endcan
                                @can('delete borrow')
                                    <form action="{{ route('borrow.destroy', $borrow->BorrowId) }}" method="POST"
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
                        @include('Backends.Borrows.show')
                    @endforeach --}}
                    @foreach ($borrows as $borrow)
                        <tr class="borrowRow" @if ($borrow->IsHidden == 0) style="display:none;" @endif>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $borrow->customer->CustomerName }}</td>
                            <td>{{ $borrow->librarian->LibrarianName }}</td>
                            <td>{{ $borrow->BorrowDate }}</td>
                            <td>{{ $borrow->BorrowCode }}</td>
                            <td>{{ $borrow->Duedate }}</td>
                            <td><i class="fas fa-dollar-sign fa-sm mr-1"
                                    style="color: gray"></i>{{ $borrow->Depositamount }}</td>
                            <td><i class="fas fa-dollar-sign fa-sm mr-1" style="color: gray"></i>{{ $borrow->FineAmount }}
                            </td>
                            <td>

                                @foreach ($borrow->borrowDetails as $detail)
                                    @php
                                        $bookIds = json_decode($detail->book_ids, true);
                                    @endphp

                                    {{-- Check if $bookIds is not null and is an array --}}
                                    @if (!is_null($bookIds) && is_array($bookIds))
                                        @foreach ($bookIds as $bookId)
                                            @php
                                                // Find the book with the given ID
                                                $book = \App\Models\Book::find($bookId);
                                            @endphp

                                            {{-- Check if $book is not null --}}
                                            @if (!is_null($book))
                                                <li>
                                                    {{ $book->BookCode }}
                                                    {{ $book->catalog->CatalogName }}
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                            </td>

                            <td>
                                @if ($borrow->borrowDetails && $borrow->borrowDetails->isNotEmpty() && $borrow->borrowDetails->first()->IsReturn == 1)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>{{ $borrow->borrowDetails && $borrow->borrowDetails->isNotEmpty() ? $borrow->borrowDetails->first()->ReturnDate : '' }}
                            </td>
                            <td>{{ $borrow->Emmo }}</td>
                            @can('hide data')
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_input IsHidden"
                                            id="IsHidden_{{ $borrow->BorrowId }}" data-id="{{ $borrow->BorrowId }}"
                                            {{ $borrow->IsHidden == 1 ? 'checked' : '' }} name="IsHidden">
                                        <label class="custom-control-label" for="IsHidden_{{ $borrow->BorrowId }}"></label>
                                    </div>
                                </td>
                            @endcan
                            <td>
                                @can('view borrow')
                                    <a href="{{ route('borrow.show', $borrow->BorrowId) }}" class="btn btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#BorrowModal{{ $borrow->BorrowId }}"><i
                                            class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i></a>
                                @endcan
                                @can('update borrow')
                                    <a href="{{ route('borrow.edit', $borrow->BorrowId) }}" class="btn btn-sm"><i
                                            class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i></a>
                                @endcan
                                @can('delete borrow')
                                    <form action="{{ route('borrow.destroy', $borrow->BorrowId) }}" method="POST"
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
                        @include('Backends.Borrows.show')
                    @endforeach


                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    {{-- @include('Backends.BorrowDetails.index') --}}
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
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                // "dom": 'Bfrtip',
            });
        });
    </script>
@endsection
