@extends('Backends.master')
<style>
    .disabled-row {
        opacity: 0.5;
        /* Decrease opacity to make the row appear disabled */
        pointer-events: none;
        /* Disable pointer events */
    }
</style>

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
            <table id="bookTable" class="table  table-hover">
                @can('create book')
                    <a href="{{ route('book.create') }}" class="btn btn-info btn-sm mb-2"><i class="fa-solid fa-plus fa-xl"
                            style="color: #1567f4;"></i>Add</a>
                @endcan
                @can('show hide')
                    <button type="button" id="showAllBtn" class="btn btn-sm bg-gradient-success float-end">Show All
                    </button>
                @endcan
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Book Code</th>
                        <th>Catalog Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Staus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $item)
                        @php
                            $isBorrowed = false;
                            foreach ($borrowDetails as $borrowDetail) {
                                $bookIds = json_decode($borrowDetail->book_ids, true); // Convert string to array
                                if (is_array($bookIds) && in_array($item->BookId, $bookIds)) {
                                    if ($borrowDetail->IsReturn == 0) {
                                        $isBorrowed = true; // Book is borrowed
                                    }
                                    break; // If the book is found in any borrowDetail, exit the loop
                                }
                            }
                        @endphp

                        <tr class="BookRow" @if ($item->IsHidden == 0) style="display:none;" @endif>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->BookCode }}</td>
                            <td class="@if ($isBorrowed) disabled-row text-danger @endif">
                                <span class="ml-2">
                                    {{-- {{ $item->catalog->CatalogCode }} --}}
                                    {{ $item->catalog->CatalogName }}
                                </span>
                            </td>
                            <td>
                                <img height="50" width="60"
                                    src="{{ $item->BookImage && file_exists(public_path('images/' . $item->BookImage)) ? asset('images/' . $item->BookImage) : asset('uploads/image/default.png') }}"
                                    alt="" class="align-item-center">
                            </td>
                            <td>{{ $item->BookDescription }}</td>
                            @can('hide data')
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_input IsHidden"
                                            id="IsHidden_{{ $item->BookId }}" data-id="{{ $item->BookId }}"
                                            {{ $item->IsHidden == 1 ? 'checked' : '' }} name="IsHidden">
                                        <label class="custom-control-label" for="IsHidden_{{ $item->BookId }}"></label>
                                    </div>
                                </td>
                            @endcan

                            <td>
                                @can('view book')
                                    <a href="{{ route('book.show', $item->BookId) }}" class="btn btn-sm"  data-bs-toggle="modal"
                                        data-bs-target="#BookModal{{$item->BookId}}">
                                        <i class="fa-solid fa-eye fa-xl" style="color: #2363d1;"></i>
                                    </a>
                                @endcan
                                @can('update book')
                                    <a href="{{ route('book.edit', $item->BookId) }}" class="btn btn-sm">
                                        <i class="fa-solid fa-pen-to-square fa-xl" style="color: #63E6BE;"></i>
                                    </a>
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
                        @include('Backends.Books.show')
                    @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            let showAll = false; // Flag to track the state of the button

            $('#showAllBtn').click(function() {
                showAll = !showAll; // Toggle the flag

                if (showAll) {
                    // Show all rows
                    $('.BookRow').show();
                } else {
                    // Hide rows where IsHidden is 1
                    $('.BookRow').each(function() {
                        if ($(this).find('input.IsHidden').is(':checked')) {
                            $(this).hide();
                        }
                    });
                }
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            let showAll = false; // Flag to track the state of the button

            // Initially hide rows where IsHidden is 0
            $('.BookRow').each(function() {
                if (!$(this).find('input.IsHidden').prop('checked')) {
                    $(this).hide();
                }
            });

            $('#showAllBtn').click(function() {
                showAll = !showAll; // Toggle the flag

                if (showAll) {
                    // Show all rows
                    $('.BookRow').show();
                } else {
                    // Hide rows where IsHidden is 0
                    $('.BookRow').each(function() {
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
            $("#bookTable").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": true
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
                    url: "{{ route('book.update_IsHidden') }}",
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
                        // location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        toastr.error('Something went wrong.');
                    }
                });
            });
        });
    </script>
    <style>
        .disabled-row {
            opacity: 0.5;
            /* Decrease opacity to make the row appear disabled */
            pointer-events: none;
            /* Disable pointer events */
        }
    </style>
@endsection
